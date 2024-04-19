<?php

namespace App\View\Components\UsuarioProfessor\MatchingAcao;

use App\Models\Demanda;
use App\Models\Oferta;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDescricaoOferta extends Component
{

    public Oferta $oferta;

    public function __construct(
        public int $idOferta
       
    ) {
        $this->oferta = Oferta::findOrFail($idOferta);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-professor.matching_oferta.modal-descricao-oferta', [
            'oferta' => $this->oferta
        ]);
    }
}