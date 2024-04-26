<?php

namespace App\View\Components\UsuarioEstudante\ContatosRealizados;

use App\Models\Contato;
use App\Models\ContatoMensagem;
use App\Models\UsuarioProfessor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ModalVisualizarContatoRealizado extends Component
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
        $this->professor = UsuarioProfessor::where('id_usuario', $this->contato->usuarioDestino->id_usuario)->first();
        $this->contatoMensagem = ContatoMensagem::where('id_usuario_origem', $usuarioId)
            ->where('id_contato', $idContato)
            ->where('id_usuario_destino', $this->contato->usuarioDestino->id_usuario)
            ->first();
            
        if ($valor = ContatoMensagem::where('id_usuario_destino', $usuarioId)
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
            return view('components.usuario-estudante.contato_realizado.modal_visualizar_contato_realizado', [
                'contato' => $this->contato,
                'usuarioEmissor' => $this->contato->usuarioOrigem,
                'usuarioReceptor' => $this->contato->usuarioDestino,
                'dadosProfessor' => $this->professor,
                'demanda' => $this->contato->demanda,/* possivelmente remover */
                'oferta' => $this->contato->oferta,
                'contatoMensagem' => $this->contatoMensagem,
                'respostaMensagem' => null,
            ]);
        } else {
            return view('components.usuario-estudante.contato_realizado.modal_visualizar_contato_realizado', [
                'contato' => $this->contato,
                'usuarioEmissor' => $this->contato->usuarioOrigem,
                'usuarioReceptor' => $this->contato->usuarioDestino,
                'dadosProfessor' => $this->professor,
                'demanda' => $this->contato->demanda,/* possivelmente remover */
                'oferta' => $this->contato->oferta,
                'contatoMensagem' => $this->contatoMensagem,
                'respostaMensagem' => $this->respostaMensagem,
            ]);
        }
    }
}
