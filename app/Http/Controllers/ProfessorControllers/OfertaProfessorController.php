<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PublicoAlvoController;
use App\Http\Controllers\TipoAcaoController;
use App\Models\AreaConhecimento;
use App\Models\Oferta;
use App\Models\PublicoAlvo;
use App\Models\TipoAcao;
use App\Models\UsuarioProfessor;
use Illuminate\Support\Facades\Auth;

class OfertaProfessorController extends Controller
{
    private $publicoAlvoController;
    private $areaConhecimentoController;
    private $tipoAcaoController;
    private $ofertaController;
    private $ofertaModel;
    private $ofertaAcaoProfessorController;

    public function __construct(
        PublicoAlvoController $publicoAlvoController,
        AreaConhecimentoController $areaConhecimentoController,
        TipoAcaoController $tipoAcaoController,
        OfertaController $ofertaController,
        Oferta $ofertaModel,
        OfertaAcaoProfessorController $ofertaAcaoProfessorController
    )
    {
        $this->publicoAlvoController = $publicoAlvoController;
        $this->areaConhecimentoController = $areaConhecimentoController;
        $this->tipoAcaoController = $tipoAcaoController;
        $this->ofertaController = $ofertaController;
        $this->ofertaModel = $ofertaModel;
        $this->ofertaAcaoProfessorController = $ofertaAcaoProfessorController;
    }

    public function index()
    {
        $userId = Auth::id();
        $professor = UsuarioProfessor::where('id_usuario', $userId)->firstOrFail();

        $listOfertas = Oferta::where('id_usuario_professor', $professor->id_usuario_professor)
            ->with(['areaConhecimento'])
            ->orderby('created_at', 'ASC')
            ->paginate(5);

        /* PEDACO PARA TRATAR DA DATA LIMITE SE DER PROBLEMA ARRANCAR*/
        foreach ($listOfertas as $oferta) {
            if ($oferta->tipo == 'ACAO' && $oferta->ofertaAcao && $oferta->ofertaAcao->data_limite !== null) {
                if ($oferta->ofertaAcao->data_limite > now()) {
                    continue;
                } else {
                    $this->ofertaAcaoProfessorController->deleteStoreAcaoDataLimite($oferta->id_oferta);
                }
            }
        }

        // Recarrega a lista de ofertas após a exclusão das ofertas vencidas
        $listOfertas = Oferta::where('id_usuario_professor', $professor->id_usuario_professor)
            ->with(['areaConhecimento'])
            ->orderby('created_at', 'ASC')
            ->paginate(5);

        /* FIM */
        
        return view('usuarioProfessor/oferta/minhas_ofertas', [
            'ofertas' => $listOfertas,
            'usuarioProfessor' => $userId
        ]);
    }

    /* MOSTRAR TELA DE CADASTRO DE OFERTAS */

    public function createIndex()
    {
        $usuarioId = Auth::id();
        $listPublicoAlvo = $this->publicoAlvoController->list();
        $listAreaConhecimento = $this->areaConhecimentoController->list();
        $listTipoAcao = $this->tipoAcaoController->list();
        
        return view(
            'usuarioProfessor/oferta/cadastrar_ofertas',
            [
                'usuarioProfessor' => $usuarioId,
                'listPublicoAlvo' => $listPublicoAlvo,
                'listAreaConhecimento' => $listAreaConhecimento,
                'listTipoAcao' => $listTipoAcao,
            ]
        );
    }

    public function editIndexAcao($ofertaId)
    {
        $oferta = Oferta::with(['ofertaAcao'])->findOrFail($ofertaId);
        $publicoAlvo = PublicoAlvo::where('id_publico_alvo', $oferta->ofertaAcao->id_publico_alvo)->first();
        $areaConhecimento = AreaConhecimento::where('id_area_conhecimento', $oferta->id_area_conhecimento)->first();
        $tipoAcao = TipoAcao::where('id_tipo_acao', $oferta->ofertaAcao->id_tipo_acao)->first();
        $listPublicoAlvo = $this->publicoAlvoController->list();
        $listAreaConhecimento = $this->areaConhecimentoController->list();
        $listTipoAcao = $this->tipoAcaoController->list();
        $data_limite_formatada = $oferta->ofertaAcao->data_limite ? date('Y-m-d', strtotime($oferta->ofertaAcao->data_limite)) : '';


        return view(
            'usuarioProfessor/oferta/editar_ofertas_acao',
            [
                'oferta' => $oferta,
                'publicoAlvo' => $publicoAlvo,
                'areaConhecimento' => $areaConhecimento,
                'tipoAcao' => $tipoAcao,
                'listPublicoAlvo' => $listPublicoAlvo,
                'listAreaConhecimento' => $listAreaConhecimento,
                'listTipoAcao' => $listTipoAcao,
                'dataLimite' => $data_limite_formatada,
            ]
        );
    }

    public function editIndexConhecimento($ofertaId)
    {
        $oferta = Oferta::with(['ofertaConhecimento'])->findOrFail($ofertaId);
        $areaConhecimento = AreaConhecimento::where('id_area_conhecimento', $oferta->id_area_conhecimento)->first();
        $listAreaConhecimento = $this->areaConhecimentoController->list();

        return view(
            'usuarioProfessor/oferta/editar_ofertas_conhecimento',
            [
                'oferta' => $oferta,
                'areaConhecimento' => $areaConhecimento,
                'listAreaConhecimento' => $listAreaConhecimento,
            ]
        );
    }

    
}
