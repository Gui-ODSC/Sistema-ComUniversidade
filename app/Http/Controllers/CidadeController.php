<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CidadeController extends Controller
{
    protected $cidadeModel;

    public function __construct(Cidade $cidadeModel)
    {
        $this->cidadeModel = $cidadeModel;
    }

    private function getValidationSchema()
    {
        return [
            'nome' => 'required|string|max:255',
            'id_estado' => [
                'required',
                Rule::exists(Estado::class, 'id_estado')
            ]
        ];
    }

    public function list()
    {
        $cidade = $this->cidadeModel::all();
        
        return response()->json([
            'message' => 'Cidade successfully recovered',
            'data' => $cidade
        ]);
    }

    public function get($id_cidade)
    {
        return $this->cidadeModel::findOrFail($id_cidade);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_estado' => [
                Rule::unique(Cidade::class, 'id_estado')
                    ->where('nome', $request->input('nome'))
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $cidade = $this->cidadeModel::create([
            'nome' => $validatedData['nome'],
            'id_estado' => $validatedData['id_estado']
        ]);

        return response()->json([
            'message' => 'Cidade Created successfull',
            'data' => $cidade
        ])->setStatusCode(201); 
    }

    public function update($id_cidade, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_estado' => [
                Rule::unique(Cidade::class, 'id_estado')
                    ->where('nome', $request->input('nome'))
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $cidade = $this->cidadeModel::findOrFail($id_cidade);

        $cidade->update([
            'nome' => $validatedData['nome'],
            'id_estaado' => $validatedData['id_estado']
        ]);

        return response()->json([
            'message' => 'Cidade Updated Successfully',
            'data' => $cidade
        ])->setStatusCode(200);
    }

    public function delete($id_cidade) 
    {
        $cidade = $this->cidadeModel->findOrFail($id_cidade);
        $cidade->delete();

        return response()->json([
            'message' => 'Cidade deleted successfully'
        ])->setStatusCode(200);

    }
}