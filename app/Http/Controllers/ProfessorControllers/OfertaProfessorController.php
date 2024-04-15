<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\AreaConhecimentoController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\OfertaController;
use App\Http\Controllers\PublicoAlvoController;
use App\Http\Controllers\TipoAcaoController;
use App\Models\AreaConhecimento;
use App\Models\Demanda;
use App\Models\Oferta;
use App\Models\PublicoAlvo;
use App\Models\UsuarioProfessor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OfertaProfessorController extends Controller
{
    private $publicoAlvoController;
    private $areaConhecimentoController;
    private $tipoAcaoController;
    private $ofertaController;
    private $ofertaModel;

    public function __construct(
        PublicoAlvoController $publicoAlvoController,
        AreaConhecimentoController $areaConhecimentoController,
        TipoAcaoController $tipoAcaoController,
        OfertaController $ofertaController,
        Oferta $ofertaModel
    )
    {
        $this->publicoAlvoController = $publicoAlvoController;
        $this->areaConhecimentoController = $areaConhecimentoController;
        $this->tipoAcaoController = $tipoAcaoController;
        $this->ofertaController = $ofertaController;
        $this->ofertaModel = $ofertaModel;
    }

    public function index()
    {
        $userId = Auth::id();
        $professor = UsuarioProfessor::where('id_usuario', $userId)->firstOrFail();

        $listOfertas = Oferta::where('id_usuario_professor', $professor->id_usuario_professor)
            ->with(['areaConhecimento'])->orderby('created_at', 'ASC')->paginate(4);

        return view(
            'usuarioProfessor/oferta/minhas_ofertas', 
            [
                'ofertas' => $listOfertas
            ]
        );
    }

    /* MOSTRAR TELA DE CADASTRO DE OFERTAS */

    public function createIndex()
    {
        $listPublicoAlvo = $this->publicoAlvoController->list();
        $listAreaConhecimento = $this->areaConhecimentoController->list();
        $listTipoAcao = $this->tipoAcaoController->list();
        
        return view(
            'usuarioProfessor/oferta/cadastrar_ofertas',
            [
                'listPublicoAlvo' => $listPublicoAlvo,
                'listAreaConhecimento' => $listAreaConhecimento,
                'listTipoAcao' => $listTipoAcao,
            ]
        );
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
