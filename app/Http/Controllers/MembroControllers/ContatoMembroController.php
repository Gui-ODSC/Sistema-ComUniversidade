<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Models\Contato;
use App\Models\Demanda;
use App\Models\MatchingsExcluidos;
use App\Models\Oferta;
use App\View\Components\UsuarioMembro\ModalSucessoContatar;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ContatoMembroController extends Controller
{
    public function criarContato($demandaId, $ofertaId, Request $request) {

        $userId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);
        $oferta = Oferta::findOrFail($ofertaId);

        // Remove a oferta da lista, porque ja foi contatada.
        MatchingsExcluidos::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        // Criação do contato
        $contato = new Contato();
        $contato->id_usuario_origem = $demanda->id_usuario;
        $contato->id_usuario_destino = $oferta->usuarioProfessor->id_usuario;
        $contato->id_oferta = $oferta->id_oferta;
        $contato->id_demanda = $demanda->id_demanda;
        $contato->saveOrFail();

        return redirect()->to(route('matching_visualizar', [$demandaId, $ofertaId]));
    }
}
