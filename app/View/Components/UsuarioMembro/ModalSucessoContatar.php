<?php

namespace App\View\Components\UsuarioMembro;

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
        return view('components.usuario-membro.modal_contatar_matching.modal-contatar-oferta');
    }
}