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
                ...$this->listErrosAreaConhecimento($validarCamposAreaConhecimento->errors())
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
        if ($validarCamposOfertaConhecimento->fails()) {
            return back()->withErrors([
                "message" => 'Campo de Oferta inválidos',
                "dados" => $validarCamposOfertaConhecimento->errors()->all(),
                ...$this->listErrosOfertaConhecimento($validarCamposOfertaConhecimento->errors())
            ]);
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

    private function listErrosOferta($errors)
    {
        return [
            'titulo' => $errors->first('titulo'),	
            'descricao' => $errors->first('descricao'),	
        ];
    }

    private function listErrosOfertaConhecimento($errors)
    {
        return [
            'tempo_atuacao' => $errors->first('tempo_atuacao'),
            'link_lattes' => $errors->first('link_lattes'),
            'link_linkedin' => $errors->first('link_linkedin'),
        ];
    }
}
