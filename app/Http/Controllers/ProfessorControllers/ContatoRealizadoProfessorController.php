<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\ContatoMensagem;
use App\Models\Demanda;
use App\Models\MatchingsExcluidos;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoRealizadoProfessorController extends Controller
{

    public function listaContatosRealizados() {
        
        $usuarioId = Auth::id();

        $contatosRealizados = Contato::where('id_usuario_origem', $usuarioId)
            ->with('oferta', 'demanda', 'usuarioOrigem', 'usuarioDestino', 'contatoMensagem')
            ->orderBy('created_at', 'asc')
            ->paginate(1);

        // Criar arrays vazios para armazenar os resultados
        $contatosFormatados = [];

        // Iterar sobre cada contato realizado para formatar os dados
        foreach ($contatosRealizados as $contato) {

            if ($valor = ContatoMensagem::where('id_usuario_destino', $usuarioId)
            ->where('id_contato', $contato->id_contato)
            ->first()
            ) {
                $respostaMensagem = $valor;
            } else {
                $respostaMensagem = null;
            }

            if (!is_object($respostaMensagem)) {
                $contatosFormatados[] = [
                    'dados' => $contato, 
                    'usuarioEmissor' => $contato->usuarioOrigem,
                    'usuarioReceptor' => $contato->usuarioDestino,
                    'demanda' => $contato->demanda,
                    'oferta' => $contato->oferta,/* possivelmente remover */
                    'respostaMensagem' => null,
                ];
            } else {
                $contatosFormatados[] = [
                    'dados' => $contato, 
                    'usuarioEmissor' => $contato->usuarioOrigem,
                    'usuarioReceptor' => $contato->usuarioDestino,
                    'demanda' => $contato->demanda,
                    'oferta' => $contato->oferta,/* possivelmente remover */
                    'respostaMensagem' => $respostaMensagem,
                ];
            }
        }

        return view('usuarioProfessor/contatos_realizados/todos_contatos_realizados',
            [
                'contatosRealizados' => $contatosFormatados,
                'paginate' => $contatosRealizados
            ]
        );
    }

    public function createContato($demandaId, $ofertaId, Request $request) {

        $userId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);
        $oferta = Oferta::findOrFail($ofertaId);

        // Criação do contato
        $contato = new Contato();
        $contato->id_usuario_origem = $oferta->usuarioProfessor->id_usuario;
        $contato->id_usuario_destino = $demanda->id_usuario;
        $contato->id_oferta = $oferta->id_oferta;
        $contato->id_demanda = $demanda->id_demanda;
        $contato->tipo_contato = 'MATCHING';
        $contato->created_at = now();
        $contato->updated_at = null;
        $contato->saveOrFail();
        
        // Criação do ContatoMensagem
        $mensagem = $request->input('mensagem-contato');
        
        $contatoMensagem = new ContatoMensagem();
        $contatoMensagem->id_contato = $contato->id_contato;
        $contatoMensagem->id_usuario_origem = $oferta->usuarioProfessor->id_usuario;
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

        // Remove a oferta da lista, porque ja foi Realizada.
        MatchingsExcluidos::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->to(route('matching_visualizar_demanda', [$demandaId, $ofertaId]));
    }
}
