<?php

namespace App\View\Components\UsuarioMembro\ContatosRealizados;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Oferta;

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
        return view('components.usuario-membro.contato_realizado.modal-descricao-oferta', [
            'oferta' => $this->oferta
        ]);
    }
}