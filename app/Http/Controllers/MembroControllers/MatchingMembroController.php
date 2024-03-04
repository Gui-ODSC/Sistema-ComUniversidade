<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Models\Demanda;
use Illuminate\Http\Request;

class MatchingMembroController extends Controller
{

    public function algoritmoMatchings($titulo_demanda, $descricao_demanda)
    {
        return 'oi';
    }

    public function matchingList($demandaId)
    {
        $demanda = Demanda::findOrFail($demandaId)->first();

        return view(
            'usuarioMembro.matching_demandas.visualizar_matching_demandas',
            [
                'demanda' => $demanda,
            ]
        );
    }
}
