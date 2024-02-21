<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EstadoController extends Controller
{
    protected $estadoModel;

    public function __construct(Estado $estadoModel)
    {
        $this->estadoModel = $estadoModel;
    }

    private function getValidationSchema()
    {
        return [
            'nome' => 'required|string|max:255',
        ];
    }

    public function list()
    {
        $estado = $this->estadoModel::all();
        
        return $estado;
    }

    public function get($id_estado)
    {
        return $this->estadoModel::findOrFail($id_estado);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(Estado::class, 'nome')
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $estado = $this->estadoModel::create([
            'nome' => $validatedData['nome'],
        ]);

        return response()->json([
            'message' => 'Estado Created successfull',
            'data' => $estado
        ])->setStatusCode(201); 
    }

    public function update($id_estado, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(Estado::class, 'nome')
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $estado = $this->estadoModel::findOrFail($id_estado);

        $estado->update([
            'nome' => $validatedData['nome'],
        ]);

        return response()->json([
            'message' => 'Estado Updated Successfully',
            'data' => $estado
        ])->setStatusCode(200);
    }

    public function delete($id_estado) 
    {
            
        $estado = $this->estadoModel->findOrFail($id_estado);
        $estado->delete();

        return response()->json([
            'message' => 'Estado deleted successfully'
        ])->setStatusCode(200);

    }
}
