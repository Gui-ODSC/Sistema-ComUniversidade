<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\ContatosDiretosExcluidos;
use App\Models\ContatoMensagem;
use App\Models\ContatosDiretosVisualizados;
use App\Models\Demanda;
use App\Models\MatchingsExcluidos;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TodasDemandasController extends Controller
{
    public function listaDemandas() { 

        $usuarioId = Auth::id();

        /* DEVOLVER APENAS OS CONTATOS QUE NAO FORAM REALIZADOS AINDA */
        $demandasNaoMostrar = $this->list_demandas_excluidas($usuarioId);

        $listDemandas = Demanda::with('usuario', 'publicoAlvo', 'areaConhecimento', 'contato')
        ->whereNotIn('id_demanda', $demandasNaoMostrar)
        ->paginate(2);

        $demandasDisponiveis = [];

        /* LOGICA PARA CONTROLAR AS OFERTAS VISUALIZADAS E NÃO VISUALIZADAS */
        foreach ($listDemandas as $demanda) {
            $demandas_visualizada = ContatosDiretosVisualizados::where('id_demanda', $demanda->id_demanda)
            ->where('id_usuario', $usuarioId)
            ->get();

            if (!$demandas_visualizada->isEmpty()) {
                $demandasDisponiveis[] = ['status' => 'visualizado', 'demanda' => $demanda];
            } else {
                $demandasDisponiveis[] = ['status' => 'nao_visualizado', 'demanda' => $demanda];
            }
        }

        return view('usuarioProfessor.todas_demandas.todas_demandas_professor', 
            [
                'demandas' => $demandasDisponiveis,
                'paginate' => $listDemandas,
            ]
        );
    }

    public function createContato($demandaId, Request $request) {
        
        $usuarioId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);

        $mensagem = $request->input('mensagem-contato');

        /* CRIAR O NOVO CONTATO */
        // Criação do contato
        $contato = new Contato();
        $contato->id_usuario_origem = $usuarioId;
        $contato->id_usuario_destino = $demanda->id_usuario;
        $contato->id_oferta = null;
        $contato->id_demanda = $demanda->id_demanda;
        $contato->tipo_contato = 'DIRETO';
        $contato->created_at = now();
        $contato->updated_at = null;
        $contato->saveOrFail();

        // Criação do ContatoMensagem
        $contatoMensagem = new ContatoMensagem();
        $contatoMensagem->id_contato = $contato->id_contato;
        $contatoMensagem->id_usuario_origem = $usuarioId;
        $contatoMensagem->id_usuario_destino = $demanda->id_usuario; 
        /* VALIDACAO MENSAGEM */
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
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => null,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->to(route('lista_todas_demandas'));
        
    }

    public function list_demandas_excluidas($usuarioId) 
    {
        // Consulta as ofertas excluídas de Matchings
        $demandasExcluidasMatchings = MatchingsExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_demanda')
            ->toArray();

        // Consulta as ofertas excluídas de Contatos Diretos
        $demandasExcluidasContatos = ContatosDiretosExcluidos::where('id_usuario', $usuarioId)
            ->pluck('id_demanda')
            ->toArray();

        // Mescla as listas de ofertas excluídas
        $demandasExcluidas = array_merge($demandasExcluidasMatchings, $demandasExcluidasContatos);

        /* Remove as duplicatas */
        $demandasExcluidas = array_unique($demandasExcluidas);

        return $demandasExcluidas;
    }

    public function contatos_diretos_remover($demandaId) { 

        $userId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);

        ContatosDiretosExcluidos::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => null,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->route('lista_todas_demandas')->with('msg-deletar', 'Demanda removida com Sucesso!');
    }

    public function contato_direto_status_visualizar($demandaId) { 
        $userId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);
    
        $contatoDiretoExistente = ContatosDiretosVisualizados::where('id_usuario', $userId)
            ->where('id_demanda', $demanda->id_demanda)
            ->exists();
        
        if ($contatoDiretoExistente) {
            return back();
        }
    
        ContatosDiretosVisualizados::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => null,
            'created_at' => now(),
            'updated_at' => null,
        ]);
    
        return back();
    }
}
