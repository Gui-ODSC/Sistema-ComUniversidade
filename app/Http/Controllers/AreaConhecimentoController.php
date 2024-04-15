<?php

namespace App\Http\Controllers;

use App\Models\AreaConhecimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class AreaConhecimentoController extends Controller
{
    protected $areaConhecimentoModel;

    public function __construct(AreaConhecimento $areaConhecimentoModel)
    {
        $this->areaConhecimentoModel = $areaConhecimentoModel;
    }

    private function getValidationSchema()
    {
        return [
            'nome' => 'required|string|max:255'
        ];
    }

    public function list() 
    {
        $areasConhecimento = $this->areaConhecimentoModel::all();
        
        return $areasConhecimento;
    }

    public function get($id_area_conhecimento)
    {
        return $this->areaConhecimentoModel::findOrFail($id_area_conhecimento);
    }

    public function validarCamposAreaConhecimento(Request $request)
    {
        $areaConhecimento = AreaConhecimento::where('nome', $request->input('area_conhecimento'))->first();

        if (!$areaConhecimento ) {
            return response()->json(['error' => 'A área de Conhecimento Selecionada não foi encontrada.'], 400);
        }

        $validatedData = array_merge($request->all(), [
            'id_area_conhecimento' => $areaConhecimento->id_area_conhecimento,
        ]);

        $validator = Validator::make($validatedData, [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(AreaConhecimento::class, 'nome')
            ]
        ], $this->messageValidation());
        
        return $validator;
    }

    public function update($id_area_conhecimento, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(AreaConhecimento::class, 'nome')
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $areaConhecimento = $this->areaConhecimentoModel::findOrFail($id_area_conhecimento);

        $areaConhecimento->update([
            'nome' => $validatedData['nome']
        ]);

        return response()->json([
            'message' => 'AreaConhecimento updated successfully',
            'data' => $areaConhecimento
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'nome.unique' => 'Já existe um nome de area de conhecimento cadastrado.',
            'nome.required' => 'O nome para área do conhecimento é obrigatório',
            'nome.string' => 'O nome deve ser um texto',
            'nome.max' => 'Número máximo de caracteres ultrapassado'
        ];
    }
}
