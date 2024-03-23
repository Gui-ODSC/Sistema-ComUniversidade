<?php

namespace App\View\Components\UsuarioMembro\Demanda;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Demanda;

class ModalDeletarDemanda extends Component
{

    public Demanda $demanda;

    /**
     * Create a new component instance.
     */
    public function __construct(
        public int $idDemanda
    )
    {
        $this->demanda = Demanda::findOrFail($idDemanda);
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.usuario-membro.demanda.modal-deletar-demanda', [
            'demanda' => $this->demanda,
        ]);
    }
}
