<?php

namespace App\View\Components\UsuarioMembro\Matching;

use App\Models\Demanda;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use App\Models\Oferta;

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
        return view('components.usuario-membro.matching.modal_contatar_matching.modal-descricao-demanda', [
            'demanda' => $this->demanda
        ]);
    }
}