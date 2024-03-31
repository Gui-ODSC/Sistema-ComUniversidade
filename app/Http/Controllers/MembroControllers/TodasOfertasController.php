<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Models\Oferta;
use Illuminate\Http\Request;

class TodasOfertasController extends Controller
{
    public function list() {
        $listOfertas = Oferta::with('usuarioProfessor', 'ofertaConhecimento', 'ofertaAcao', 'areaConhecimento', 'contato')->get();

        return view('usuarioMembro.todas_ofertas.todas_ofertas_membro', 
            [
                'ofertas' => $listOfertas,
            ]
        );
    }
}
