<?php

namespace App\View\Components\UsuarioMembro\Matching;

use App\Http\Controllers\MembroControllers\MatchingMembroController;
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
    private $matchingMembroController;

    public function __construct(
        public int $idMatching,
        public int $idDemanda,
        MatchingMembroController $matchingMembroController
    ) {
        $this->matching = Oferta::with(['ofertaAcao', 'ofertaConhecimento'])->findOrFail($idMatching);
        $usuarioProfessor = UsuarioProfessor::findOrFail($this->matching->id_usuario_professor);
        $this->professor = Usuario::findOrFail($usuarioProfessor->id_usuario);
        $this->matchingMembroController = $matchingMembroController;
        
    }

    public function render(): View|Closure|string
    {   

        /* $matchingMembroController->matching_visualizar($idDemanda, $idMatching); */
        return view('components.usuario-membro.matching.modal_contatar_matching.modal-visualizar-oferta', [
            'oferta' => $this->matching,
            'professor' => $this->professor,
            'id_demanda' => $this->idDemanda
        ]);
    }
}