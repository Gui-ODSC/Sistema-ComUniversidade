<?php

namespace App\Http\Controllers;

use App\Models\TipoAcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TipoAcaoController extends Controller
{
    protected $tipoAcaoModel;

    public function __construct(TipoAcao $tipoAcaoModel)
    {
        $this->tipoAcaoModel = $tipoAcaoModel;
    }

    private function getValidationSchema()
    {
        return [
            'nome_modalidade' => 'required|string|max:255'
        ];
    }

    public function list()
    {
        $tipoAcao = $this->tipoAcaoModel::all();
        
        return response()->json([
            'message' => 'Tipo Acao successfully recovered',
            'data' => $tipoAcao
        ]);
    }

    public function get($id_tipo_acao)
    {
        return $this->tipoAcaoModel::findOrFail($id_tipo_acao);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $oferta = $this->tipoAcaoModel::create([
            'nome_modalidade' => $validatedData['nome_modalidade']
        ]);

        return response()->json([
            'message' => 'Tipo Acao Created successfull',
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

        $tipoAcao = $this->tipoAcaoModel::findOrFail($id_tipo_acao);

        $tipoAcao->update([
            'nome_modalidade' => $validatedData['nome_modalidade']
        ]);

        return response()->json([
            'message' => 'Tipo Acao Updated Successfully',
            'data' => $tipoAcao
        ])->setStatusCode(200);
    }

    public function delete($id_tipo_acao) 
    {
            
        $tipoAcao = $this->tipoAcaoModel->findOrFail($id_tipo_acao);
        $tipoAcao->delete();

        return response()->json([
            'message' => 'Tipo Acao deleted successfully'
        ])->setStatusCode(200);
    }
}
