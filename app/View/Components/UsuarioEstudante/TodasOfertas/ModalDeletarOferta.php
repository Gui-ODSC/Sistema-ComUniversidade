<?php

namespace App\View\Components\UsuarioEstudante\TodasOfertas;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Oferta;

class ModalDeletarOferta extends Component
{

    public Oferta $oferta;

    public function __construct(
        public int $idOferta
       
    ) {
        $this->oferta = Oferta::findOrFail($idOferta);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-estudante.todas_ofertas.modal_deletar_oferta', [
            'oferta' => $this->oferta,
        ]);
    }
}