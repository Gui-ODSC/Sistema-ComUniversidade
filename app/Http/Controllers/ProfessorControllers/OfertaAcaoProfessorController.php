<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\OfertaAcaoController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PublicoAlvoController;
use App\Http\Controllers\TipoAcaoController;
use App\Models\AreaConhecimento;
use App\Models\Demanda;
use App\Models\Oferta;
use App\Models\OfertaAcao;
use App\Models\PublicoAlvo;
use Illuminate\Http\Request;

class OfertaAcaoProfessorController extends Controller
{
    private $publicoAlvoController;
    private $areaConhecimentoController;
    private $tipoAcaoController;
    private $ofertaController;
    private $ofertaAcaoController;
    private $ofertaModel;
    private $ofertaAcaoModel;

    public function __construct(
        PublicoAlvoController $publicoAlvoController,
        AreaConhecimentoController $areaConhecimentoController,
        TipoAcaoController $tipoAcaoController,
        OfertaController $ofertaController,
        OfertaAcaoController $ofertaAcaoController,
        Oferta $ofertaModel,
        OfertaAcao $ofertaAcaoModel,
    )
    {
        $this->publicoAlvoController = $publicoAlvoController;
        $this->areaConhecimentoController = $areaConhecimentoController;
        $this->tipoAcaoController = $tipoAcaoController;
        $this->ofertaController = $ofertaController;
        $this->ofertaAcaoController = $ofertaAcaoController;
        $this->ofertaModel = $ofertaModel;
        $this->ofertaAcaoModel = $ofertaAcaoModel;
    }


    /* CRIAÇÃO DE OFERTAS DO TIPO AÇÃO */

