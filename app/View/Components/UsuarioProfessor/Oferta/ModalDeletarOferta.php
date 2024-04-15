<?php

namespace App\View\Components\UsuarioProfessor\Oferta;

use App\Models\Oferta;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDeletarOFerta extends Component
{

    public Oferta $oferta;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $idOferta
    )
    {
        $this->oferta = Oferta::findOrFail($idOferta);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.usuario-professor.oferta.modal-deletar-oferta', [
            'demanda' => $this->oferta,
        ]);
    }
}
