<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\ContatosDiretosExcluidos;
use App\Models\ContatoMensagem;
use App\Models\ContatosDiretosVisualizados;
use App\Models\MatchingsExcluidos;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodasOfertasController extends Controller
{
    public function list() {

        $usuarioId = Auth::id();

        /* DEVOLVER APENAS OS CONTATOS QUE NAO FORAM REALIZADOS AINDA */
        $ofertasNaoMostrar = $this->list_ofertas_excluidas($usuarioId);

        $listOfertas = Oferta::with('usuarioProfessor', 'ofertaConhecimento', 'ofertaAcao', 'areaConhecimento', 'contato')
        ->whereNotIn('id_oferta', $ofertasNaoMostrar)
        ->paginate(1);

        $ofertasDisponiveis = [];

        /* LOGICA PARA CONTROLAR AS OFERTAS VISUALIZADAS E NÃO VISUALIZADAS */
        foreach ($listOfertas as $oferta) {
            $ofertas_visualizada = ContatosDiretosVisualizados::where('id_oferta', $oferta->id_oferta)
            ->where('id_usuario', $usuarioId)
            ->get();

            if (!$ofertas_visualizada->isEmpty()) {
                $ofertasDisponiveis[] = ['status' => 'visualizado', 'oferta' => $oferta];
            } else {
                $ofertasDisponiveis[] = ['status' => 'nao_visualizado', 'oferta' => $oferta];
            }
        }

        return view('usuarioMembro.todas_ofertas.todas_ofertas_membro', 
            [
                'ofertas' => $ofertasDisponiveis,
                'paginate' => $listOfertas,
            ]
        );
    }

    public function create($ofertaId, Request $request) {
        
        $usuarioId = Auth::id();
        $oferta = Oferta::findOrFail($ofertaId);

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
        $contatoMensagem->mensagem = $request->input('mensagem-contato');
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

        return redirect()->to(route('list_todas_ofertas'));
        
    }

    public function list_ofertas_excluidas($usuarioId)
    {
        // Consulta as ofertas excluídas de Matchings
        $ofertasExcluidasMatchings = MatchingsExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_oferta')
            ->toArray();

        // Consulta as ofertas excluídas de Contatos Diretos
        $ofertasExcluidasContatos = ContatosDiretosExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_oferta')
            ->toArray();

        // Mescla as listas de ofertas excluídas
        $ofertasExcluidas = array_merge($ofertasExcluidasMatchings, $ofertasExcluidasContatos);

        /* Remove as duplicatas */
        $ofertasExcluidas = array_unique($ofertasExcluidas);

        return $ofertasExcluidas;
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

        return redirect()->route('list_todas_ofertas')->with('msg-deletar', 'Oferta removida com Sucesso!');
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
