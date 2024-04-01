<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Models\Demanda;
use App\Models\MatchingsExcluidos;
use App\Models\MatchingsVisualizados;
use App\Models\Oferta;
use App\Models\OfertaAcao;
use App\Models\OfertaConhecimento;
use App\Models\Usuario;
use App\Models\UsuarioProfessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class MatchingMembroController extends Controller
{

    public function matchingList($demandaId)
    {
        $demanda = Demanda::findOrFail($demandaId);

        $ofertasEncontradas = $this->algoritmoMatchings(
            $demanda->id_demanda,
            $demanda->titulo, 
            $demanda->descricao, 
            $demanda->publicoAlvo, 
            $demanda->areaConhecimento
        );

        return view(
            'usuarioMembro/matching_demandas/visualizar_matching_demandas',
            [
                'demanda' => $demanda,
                'ofertasEncontradas' => $ofertasEncontradas,
            ]
        );
    }


    public function algoritmoMatchings($id_demanda, $titulo_demanda, $descricao_demanda, $publicoAlvo_demanda, $areaConhecimento_demanda)
    {   
        $id_usuario = Auth::id();

        /* LAÇO PARA PEGAR TODAS AS OFERTAS DISPONÍVEIS */
        $ofertas = Oferta::with(['ofertaAcao', 'ofertaConhecimento'])->get();

        $matchingsEncontrados = [];

        /* LACO PARA COMPARAR AS OFERTAS COM AS DEMANDAS E ARMAZENAR AS SEMELHANTES */
        foreach($ofertas as $oferta) {
            $resultado = 0;

            /* CONTROLE DE EXCLUSAO DE OFERTAS INDESEJADAS NO MATCHING */
            $busca_ofertas_excluidas = MatchingsExcluidos::where('id_oferta', $oferta->id_oferta)
                ->where('id_demanda', $id_demanda)
                ->where('id_usuario', $id_usuario)
                ->get(); 

            if (!$busca_ofertas_excluidas->isEmpty()) {
                continue;
            }
            /* FIM */

            /* COMPARAÇÃO DE TITULOS */
            $resultado_titulo = $this->ratCliff($oferta->titulo, $titulo_demanda);

            /* COPARAÇÃO DE DESCRIÇÕES */
            $resultado_descricao = $this->ratCliff($oferta->descricao, $descricao_demanda);

            $resultado = $resultado_titulo + $resultado_descricao;

            /* LOGICA PARA CONTROLAR AS OFERTAS VISUALIZADAS E NÃO VISUALIZADAS */
            $ofertas_visualizacao = MatchingsVisualizados::where('id_oferta', $oferta->id_oferta)
            ->where('id_demanda', $id_demanda)
            ->where('id_usuario', $id_usuario)
            ->get(); 

            if (!$ofertas_visualizacao->isEmpty()) {
                if ($resultado >= 1.4)
                {
                    if ($resultado === 2.0) {
                        $matchingsEncontrados[] = ['status' => 'visualizado', 'oferta' => $oferta];
                    } else {
                        $matchingsEncontrados[] = ['status' => 'visualizado', 'oferta' => $oferta];
                    }
                } else {
                    continue;
                }
            } else {
                if ($resultado >= 1.4)
                {
                    if ($resultado === 2.0) {
                        $matchingsEncontrados[] = ['status' => 'nao_visualizado', 'oferta' => $oferta];
                    } else {
                        $matchingsEncontrados[] = ['status' => 'nao_visualizado', 'oferta' => $oferta];
                    }
                } else {
                    continue;
                }
            }
            

            /* DEVE SER USADO O ALGORITMO DE RATCLIFF PARA CADA CAMPO DE COMPARAÇÃO */
            /* TITULO, DESCRICAO, PUBLICOALVO, AREACONHECIMENTO.
                $titulo_demanda = "Professor da disciplina de banco de dados no ensino superior";
                $titulo_oferta = "Ensino da tecnologia MySQL no ensino médio";

                Se a porcentagem der mais de 70% então adicionar na lista de resultados
                print_r($this->ratCliff($s1, $s2));
            */
        }

        return $matchingsEncontrados;
    }


    public function matching_remover($demandaId, $ofertaId) {

        $userId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);
        $oferta = Oferta::findOrFail($ofertaId);

        MatchingsExcluidos::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => $oferta->id_oferta,
            'updated_at' => null,
            'created_at' => now()
        ]);

        return redirect()->route('demanda_matching_index', $demandaId)->with('msg-matching', 'Oferta removida com Sucesso!');
    }


    public function matching_status_visualizar($demandaId, $ofertaId) {
        $userId = Auth::id();
        $demanda = Demanda::findOrFail($demandaId);
        $oferta = Oferta::findOrFail($ofertaId);
    
        $matchingExistente = MatchingsVisualizados::where('id_usuario', $userId)
            ->where('id_demanda', $demanda->id_demanda)
            ->where('id_oferta', $oferta->id_oferta)
            ->exists();
        
        if ($matchingExistente) {
            return back();/* redirect()->route('demanda_matching_index', $demandaId) */;
        }
    
        MatchingsVisualizados::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => $oferta->id_oferta,
            'created_at' => now(),
            'updated_at' => null,
        ]);
    
        return back();/* redirect()->route('demanda_matching_index', $demandaId) */;
    }

    /* ALGORITMO DE MATCHINGS */
    private function getLongestCommonSequences(
        $s1,
        $s2,
        &$results,
    ) {
    
        $split1 = array_filter(str_split($s1), fn($char) => $char !== " ");
        $split2 = array_filter(str_split($s2), fn($char) => $char !== " ");
    
        $common = array_intersect($split1, $split2);
        if (count($common) <= 0) {
            return;
        }
    
        $s1 = trim($s1);
        $s2 = trim($s2);
    
        if ($s1 === "" || $s2 === "") {
            return;
        }
    
        $lcs = "";
        for ($i = 0; $i < strlen($s1); $i++) {
            for ($j = strlen($s1) - $i; $j > 0; $j--) {
                $substring = trim(substr($s1, $i, $j));
                if (strpos($s2, $substring) !== false && strlen($substring) > strlen($lcs)) {
                    $lcs = trim($substring);
                    $results[] = trim($substring);
                    break;
                } 
            }
        }
    
        $newS1 = trim(str_replace($results, "", $s1));
        $newS2 = trim(str_replace($results, "", $s2));
    
        $this->getLongestCommonSequences($newS1, $newS2, $results);
    
    }

    private function ratCliff($s1, $s2)
    {

        $lcss = [];
        $this->getLongestCommonSequences($s1, $s2, $lcss);

        $op1 = 0;
        foreach ($lcss as $lcs) {
            $op1 += strlen($lcs);
        }
        $op1 *= 2;

        $op2 = strlen($s1) + strlen($s2);

        return $op1 / $op2;

    }
}
