<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OfertaAcaoController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PublicoAlvoController;
use App\Http\Controllers\TipoAcaoController;
use App\Models\Oferta;
use App\Models\OfertaAcao;
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
            ])->withInput();
        }

        // Verifica se a validação dos campos de Publico Alvo falhou
        if ($validarCamposPublicoAlvo->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposPublicoAlvo->errors()->all(),
            ])->withInput();
        }

        if ($validarCamposTipoAcao->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposTipoAcao->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOferta->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOferta->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOfertaAcao->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOfertaAcao->errors()->all(),
            ])->withInput();
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

        return redirect()->route('oferta_index')/* ->with('msg-oferta', 'Nova Oferta cadastrada.') */;

    }

    public function editStoreAcao(Request $request, $ofertaId)
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

        $validarCamposOferta = $this->ofertaController->validarCamposOfertaUpdate($request, $ofertaId);
        $validarCamposOfertaAcao = $this->ofertaAcaoController->validarCamposOfertaAcaoUpdate($request, $ofertaId);

        // Verifica se a validação dos campos de AreaConhecimento falhou
        if ($validarCamposAreaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Área de Conhecimento Inválidos',
                "dados" => $validarCamposAreaConhecimento->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos de Publico Alvo falhou
        if ($validarCamposPublicoAlvo->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposPublicoAlvo->errors()->all(),
            ])->withInput();
        }

        if ($validarCamposTipoAcao->fails()) {
            return back()->withErrors([
                "message" => 'Campo de publico alvo inválidos',
                "dados" => $validarCamposTipoAcao->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOferta->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOferta->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOfertaAcao->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOfertaAcao->errors()->all(),
            ])->withInput();
        }

        $validatedDataOferta = $validarCamposOferta->validate();
        $validatedDataOfertaAcao = $validarCamposOfertaAcao->validate();

        $oferta = $this->ofertaModel::findOrFail($ofertaId);
        $ofertaAcao = $this->ofertaAcaoModel::where('id_oferta', $oferta->id_oferta)->first();

        $oferta->update([
            'id_usuario_professor' => $validatedDataOferta['id_usuario_professor'],
            'id_area_conhecimento' => $validatedDataOferta['id_area_conhecimento'],
            'titulo' => $validatedDataOferta['titulo'],
            'descricao' => $validatedDataOferta['descricao'],
            'tipo' => $validatedDataOferta['tipo'],
            'updated_at' => now(),
        ]);

        $ofertaAcao->update([
            'id_oferta' => $validatedDataOfertaAcao['id_oferta'],	
            'id_tipo_acao' => $validatedDataOfertaAcao['id_tipo_acao'],	
            'id_publico_alvo' => $validatedDataOfertaAcao['id_publico_alvo'],	
            'status_registro' => $validatedDataOfertaAcao['status_registro'],
            'duracao' => $validatedDataOfertaAcao['duracao'],	
            'regime' => $validatedDataOfertaAcao['regime'],
            'data_limite' => $validatedDataOfertaAcao['data_limite'] ?? null,	
            'updated_at' => now(),	
        ]);
        
        return redirect()->route('oferta_index')->with('msg-oferta', 'Oferta Ação Atualizada com Sucesso!');
    }

    public function deleteStoreAcao($ofertaId)
    {
        $oferta = Oferta::findOrFail($ofertaId);
        $ofertaAcao = OfertaAcao::where('id_oferta', $oferta->id_oferta)->first();
        $ofertaAcao->deleteOrFail();
        $oferta->deleteOrFail();

        return redirect()->route('oferta_index')->with('msg-oferta', 'Oferta Ação excluída com sucesso!');
    }

    public function deleteStoreAcaoDataLimite($ofertaId)
    {
        $oferta = Oferta::findOrFail($ofertaId);
        $ofertaAcao = OfertaAcao::where('id_oferta', $oferta->id_oferta)->first();
        $ofertaAcao->deleteOrFail();
        $oferta->deleteOrFail();

    }

}
