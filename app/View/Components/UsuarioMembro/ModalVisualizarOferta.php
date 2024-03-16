<?php

namespace App\View\Components\UsuarioMembro;

use App\Models\Usuario;
use App\Models\UsuarioProfessor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Oferta;

class ModalVisualizarOferta extends Component
{
    public Oferta $matching;
    public Usuario $professor;

    public function __construct(
        public int $idMatching,
        public int $idDemanda
       
    ) {
        $this->matching = Oferta::with(['ofertaAcao', 'ofertaConhecimento'])->findOrFail($idMatching);
        $usuarioProfessor = UsuarioProfessor::findOrFail($this->matching->id_usuario_professor);
        $this->professor = Usuario::findOrFail($usuarioProfessor->id_usuario);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-membro.modal_contatar_matching.modal-visualizar-oferta', [
            'oferta' => $this->matching,
            'professor' => $this->professor,
            'id_demanda' => $this->idDemanda
        ]);
    }
}