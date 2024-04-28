<?php

namespace App\Http\Controllers\EstudanteControllers;

use App\Http\Controllers\Controller;
use App\Models\AreaConhecimento;
use App\Models\Contato;
use App\Models\ContatosDiretosExcluidos;
use App\Models\ContatoMensagem;
use App\Models\ContatosDiretosVisualizados;
use App\Models\Oferta;
use App\Models\PublicoAlvo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodasOfertasEstudanteController extends Controller
{
    public function listaOfertas(Request $request) {

        $usuarioId = Auth::id();

        $listPublicoAlvo = PublicoAlvo::all();
        $listAreaConhecimento = AreaConhecimento::all();
        $pesquisaTitulo = $request->input('pesquisa_titulo');
        $areaConhecimentoSelecionada = $request->input('area_conhecimento');
        $publicoAlvoSelecionado = $request->input('publico_alvo');
        $statusRegistroSelecionado = $request->input('status_registro');
        $regimeSelecionado = $request->input('regime');
        $inputTipoOferta = 'ACAO';

        /* DEVOLVER APENAS OS CONTATOS QUE NAO FORAM REALIZADOS AINDA */
        $ofertasNaoMostrar = $this->list_ofertas_excluidas($usuarioId);

        $query = Oferta::with('usuarioProfessor', 'ofertaConhecimento', 'ofertaAcao', 'areaConhecimento', 'contato')
            ->whereNotIn('Oferta.id_oferta', $ofertasNaoMostrar);

        $query->when($inputTipoOferta, function ($query, $inputTipoOferta) {
            return $query->where('Oferta.tipo', $inputTipoOferta);
        });

        /* FILTRAGEM TIPO */
        if (!empty($request->all())){
            $listaOfertas = $this->filtragemOfertas($request, $query);
        } else {
            $listaOfertas = $query->paginate(4);
        }

        $ofertasDisponiveis = [];

        /* LOGICA PARA CONTROLAR AS OFERTAS VISUALIZADAS E NÃO VISUALIZADAS */
        foreach ($listaOfertas as $oferta) {
            $ofertas_visualizada = ContatosDiretosVisualizados::where('id_oferta', $oferta->id_oferta)
            ->where('id_usuario', $usuarioId)
            ->get();

            if (!$ofertas_visualizada->isEmpty()) {
                $ofertasDisponiveis[] = ['status' => 'visualizado', 'oferta' => $oferta];
            } else {
                $ofertasDisponiveis[] = ['status' => 'nao_visualizado', 'oferta' => $oferta];
            }
        }

        return view('usuarioEstudante.todas_ofertas.todas_ofertas_estudante', 
            [
                'usuarioEstudante' => $usuarioId,
                'ofertas' => $ofertasDisponiveis,
                'paginate' => $listaOfertas,
                'pesquisaTitulo' => $pesquisaTitulo,
                'areaConhecimentoSelecionada' => $areaConhecimentoSelecionada,
                'publicoAlvoSelecionado' => $publicoAlvoSelecionado,
                'statusRegistroSelecionado' => $statusRegistroSelecionado,
                'regimeSelecionado' => $regimeSelecionado,
                'listAreaConhecimento' => $listAreaConhecimento,
                'listPublicoAlvo' => $listPublicoAlvo,
            ]
        );
    }

    public function filtragemOfertas(Request $request, $query) {

        $pesquisaTitulo = $request->input('pesquisa_titulo');
        $inputAreaConhecimento = $request->input('area_conhecimento');
        $inputRegime = $request->input('regime');
        $inputStatusRegistro = $request->input('status_registro');
        $inputPublicoAlvo = $request->input('publico_alvo');

        $query->when($pesquisaTitulo, function ($query, $pesquisaTitulo) {
            return $query->where('titulo', 'LIKE', '%' . $pesquisaTitulo . '%');
        });
    
        $query->join('OfertaAcao', 'OfertaAcao.id_oferta', '=', 'Oferta.id_oferta');
    
        $query->when($inputAreaConhecimento, function ($query, $inputAreaConhecimento) {
            return $query->where('Oferta.id_area_conhecimento', $inputAreaConhecimento);
        });

        $query->when($inputRegime, function ($query, $inputRegime) {
            return $query->where('OfertaAcao.regime', $inputRegime);
        }); 
    
        $query->when($inputStatusRegistro, function ($query, $inputStatusRegistro) {
            return $query->where('OfertaAcao.status_registro', $inputStatusRegistro);
        });
    
        $query->when($inputPublicoAlvo, function ($query, $inputPublicoAlvo) {
            return $query->where('OfertaAcao.id_publico_alvo', $inputPublicoAlvo);
        });

        $query->when($pesquisaTitulo, function ($query, $pesquisaTitulo) {
            return $query->where('titulo', 'LIKE', '%' . $pesquisaTitulo . '%');
        });
    
        // Execute a consulta e obtenha os resultados
        $ofertasAcaoFiltradas = $query->paginate(4);
    
        // Retorne os resultados
        return $ofertasAcaoFiltradas;
    }

    public function createContato($ofertaId, Request $request) {
        
        $usuarioId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);

        $mensagem = $request->input('mensagem-contato');
        
        /* CRIAR O NOVO CONTATO */
        // Criação do contato
        $contato = new Contato();
        $contato->id_usuario_origem = $usuarioId;
        $contato->id_usuario_destino = $oferta->usuarioProfessor->id_usuario;
        $contato->id_oferta = $oferta->id_oferta;
        $contato->id_demanda = null;
        $contato->tipo_contato = 'DIRETO';
        $contato->created_at = now();
        $contato->updated_at = null;
        $contato->saveOrFail();

        // Criação do ContatoMensagem
        $contatoMensagem = new ContatoMensagem();
        $contatoMensagem->id_contato = $contato->id_contato;
        $contatoMensagem->id_usuario_origem = $usuarioId;
        $contatoMensagem->id_usuario_destino = $oferta->usuarioProfessor->id_usuario; 
        if (preg_match('/<[^>]*>/', $mensagem)) {
        } else {
            $contatoMensagem->mensagem = $mensagem;
        }
        $contatoMensagem->tipo_mensagem = 'ENVIADA';
        $contatoMensagem->created_at = now();
        $contatoMensagem->updated_at = null;
        $contatoMensagem->saveOrFail();

        /* CRIAR TABELA DE EXCLUSOES PARA CONTATOS DIRETOS E COLOCAR AS OFERTAS LA */
        ContatosDiretosExcluidos::create([
            'id_usuario' => $usuarioId,
            'id_demanda' => null,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->to(route('lista_todas_ofertas_estudante'));
        
    }

    public function list_ofertas_excluidas($usuarioId)
    {

        // Consulta as ofertas excluídas de Contatos Diretos
        $ofertasExcluidasContatos = ContatosDiretosExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_oferta')
            ->toArray();

        return $ofertasExcluidasContatos;
    }

    public function contatos_diretos_remover($ofertaId) {

        $userId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);

        ContatosDiretosExcluidos::create([
            'id_usuario' => $userId,
            'id_demanda' => null,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->route('lista_todas_ofertas_estudante')->with('msg-deletar', 'Oferta removida com Sucesso!');
    }

    public function contato_direto_status_visualizar($ofertaId) {
        $userId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);
    
        $contatoDiretoExistente = ContatosDiretosVisualizados::where('id_usuario', $userId)
            ->where('id_oferta', $oferta->id_oferta)
            ->exists();
        
        if ($contatoDiretoExistente) {
            return back();/* redirect()->route('demanda_matching_index', $demandaId) */;
        }
    
        ContatosDiretosVisualizados::create([
            'id_usuario' => $userId,
            'id_demanda' => null,
            'id_oferta' => $oferta->id_oferta,
            'created_at' => now(),
            'updated_at' => null,
        ]);
    
        return back();
    }
}
