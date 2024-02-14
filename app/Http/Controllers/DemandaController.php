<?php

namespace App\Http\Controllers;

use App\Enums\DuracaoDemandaEnum;
use App\Enums\NivelPrioridadeDemandaEnum;
use App\Models\AreaConhecimento;
use App\Models\Demanda;
use App\Models\PublicoAlvo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class DemandaController extends Controller
{
    protected $demandaModel;

    public function __construct(Demanda $demandaModel)
    {
        $this->demandaModel = $demandaModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_usuario' => [
                'required',
                Rule::exists(Usuario::class, 'id_usuario'),
            ],
            'id_publico_alvo' => [
                'required',
                Rule::exists(PublicoAlvo::class, 'id_publico_alvo')
            ],
            'id_area_conhecimento' => [
                'required',
                Rule::exists(AreaConhecimento::class, 'id_area_conhecimento')
            ],
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'pessoas_afetadas' => 'required|integer|min:1',
            'duracao' => [
                new Enum(DuracaoDemandaEnum::class)
            ],
            'nivel_prioridade' => [
                new Enum(NivelPrioridadeDemandaEnum::class)
            ],
            'instituicao_setor' => 'required|string|max:255'
        ];
    }

    public function list()
    {
        $demanda = $this->demandaModel::all();
        
        return response()->json([
            'message' => 'Demanda successfully recovered',
            'data' => $demanda
        ]);
    }

    public function get($id_demanda)
    {
        return $this->demandaModel::findOrFail($id_demanda);
    }

    public function create(Request $request)
    {
        //VALIDACAO DA CHAVE UNIQUE -> FAZENDO UM SPREED DOS DADOS JÁ VALIDADOS
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(), 
            'id_usuario' => [
                Rule::unique(Demanda::class, 'id_usuario')
                    ->where('titulo', $request->input('titulo'))
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $demanda = $this->demandaModel::create([
            'id_usuario' => $validatedData['id_usuario'],
            'id_publico_alvo' => $validatedData['id_publico_alvo'],
            'id_area_conhecimento' => $validatedData['id_area_conhecimento'],
            'titulo' => $validatedData['titulo'],
            'descricao' => $validatedData['descricao'],
            'pessoas_afetadas' => $validatedData['pessoas_afetadas'],
            'duracao' => $validatedData['duracao'],
            'nivel_prioridade' => $validatedData['nivel_prioridade'],
            'instituicao_setor' => $validatedData['instituicao_setor']
        ]);

        return response()->json([
            'message' => 'Demanda Created successfull',
            'data' => $demanda
        ])->setStatusCode(201); 
    }

    public function update($id_demanda, Request $request)
    {
        //VALIDACAO DA CHAVE UNIQUE -> FAZENDO UM SPREED DOS DADOS JÁ VALIDADOS
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(), 
            'id_usuario' => [
                Rule::unique(Demanda::class, 'id_usuario')
                    ->where('titulo', $request->input('titulo'))
            ]
        ]);
        
        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $demanda = $this->demandaModel::findOrFail($id_demanda);

        $demanda->update([
            'id_usuario' => $validatedData['id_usuario'],
            'id_publico_alvo' => $validatedData['id_publico_alvo'],
            'id_area_conhecimento' => $validatedData['id_area_conhecimento'],
            'titulo' => $validatedData['titulo'],
            'descricao' => $validatedData['descricao'],
            'pessoas_afetadas' => $validatedData['pessoas_afetadas'],
            'duracao' => $validatedData['duracao'],
            'nivel_prioridade' => $validatedData['nivel_prioridade'],
            'instituicao_setor' => $validatedData['instituicao_setor']
        ]);

        return response()->json([
            'message' => 'Demanda Updated Successfully',
            'data' => $demanda
        ])->setStatusCode(200);
            
    }

    public function delete($id_demanda) 
    {
            
        $demanda = $this->demandaModel->findOrFail($id_demanda);
        $demanda->delete();

        return response()->json([
            'message' => 'Demanda deleted successfully'
        ])->setStatusCode(200);

    }
}
