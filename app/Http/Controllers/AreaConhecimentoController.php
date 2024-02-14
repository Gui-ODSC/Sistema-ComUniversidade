<?php

namespace App\Http\Controllers;

use App\Models\AreaConhecimento;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

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
        
        return response()->json([
            'message' => 'AreaConhecimento successfully recovered',
            'data' => $areasConhecimento
        ]);
    }

    public function get($id_area_conhecimento)
    {
        return $this->areaConhecimentoModel::findOrFail($id_area_conhecimento);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $areaConhecimento = $this->areaConhecimentoModel::create([
            'nome' => $validatedData['nome'],
        ]);

        return response()->json([
            'message' => 'AreaConhecimento Created successfull',
            'data' => $areaConhecimento
        ])->setStatusCode(201);
    }

    public function update($id_area_conhecimento, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

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

    public function delete($id_area_conhecimento) 
    {
        $areaConhecimento = $this->areaConhecimentoModel->findOrFail($id_area_conhecimento);
        $areaConhecimento->delete();
        
        return response()->json([
            'message' => 'AreaConhecimento deleted successfully'
        ])->setStatusCode(200);

    }
}
