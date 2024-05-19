<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OfertaAcaoController;
use App\Http\Controllers\OfertaConhecimentoController;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PublicoAlvoController;
use App\Http\Controllers\TipoAcaoController;
use App\Models\AreaConhecimento;
use App\Models\Demanda;
use App\Models\Oferta;
use App\Models\OfertaAcao;
use App\Models\OfertaConhecimento;
use App\Models\PublicoAlvo;
use Illuminate\Http\Request;

class OfertaConhecimentoProfessorController extends Controller
{
    private $areaConhecimentoController;
    private $ofertaController;
    private $ofertaConhecimentoController;
    private $ofertaModel;
    private $ofertaConhecimentoModel;

    public function __construct(
        AreaConhecimentoController $areaConhecimentoController,
        OfertaController $ofertaController,
        OfertaConhecimentoController $ofertaConhecimentoController,
        Oferta $ofertaModel,
        OfertaConhecimento $ofertaConhecimentoModel,
    )
    {
        $this->areaConhecimentoController = $areaConhecimentoController;
        $this->ofertaController = $ofertaController;
        $this->ofertaConhecimentoController = $ofertaConhecimentoController;
        $this->ofertaModel = $ofertaModel;
        $this->ofertaConhecimentoModel = $ofertaConhecimentoModel;
    }


    /* CRIAÇÃO DE OFERTAS DO TIPO CONHECIMENTO */

    public function createStoreConhecimento(Request $request)
    {
        $validarCamposAreaConhecimento = $this->areaConhecimentoController->validarCamposAreaConhecimento($request);

        $areaConhecimentoId = $validarCamposAreaConhecimento->getData()['id_area_conhecimento'];

        $request->merge([
            'id_area_conhecimento' => $areaConhecimentoId,
            'tipo' => 'CONHECIMENTO',
        ]);

        $validarCamposOferta = $this->ofertaController->validarCamposOfertaCreate($request);
        $validarCamposOfertaConhecimento = $this->ofertaConhecimentoController->validarCamposOfertaConhecimentoCreate($request);

        // Verifica se a validação dos campos de AreaConhecimento falhou
        if ($validarCamposAreaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Área de Conhecimento Inválidos',
                "dados" => $validarCamposAreaConhecimento->errors()->all(),
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
        if ($validarCamposOfertaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOfertaConhecimento->errors()->all(),
            ])->withInput();
        }

        $validatedDataOferta = $validarCamposOferta->validate();
        $validatedDataOfertaAcao = $validarCamposOfertaConhecimento->validate();

        $novaOferta = $this->ofertaModel::create([
            'id_usuario_professor' => $validatedDataOferta['id_usuario_professor'],
            'id_area_conhecimento' => $validatedDataOferta['id_area_conhecimento'],
            'titulo' => $validatedDataOferta['titulo'],
            'descricao' => $validatedDataOferta['descricao'],
            'tipo' => $validatedDataOferta['tipo'],
            'created_at' => now(),
        ]);

        $idOferta = $novaOferta->id_oferta;

        $this->ofertaConhecimentoModel::create([
            'id_oferta' => $idOferta,	
            'tempo_atuacao' => $validatedDataOfertaAcao['tempo_atuacao'],
            'link_lattes' => $validatedDataOfertaAcao['link_lattes'] ?? null,	
            'link_linkedin' => $validatedDataOfertaAcao['link_linkedin'] ?? null,
            'created_at' => now(),	
        ]);

        return redirect()->route('oferta_index')/* ->with('msg-demanda', 'Nova Oferta cadastrada.') */;

    }

    public function editStoreConhecimento(Request $request, $ofertaId)
    {
        $validarCamposAreaConhecimento = $this->areaConhecimentoController->validarCamposAreaConhecimento($request);
        $areaConhecimentoId = $validarCamposAreaConhecimento->getData()['id_area_conhecimento'];

        $request->merge([
            'id_area_conhecimento' => $areaConhecimentoId,
            'tipo' => 'CONHECIMENTO',
        ]);

        $validarCamposOferta = $this->ofertaController->validarCamposOfertaUpdate($request, $ofertaId);
        $validarCamposOfertaConhecimento = $this->ofertaConhecimentoController->validarCamposOfertaConhecimentoUpdate($request, $ofertaId);

        // Verifica se a validação dos campos de AreaConhecimento falhou
        if ($validarCamposAreaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Área de Conhecimento Inválidos',
                "dados" => $validarCamposAreaConhecimento->errors()->all(),
                /* ...$this->listErrosAreaConhecimento($validarCamposAreaConhecimento->errors()) */
            ]);
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOferta->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOferta->errors()->all(),
                /* ...$this->listErrosOferta($validarCamposOferta->errors()) */
            ]);
        }

        // Verifica se a validação dos campos de demanda falhou
        if ($validarCamposOfertaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOfertaConhecimento->errors()->all(),
                /* ...$this->listErrosOfertaConhecimento($validarCamposOfertaConhecimento->errors()) */
            ]);
        }

        $validatedDataOferta = $validarCamposOferta->validate();
        $validatedDataOfertaAcao = $validarCamposOfertaConhecimento->validate();

        $oferta = $this->ofertaModel::findOrFail($ofertaId);
        $ofertaConhecimento = $this->ofertaConhecimentoModel::where('id_oferta', $oferta->id_oferta)->first();

        $oferta->update([
            'id_usuario_professor' => $validatedDataOferta['id_usuario_professor'],
            'id_area_conhecimento' => $validatedDataOferta['id_area_conhecimento'],
            'titulo' => $validatedDataOferta['titulo'],
            'descricao' => $validatedDataOferta['descricao'],
            'tipo' => $validatedDataOferta['tipo'],
            'created_at' => now(),
        ]);

        $ofertaConhecimento->update([
            'id_oferta' => $validatedDataOfertaAcao['id_oferta'],	
            'tempo_atuacao' => $validatedDataOfertaAcao['tempo_atuacao'],
            'link_lattes' => $validatedDataOfertaAcao['link_lattes'] ?? null,	
            'link_linkedin' => $validatedDataOfertaAcao['link_linkedin'] ?? null,
            'created_at' => now(),	
        ]);

        return redirect()->route('oferta_index')->with('msg-oferta', 'Oferta Conhecimento atualizada com sucesso!');
    }

    public function deleteStoreConhecimento($ofertaId)
    {
        $oferta = Oferta::findOrFail($ofertaId);
        $ofertaConhecimento = OfertaConhecimento::where('id_oferta', $oferta->id_oferta)->first();
        $ofertaConhecimento->deleteOrFail();
        $oferta->deleteOrFail();
        return redirect()->route('oferta_index')->with('msg-oferta', 'Oferta Conhecimento excluída com sucesso!');
    }

}
