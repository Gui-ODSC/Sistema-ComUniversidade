<?php

namespace App\View\Components\UsuarioProfessor\MatchingAcao;

use App\Models\Demanda;
use App\Models\Usuario;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalVisualizarDemanda extends Component
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

        return view('components.usuario-professor.matching_oferta.modal-visualizar-demanda', [
            'demanda' => $this->matching,
            'usuarioMembro' => $this->usuarioMembro,
            'id_oferta' => $this->idOferta
        ]);
    }
}