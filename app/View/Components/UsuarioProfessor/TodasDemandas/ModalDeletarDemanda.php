<?php

namespace App\View\Components\UsuarioProfessor\TodasDemandas;

use App\Models\Demanda;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDeletarDemanda extends Component
{

    public Demanda $demanda;

    public function __construct(
        public int $idDemanda
       
    ) {
        $this->demanda = Demanda::findOrFail($idDemanda);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-professor.todas_demandas.modal_deletar_demanda', [
            'demanda' => $this->demanda,
        ]);
    }
}