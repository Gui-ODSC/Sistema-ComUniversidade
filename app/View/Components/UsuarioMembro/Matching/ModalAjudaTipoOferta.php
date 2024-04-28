<?php

namespace App\View\Components\UsuarioMembro\Oferta;

use App\Models\Oferta;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalAjudaTipoOferta extends Component
{

    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $idDemanda
    )
    {
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.usuario-membro.matching.modal-ajuda-tipo-oferta', [
        ]);
    }
}
