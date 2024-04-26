<?php

namespace App\View\Components\UsuarioEstudante\ContatosRealizados;

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
        return view('components.usuario-estudante.contato_realizado.modal-descricao-oferta', [
            'oferta' => $this->oferta
        ]);
    }
}