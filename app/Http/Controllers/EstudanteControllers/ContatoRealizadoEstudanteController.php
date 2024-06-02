<?php

namespace App\Http\Controllers\EstudanteControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\ContatoMensagem;
use App\Models\Demanda;
use App\Models\MatchingsExcluidos;
use App\Models\Oferta;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoRealizadoEstudanteController extends Controller
{

    public function listaContatosRealizados() {
        $usuarioId = Auth::id();

        $contatosRealizados = Contato::where('id_usuario_origem', $usuarioId)
            ->with('oferta', 'demanda', 'usuarioOrigem', 'usuarioDestino', 'contatoMensagem')
            ->orderBy('created_at', 'desc')
            ->paginate(10);

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
                    'demanda' => $contato->demanda,/* possivelmente remover */
                    'oferta' => $contato->oferta,
                    'respostaMensagem' => null,
                ];
            } else {
                $contatosFormatados[] = [
                    'dados' => $contato, 
                    'usuarioEmissor' => $contato->usuarioOrigem,
                    'usuarioReceptor' => $contato->usuarioDestino,
                    'demanda' => $contato->demanda,/* possivelmente remover */
                    'oferta' => $contato->oferta,
                    'respostaMensagem' => $respostaMensagem,
                ];
            }
        }

        return view('usuarioEstudante/contatos_realizados/todos_contatos_realizados',
            [
                'contatosRealizados' => $contatosFormatados,
                'paginate' => $contatosRealizados
            ]
        );
    }
}
