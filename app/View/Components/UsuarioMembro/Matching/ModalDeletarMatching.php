<?php

namespace App\View\Components\UsuarioMembro\Matching;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Oferta;

class ModalDeletarMatching extends Component
{

    public Oferta $matching;

    public function __construct(
        public int $idMatching,
        public int $idDemanda
       
    ) {
        $this->matching = Oferta::findOrFail($idMatching);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-membro.matching.modal-deletar-matching', [
            'matching' => $this->matching,
            'id_demanda' => $this->idDemanda
        ]);
    }
}