<?php

namespace App\View\Components\UsuarioProfessor\MatchingAcao;

use App\Http\Controllers\MembroControllers\MatchingMembroController;
use App\Models\Demanda;
use App\Models\Usuario;
use App\Models\UsuarioProfessor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Oferta;

class ModalContatarDemanda extends Component
{
    public Demanda $matching;
    public Usuario $usuarioMembro;

    public function __construct(
        public int $idMatching,
        public int $idOferta,
    ) {
        $this->matching = Demanda::findOrFail($idMatching);
        $this->usuarioMembro = Usuario::findOrFail($this->matching->id_usuario);
    }

    public function render(): View|Closure|string
    {   

        return view('components.usuario-professor.matching_oferta.modal-contatar-demanda', [
            'demanda' => $this->matching,
            'id_oferta' => $this->idOferta,
            'usuarioMembro' => $this->usuarioMembro,
        ]);
    }
}