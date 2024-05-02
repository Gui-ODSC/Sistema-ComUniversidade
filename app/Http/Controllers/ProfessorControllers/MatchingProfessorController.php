<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\Controller;
use App\Models\Demanda;
use App\Models\MatchingsExcluidos;
use App\Models\MatchingsVisualizados;
use App\Models\Oferta;
use App\Models\OfertaAcao;
use App\Models\OfertaConhecimento;
use Illuminate\Support\Facades\Auth;

class MatchingProfessorController extends Controller
{
    public function matchingList($ofertaId)
    {
        $oferta = Oferta::findOrFail($ofertaId);
        $ofertaTipo = $oferta->tipo;

        if ($ofertaTipo === 'ACAO') {
            
            $oferta = Oferta::findOrFail($ofertaId);
            $ofertaAcao = OfertaAcao::where('id_oferta', $oferta->id_oferta)->first();

            $demandasEncontradas = $this->algoritmoMatchings(
                $oferta->id_oferta,
                $oferta->titulo,
                $oferta->descricao,
                $ofertaAcao->publicoAlvo,
                $oferta->areaConhecimento
            );

            return view(
                'usuarioProfessor/matching_ofertas/visualizar_matching_ofertas',
                [
                    'oferta' => $oferta,
                    'ofertaAcao' => $ofertaAcao,
                    'demandasEncontradas' => $demandasEncontradas,
                ]
            );

        } elseif ($ofertaTipo === 'CONHECIMENTO') {

            $oferta = Oferta::findOrFail($ofertaId);
            $ofertaConhecimento = OfertaConhecimento::where('id_oferta', $oferta->id_oferta)->first();

            $demandasEncontradas = $this->algoritmoMatchings(
                $oferta->id_oferta,
                $oferta->titulo,
                $oferta->descricao,
                null,
                $oferta->areaConhecimento
            );

            return view(
                'usuarioProfessor/matching_ofertas/visualizar_matching_ofertas',
                [
                    'oferta' => $oferta,
                    'ofertaConhecimento' => $ofertaConhecimento,
                    'demandasEncontradas' => $demandasEncontradas,
                ]
            );

        }
    }

    public function algoritmoMatchings($id_oferta, $titulo_oferta, $descricao_oferta, $publicoAlvo_oferta = null, $areaConhecimento_oferta)
    {   
        $id_usuario = Auth::id();

        /* LAÇO PARA PEGAR TODAS AS DEMANDAS DISPONÍVEIS */
        $demandas = Demanda::with(['publicoAlvo', 'areaConhecimento'])->get();

        $matchingsEncontrados = [];

        /* LACO PARA COMPARAR AS OFERTAS COM AS DEMANDAS E ARMAZENAR AS SEMELHANTES */
        foreach($demandas as $demanda) {
            $resultado = 0;

            /* CONTROLE DE EXCLUSAO DE OFERTAS INDESEJADAS NO MATCHING */
            $busca_ofertas_excluidas = MatchingsExcluidos::where('id_demanda', $demanda->id_demanda)
                ->where('id_oferta', $id_oferta)
                ->where('id_usuario', $id_usuario)
                ->get(); 

            if (!$busca_ofertas_excluidas->isEmpty()) {
                continue;
            }
            /* FIM */

            /* COMPARAÇÃO DE TITULOS */
            $resultado_titulo = $this->ratCliff($titulo_oferta, $demanda->titulo);

            /* COPARAÇÃO DE DESCRIÇÕES */
            $resultado_descricao = $this->ratCliff($descricao_oferta, $demanda->descricao);

            $resultado = $resultado_titulo + $resultado_descricao;

            /* LOGICA PARA CONTROLAR AS OFERTAS VISUALIZADAS E NÃO VISUALIZADAS */
            $ofertas_visualizacao = MatchingsVisualizados::where('id_demanda', $demanda->id_demanda)
            ->where('id_oferta', $id_oferta)
            ->where('id_usuario', $id_usuario)
            ->get(); 

            if (!$ofertas_visualizacao->isEmpty()) {
                if ($resultado >= 1.4)
                {
                    if ($resultado === 2.0) {
                        $matchingsEncontrados[] = ['status' => 'visualizado', 'demanda' => $demanda];
                    } else {
                        $matchingsEncontrados[] = ['status' => 'visualizado', 'demanda' => $demanda];
                    }
                } else {
                    continue;
                }
            } else {
                if ($resultado >= 1.4)
                {
                    if ($resultado === 2.0) {
                        $matchingsEncontrados[] = ['status' => 'nao_visualizado', 'demanda' => $demanda];
                    } else {
                        $matchingsEncontrados[] = ['status' => 'nao_visualizado', 'demanda' => $demanda];
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

    public function matching_remover_demanda($demandaId, $ofertaId) {

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

        return redirect()->route('oferta_matching_index', $ofertaId)->with('msg-matching', 'Demanda removida com Sucesso!');
    }

    public function matching_status_visualizar_demanda($demandaId, $ofertaId) {

        $userId = Auth::id();
        $demanda =  Demanda::findOrFail($demandaId);
        $oferta = Oferta::findOrFail($ofertaId);

        $matchingExistente = MatchingsVisualizados::where('id_usuario', $userId)
            ->where('id_demanda', $demanda->id_demanda)
            ->where('id_oferta', $oferta->id_oferta)
            ->exists();

        if ($matchingExistente) {
            return back();
        }

        MatchingsVisualizados::create([
            'id_usuario' => $userId,
            'id_demanda' => $demanda->id_demanda,
            'id_oferta' => $oferta->id_oferta,
            'created_at' => now(),
            'updated_at' => null,
        ]);
    
        return back();
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
        /* 
            O Algoritmo de RatCliff devolve uma porcentagem de que varia de 0.1 até 1.0, 
            mas como a avaliação atual está averiguando titulo e descrição as porcentagens
            foram somadas e o valor máximo possível é 2.0, portanto se uma matching atingir
            1.4 = 70% do valor ele é adicionado a lista de matchings.
        */

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