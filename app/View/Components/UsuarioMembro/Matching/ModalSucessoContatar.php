<?php

namespace App\View\Components\UsuarioMembro\Matching;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalSucessoContatar extends Component
{
    public function __construct(
    ) {
    }

    public function render(): View|Closure|string
    {   
        return view('components.usuario-membro.matching.modal_contatar_matching.modal-contatar-oferta');
    }
}