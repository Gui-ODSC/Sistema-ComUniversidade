<?php

namespace App\View\Components\UsuarioProfessor\TodasDemandas;

use App\Models\Demanda;
use App\Models\Oferta;
use App\Models\Usuario;
use App\Models\UsuarioProfessor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\Component;

class ModalContatarDemanda extends Component
{
    public Demanda $demanda;
    public Usuario $usuarioMembro;

    public function __construct(
        public int $idDemanda
    ) {
        $this->demanda = Demanda::findOrFail($idDemanda);
        $this->usuarioMembro = Usuario::findOrFail($this->demanda->id_usuario);
    }

    public function render(): View|Closure|string
    {   
        return view('components.usuario-professor.todas_demandas.modal_contatar_demanda',
        [
            'demanda' => $this->demanda,
            'usuarioMembro' => $this->usuarioMembro,
        ]);
    }
}