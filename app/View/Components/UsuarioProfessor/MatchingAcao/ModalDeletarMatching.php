<?php

namespace App\View\Components\UsuarioProfessor\MatchingAcao;

use App\Models\Demanda;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDeletarMatching extends Component
{

    public Demanda $matching;

    public function __construct(
        public int $idMatching,
        public int $idOferta
       
    ) {
        $this->matching = Demanda::findOrFail($idMatching);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-professor.matching_oferta.modal-deletar-matching', [
            'matching' => $this->matching,
            'id_demanda' => $this->idOferta,
        ]);
    }
}