    public function createStoreAcao(Request $request)
    {
        $validarCamposAreaConhecimento = $this->areaConhecimentoController->validarCamposAreaConhecimento($request);
        $validarCamposPublicoAlvo = $this->publicoAlvoController->validarCamposPublicoAlvo($request);
        $validarCamposTipoAcao = $this->tipoAcaoController->validarCamposTipoAcao($request);

        $areaConhecimentoId = $validarCamposAreaConhecimento->getData()['id_area_conhecimento'];
        $publicoAlvoId = $validarCamposPublicoAlvo->getData()['id_publico_alvo'];
        $tipoAcaoId = $validarCamposTipoAcao->getData()['id_tipo_acao'];

        $request->merge([
            'id_area_conhecimento' => $areaConhecimentoId,
            'id_publico_alvo' => $publicoAlvoId,
            'id_tipo_acao' => $tipoAcaoId,
            'tipo' => 'ACAO',
        ]);

        $validarCamposOferta = $this->ofertaController->validarCamposOfertaCreate($request);
        $validarCamposOfertaAcao = $this->ofertaAcaoController->validarCamposOfertaAcaoCreate($request);

        // Verifica se a validação dos campos de AreaConhecimento falhou
        if ($validarCamposAreaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Área de Conhecimento Inválidos',
                "dados" => $validarCamposAreaConhecimento->errors()->all(),
                ...$this->listErrosAreaConhecimento($validarCamposAreaConhecimento->errors())
            ]);
        }

        // Verifica se a validação dos campos de Publico Alvo falhou
        if ($validarCamposPublicoAlvo->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposPublicoAlvo->errors()->all(),
                ...$this->listErrosPublicoAlvo($validarCamposPublicoAlvo->errors())
            ]);
        }

        if ($validarCamposTipoAcao->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposTipoAcao->errors()->all(),
                ...$this->listErrosTipoAcao($validarCamposTipoAcao->errors())
            ]);
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOferta->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOferta->errors()->all(),
                ...$this->listErrosOferta($validarCamposOferta->errors())
            ]);
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOfertaAcao->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOfertaAcao->errors()->all(),
                ...$this->listErrosOfertaAcao($validarCamposOfertaAcao->errors())
            ]);
        }

        $validatedDataOferta = $validarCamposOferta->validate();
        $validatedDataOfertaAcao = $validarCamposOfertaAcao->validate();

        $novaOferta = $this->ofertaModel::create([
            'id_usuario_professor' => $validatedDataOferta['id_usuario_professor'],
            'id_area_conhecimento' => $validatedDataOferta['id_area_conhecimento'],
            'titulo' => $validatedDataOferta['titulo'],
            'descricao' => $validatedDataOferta['descricao'],
            'tipo' => $validatedDataOferta['tipo'],
            'created_at' => now(),
        ]);

        $idOferta = $novaOferta->id_oferta;

        $this->ofertaAcaoModel::create([
            'id_oferta' => $idOferta,	
            'id_tipo_acao' => $validatedDataOfertaAcao['id_tipo_acao'],	
            'id_publico_alvo' => $validatedDataOfertaAcao['id_publico_alvo'],	
            'status_registro' => $validatedDataOfertaAcao['status_registro'],
            'duracao' => $validatedDataOfertaAcao['duracao'],	
            'regime' => $validatedDataOfertaAcao['regime'],
            'data_limite' => $validatedDataOfertaAcao['data_limite'] ?? null,	
            'created_at' => now(),	
        ]);

        return redirect()->route('oferta_index')->with('msg-demanda', 'Nova Oferta cadastrada.');

    }

    public function editAcaoIndex($demandaId)
    {
        $demanda = Demanda::findOrFail($demandaId);
        $publicoAlvo = PublicoAlvo::where('id_publico_alvo', $demanda->id_publico_alvo)->first();
        $areaConhecimento = AreaConhecimento::where('id_area_conhecimento', $demanda->id_area_conhecimento)->first();
        $listPublicoAlvo = $this->publicoAlvoController->list();
        $listAreaConhecimento = $this->areaConhecimentoController->list();

        return view(
            'usuarioMembro/demanda/editar_demandas',
            [
                'demanda' => $demanda,
                'publicoAlvo' => $publicoAlvo,
                'areaConhecimento' => $areaConhecimento,
                'listPublicoAlvo' => $listPublicoAlvo,
                'listAreaConhecimento' => $listAreaConhecimento,
            ]
        );
    }

    public function editStore(Request $request, $demandaId)
    {
        $validarCamposAreaConhecimento = $this->areaConhecimentoController->validarCamposAreaConhecimento($request);
        $validarCamposPublicoAlvo = $this->publicoAlvoController->validarCamposPublicoAlvo($request);

        $areaConhecimentoId = $validarCamposAreaConhecimento->getData()['id_area_conhecimento'];

        $publicoAlvoId = $validarCamposPublicoAlvo->getData()['id_publico_alvo'];

        $request->merge([
            'id_area_conhecimento' => $areaConhecimentoId,
            'id_publico_alvo' => $publicoAlvoId
        ]);

        $validarCamposDemanda = $this->demandaController->validarCamposDemandaUpdate($request, $demandaId);

        // Verifica se a validação dos campos de AreaConhecimento falhou
        if ($validarCamposAreaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Área de Conhecimento Inválidos',
                "dados" => $validarCamposAreaConhecimento->errors()->all(),
                ...$this->listErrosAreaConhecimento($validarCamposAreaConhecimento->errors())
            ]);
        }

        // Verifica se a validação dos campos de Publico Alvo falhou
        if ($validarCamposPublicoAlvo->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposPublicoAlvo->errors()->all(),
                ...$this->listErrosPublicoAlvo($validarCamposPublicoAlvo->errors())
            ]);
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposDemanda->fails()) {
            return back()->withErrors([
                "message" => 'Campo de demanda inválidos',
                "dados" => $validarCamposDemanda->errors()->all(),
                ...$this->listErrosDemanda($validarCamposDemanda->errors())
            ]);
        }

        $validatedDataDemanda = $validarCamposDemanda->validate();

        $demanda = $this->demandaModel::findOrFail($demandaId);

        $demanda->update([
            'id_usuario' => $validatedDataDemanda['id_usuario'],
            'id_publico_alvo' => $validatedDataDemanda['id_publico_alvo'],
            'id_area_conhecimento' => $validatedDataDemanda['id_area_conhecimento'],
            'titulo' => $validatedDataDemanda['titulo'],
            'descricao' => $validatedDataDemanda['descricao'],
            'pessoas_afetadas' => $validatedDataDemanda['pessoas_afetadas'],
            'duracao' => $validatedDataDemanda['duracao'],
            'nivel_prioridade' => $validatedDataDemanda['nivel_prioridade'],
            'instituicao_setor' => $validatedDataDemanda['instituicao_setor'],
            'updated_at' => date('Y-m-d H:i:s'),
        ]);

        return redirect()->route('demanda_index')->with('msg-demanda', 'Demanda atualizada com Sucesso.');
    }

    public function deleteStore($demandaId)
    {
        $demanda = Demanda::findOrFail($demandaId);
        $demanda->deleteOrFail();
        return redirect()->route('demanda_index')->with('msg-demanda', 'Demanda excluída com sucesso!');
    }

    /* TRATAMENTO DE ERROS */

    private function listErrosAreaConhecimento($errors)
    {
        return [
            "areaConhecimento" => $errors->first('nome')
        ];
    }

    private function listErrosPublicoAlvo($errors)
    {
        return [
            "publico_alvo" => $errors->first('nome')
        ];
    }

    private function listErrosTipoAcao($errors)
    {
        return [
            "tipo_acao" => $errors->first('nome')
        ];
    }

    private function listErrosOferta($errors)
    {
        return [
            'titulo' => $errors->first('titulo'),	
            'descricao' => $errors->first('descricao'),	
        ];
    }

    private function listErrosOfertaAcao($errors)
    {
        return [
            'status_registro' => $errors->first('status_registro'),
            'duracao' => $errors->first('duracao'),
            'regime' => $errors->first('regime'),
            'data_limite' => $errors->first('data_limite'),
        ];
    }
}
