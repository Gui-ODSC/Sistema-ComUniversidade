<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\ContatoMensagem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoRecebidoProfessorController extends Controller
{
    public function listaContatosRecebidos() {

        $usuarioId = Auth::id();

        $contatosRecebidos = Contato::where('id_usuario_destino', $usuarioId)
            ->with('oferta', 'demanda', 'usuarioOrigem', 'usuarioDestino', 'contatoMensagem')
            ->orderBy('created_at', 'asc')
            ->paginate(3);
        
        $contatosFormatados = [];

        foreach ($contatosRecebidos as $contato) {
            $mensagemRecebida = ContatoMensagem::where('id_usuario_destino', $usuarioId)
            ->where('id_contato', $contato->id_contato)
            ->first();

            if ($valor = ContatoMensagem::where('id_usuario_origem', $usuarioId)
            ->where('id_contato', $contato->id_contato)
            ->first()
            ) {
                $respostaEnviada = $valor;
            } else {
                $respostaEnviada = null;
            }

            if (!is_object($respostaEnviada)) {
                $contatosFormatados[] = [
                    'dados' => $contato, 
                    'usuarioEmissor' => $contato->usuarioOrigem,
                    'usuarioReceptor' => $contato->usuarioDestino,
                    'demanda' => $contato->demanda,/* possivelmente remover */
                    'oferta' => $contato->oferta,
                    'mensagemRecebida' => $mensagemRecebida,
                    'respostaEnviada' => null
                ];
            } else {
                $contatosFormatados[] = [
                    'dados' => $contato, 
                    'usuarioEmissor' => $contato->usuarioOrigem,
                    'usuarioReceptor' => $contato->usuarioDestino,
                    'demanda' => $contato->demanda,/* possivelmente remover */
                    'oferta' => $contato->oferta,
                    'mensagemRecebida' => $mensagemRecebida,
                    'respostaEnviada' => $respostaEnviada
                ];
            }

            
        }

        return view('usuarioProfessor/contatos_recebidos/todos_contatos_recebidos',
            [
                'contatosRecebidos' => $contatosFormatados,
                'paginate' => $contatosRecebidos
            ]
        );
    }

    /* ajustar */
    public function repostaContato($contatoId, Request $request)
    {
        $usuarioId = Auth::id();

        $contato = Contato::findOrFail($contatoId);

        $mensagem = $request->input('resposta-contato');

        $respostaMensagem = new ContatoMensagem();
        $respostaMensagem->id_contato = $contato->id_contato;
        $respostaMensagem->id_usuario_origem = $contato->id_usuario_destino;
        $respostaMensagem->id_usuario_destino = $contato->id_usuario_origem;
        /* VALIDACAO MENSAGEM */
        if (preg_match('/<[^>]*>/', $mensagem)) {
        } else {
            $respostaMensagem->mensagem = $mensagem;
        }
        $respostaMensagem->tipo_mensagem = request()->input('tipo_mensagem');
        $respostaMensagem->created_at = now();
        $respostaMensagem->updated_at = null;
        $respostaMensagem->saveOrFail();

        $mensagemRecebida = ContatoMensagem::where('id_usuario_destino', $usuarioId)
        ->where('id_contato', $contato->id_contato)
        ->first();

        $mensagemRecebida->tipo_mensagem = request()->input('tipo_mensagem');
        $mensagemRecebida->updateOrFail();

        return redirect()->to(route('lista_contatos_recebidos'))->with('msg-contato-respondido', 'Contato Respondido com Sucesso');
    }
}
