<?php

namespace App\View\Components\UsuarioMembro\ContatosRecebidos;

use App\Models\Contato;
use App\Models\ContatoMensagem;
use App\Models\UsuarioProfessor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ModalVisualizarContatoRecebido extends Component
{

    public Contato $contato;
    public UsuarioProfessor $professor;
    public ContatoMensagem $contatoMensagem;
    public $respostaMensagem;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $idContato
    )
    {
        $usuarioId = Auth::id();
        $this->contato = Contato::with(['demanda', 'oferta', 'usuarioOrigem', 'usuarioDestino','contatoMensagem'])->findOrFail($idContato);
        $this->professor = UsuarioProfessor::where('id_usuario', $this->contato->usuarioOrigem->id_usuario)->first();
        $this->contatoMensagem = ContatoMensagem::where('id_usuario_destino', $usuarioId)
            ->where('id_contato', $idContato)
            ->first();

        if ($valor = ContatoMensagem::where('id_usuario_origem', $usuarioId)
        ->where('id_contato', $idContato)
        ->first()
        ) {
            $this->respostaMensagem = $valor;
        } else {
            $this->respostaMensagem = null;
        }
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        if (!is_object($this->respostaMensagem)) {
            return view('components.usuario-membro.contato_recebido.modal_visualizar_contato_recebido', [
                'contato' => $this->contato,
                'usuarioEmissor' => $this->contato->usuarioOrigem,
                'usuarioReceptor' => $this->contato->usuarioDestino,
                'dadosProfessor' => $this->professor,
                'demanda' => $this->contato->demanda,
                'oferta' => $this->contato->oferta,/* possivelmente remover */
                'contatoMensagem' => $this->contatoMensagem,
                'respostaMensagem' => null
            ]);
        } else {
            return view('components.usuario-membro.contato_recebido.modal_visualizar_contato_recebido', [
                'contato' => $this->contato,
                'usuarioEmissor' => $this->contato->usuarioOrigem,
                'usuarioReceptor' => $this->contato->usuarioDestino,
                'dadosProfessor' => $this->professor,
                'demanda' => $this->contato->demanda,
                'oferta' => $this->contato->oferta,/* possivelmente remover */
                'contatoMensagem' => $this->contatoMensagem,
                'respostaMensagem' => $this->respostaMensagem,
            ]);
        }
    }
}
