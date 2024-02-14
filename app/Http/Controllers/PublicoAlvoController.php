<?php

namespace App\Http\Controllers;

use App\Models\PublicoAlvo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PublicoAlvoController extends Controller
{
    protected $publicoAlvoModel;

    public function __construct(PublicoAlvo $publicoAlvoModel)
    {
        $this->publicoAlvoModel = $publicoAlvoModel;
    }

    private function getValidationSchema()
    {
        return [
            'nome' => 'required|string|max:255'
        ];
    }

    public function list()
    {
        $publicoAlvo = $this->publicoAlvoModel::all();
        
        return response()->json([
            'message' => 'Publico Alvo successfully recovered',
            'data' => $publicoAlvo
        ]);
    }

    public function get($id_tipo_acao)
    {
        return $this->publicoAlvoModel::findOrFail($id_tipo_acao);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $oferta = $this->publicoAlvoModel::create([
            'nome' => $validatedData['nome']
        ]);

        return response()->json([
            'message' => 'Publico Alvo Created successfull',
            'data' => $oferta
        ])->setStatusCode(201); 
    }

    public function update($id_tipo_acao, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $publicoAlvo = $this->publicoAlvoModel::findOrFail($id_tipo_acao);

        $publicoAlvo->update([
            'nome' => $validatedData['nome']
        ]);

        return response()->json([
            'message' => 'Publico Alvo Updated Successfully',
            'data' => $publicoAlvo
        ])->setStatusCode(200);
    }

    public function delete($id_tipo_acao) 
    {
            
        $publicoAlvo = $this->publicoAlvoModel->findOrFail($id_tipo_acao);
        $publicoAlvo->delete();

        return response()->json([
            'message' => 'Publico Alvo deleted successfully'
        ])->setStatusCode(200);
    }
}
