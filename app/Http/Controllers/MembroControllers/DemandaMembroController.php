<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\DemandaController;
use App\Http\Controllers\PublicoAlvoController;
use App\Models\AreaConhecimento;
use App\Models\Demanda;
use App\Models\PublicoAlvo;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DemandaMembroController extends Controller
{
    private $publicoAlvoController;
    private $areaConhecimentoController;
    private $demandaController;
    private $demandaModel;

    public function __construct(
        PublicoAlvoController $publicoAlvoController,
        AreaConhecimentoController $areaConhecimentoController,
        DemandaController $demandaController,
        Demanda $demandaModel
    )
    {
        $this->publicoAlvoController = $publicoAlvoController;
        $this->areaConhecimentoController = $areaConhecimentoController;
        $this->demandaController = $demandaController;
        $this->demandaModel = $demandaModel;
    }

    public function index()
    {
        $userId = Auth::id();

        $listDemandas = Demanda::where('id_usuario', $userId)
            ->with(['areaConhecimento', 'publicoAlvo'])->orderby('created_at', 'ASC')->paginate(2);

        return view(
            'usuarioMembro/demanda/minhas_demandas', 
            [
                'demandas' => $listDemandas
            ]
        );
    }

    public function createIndex()
    {
        $listPublicoAlvo = $this->publicoAlvoController->list();
        $listAreaConhecimento = $this->areaConhecimentoController->list();

        return view(
            'usuarioMembro/demanda/cadastrar_demandas',
            [
                'listPublicoAlvo' => $listPublicoAlvo,
                'listAreaConhecimento' => $listAreaConhecimento,
            ]
        );
    }

    public function createStore(Request $request)
    {
        $validarCamposAreaConhecimento = $this->areaConhecimentoController->validarCamposAreaConhecimento($request);
        $validarCamposPublicoAlvo = $this->publicoAlvoController->validarCamposPublicoAlvo($request);

        $areaConhecimentoId = $validarCamposAreaConhecimento->getData()['id_area_conhecimento'];

        $publicoAlvoId = $validarCamposPublicoAlvo->getData()['id_publico_alvo'];

        $request->merge([
            'id_area_conhecimento' => $areaConhecimentoId,
            'id_publico_alvo' => $publicoAlvoId
        ]);

        $validarCamposDemanda = $this->demandaController->validarCamposDemandaCreate($request);

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

        $this->demandaModel::create([
            'id_usuario' => $validatedDataDemanda['id_usuario'],
            'id_publico_alvo' => $validatedDataDemanda['id_publico_alvo'],
            'id_area_conhecimento' => $validatedDataDemanda['id_area_conhecimento'],
            'titulo' => $validatedDataDemanda['titulo'],
            'descricao' => $validatedDataDemanda['descricao'],
            'pessoas_afetadas' => $validatedDataDemanda['pessoas_afetadas'],
            'duracao' => $validatedDataDemanda['duracao'],
            'nivel_prioridade' => $validatedDataDemanda['nivel_prioridade'],
            'instituicao_setor' => $validatedDataDemanda['instituicao_setor'],
            'created_at' => now(),
        ]);

        return redirect()->route('demanda_index')->with('msg-demanda', 'Nova necessidade cadastrada.');

    }

    public function editIndex($demandaId)
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

        return redirect()->route('demanda_index')->with('msg-demanda', 'Necessidade atualizada com Sucesso.');
    }

    public function deleteStore($demandaId)
    {
        $demanda = Demanda::findOrFail($demandaId);
        $demanda->deleteOrFail();
        return redirect()->route('demanda_index')->with('msg-demanda', 'Necessidade excluída com sucesso!');
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

    private function listErrosDemanda($errors)
    {
        return [
            'id_usuario' => $errors->first('id_usuario'),
            'id_publico_alvo' => $errors->first('id_publico_alvo'),
            'id_area_conhecimento' => $errors->first('id_area_conhecimento'),
            'titulo' => $errors->first('titulo'),
            'descricao' => $errors->first('descricao'),
            'pessoas_afetadas' => $errors->first('pessoas_afetadas'),
            'duracao' => $errors->first('duracao'),
            'nivel_prioridade' => $errors->first('nivel_prioridade'),
            'instituicao_setor' => $errors->first('instituicao_setor'),
        ];
    }
}
