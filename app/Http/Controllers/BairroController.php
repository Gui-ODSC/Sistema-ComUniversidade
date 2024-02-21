<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Cidade;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class BairroController extends Controller
{
    protected $bairroModel;

    public function __construct(Bairro $bairroModel)
    {
        $this->bairroModel = $bairroModel;
    }

    private function getValidationSchema()
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }

    public function list() 
    {
        $bairro = $this->bairroModel::all();
        
        return $bairro;
    }

    public function get($id_bairro)
    {
        return $this->bairroModel::findOrFail($id_bairro);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(Bairro::class, 'nome')
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $bairro = $this->bairroModel::create([
            'nome' => $validatedData['nome'],
        ]);

        return response()->json([
            'message' => 'Bairro Created successfull',
            'data' => $bairro
        ])->setStatusCode(201);
    }

    public function update($id_bairro, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(Bairro::class, 'nome')
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $bairro = $this->bairroModel::findOrFail($id_bairro);

        $bairro->update([
            'nome' => $validatedData['nome'],
        ]);

        return response()->json([
            'message' => 'Bairro updated successfully',
            'data' => $bairro
        ])->setStatusCode(200);

    }

    public function delete($id_bairro) 
    {
        $bairro = $this->bairroModel->findOrFail($id_bairro);

        $bairro->delete();
    
        return response()->json([
            'message' => 'Bairro deleted successfully'
        ])->setStatusCode(200);

    }
}
