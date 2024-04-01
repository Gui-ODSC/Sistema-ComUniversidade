<?php

namespace App\View\Components\UsuarioMembro\TodasOfertas;

use App\Models\Oferta;
use App\Models\Usuario;
use App\Models\UsuarioProfessor;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ModalContatarOferta extends Component
{
    public Oferta $oferta;
    public Usuario $professor;

    public function __construct(
        public int $idOferta
    ) {
        $this->oferta = Oferta::with(['ofertaAcao', 'ofertaConhecimento'])->findOrFail($idOferta);
        $usuarioProfessor = UsuarioProfessor::findOrFail($this->oferta->id_usuario_professor);
        $this->professor = Usuario::findOrFail($usuarioProfessor->id_usuario);
    }

    public function render(): View|Closure|string
    {   
        return view('components.usuario-membro.todas_ofertas.modal_contatar_oferta',
        [
            'oferta' => $this->oferta,
            'professor' => $this->professor,
        ]);
    }
}