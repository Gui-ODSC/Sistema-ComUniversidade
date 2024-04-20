<?php

namespace App\View\Components\UsuarioProfessor\ContatosRealizados;

use App\Models\Demanda;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalDescricaoDemanda extends Component
{

    public Demanda $demanda;

    public function __construct(
        public int $idDemanda
       
    ) {
        $this->demanda = Demanda::findOrFail($idDemanda);
    }

    public function render(): View|Closure|string
    {
        return view('components.usuario-professor.contato_realizado.modal-descricao-oferta', [
            'demanda' => $this->demanda
        ]);
    }
}