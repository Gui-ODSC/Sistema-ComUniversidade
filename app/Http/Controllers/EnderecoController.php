<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Endereco;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class EnderecoController extends Controller
{
    protected $enderecoModel;

    public function __construct(Endereco $enderecoModel)
    {
        $this->enderecoModel = $enderecoModel;
    }

    private function getValidationSchema()
    {
        return [
            'rua' => 'required|string|max:255',
            'numero' => 'required|integer',
            'complemento' => 'string|max:255',
            'id_bairro' => [
                'required',
                Rule::exists(Bairro::class, 'id_bairro')
            ]
        ];
    }

    public function list()
    {
        $endereco = $this->enderecoModel::all();
        
        return response()->json([
            'message' => 'Endereço successfully recovered',
            'data' => $endereco
        ]);
    }

    public function get($id_endereco)
    {
        return $this->enderecoModel::findOrFail($id_endereco);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $endereco = $this->enderecoModel::create([
            'rua' => $validatedData['rua'],
            'numero' => $validatedData['numero'],
            'complemento' => $validatedData['complemento'],
            'id_bairro' => $validatedData['id_bairro']
        ]);

        return response()->json([
            'message' => 'Endereco Created successfull',
            'data' => $endereco
        ])->setStatusCode(201); 
    }

    public function update($id_endereco, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());
        
        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $endereco = $this->enderecoModel::findOrFail($id_endereco);

        $endereco->update([
            'rua' => $validatedData['rua'],
            'numero' => $validatedData['numero'],
            'complemento' => $validatedData['complemento'],
            'id_bairro' => $validatedData['id_bairro']
        ]);

        return response()->json([
            'message' => 'Endereco Updated Successfully',
            'data' => $endereco
        ])->setStatusCode(200);
            
    }

    public function delete($id_endereco) 
    {
            
        $endereco = $this->enderecoModel->findOrFail($id_endereco);
        $endereco->delete();

        return response()->json([
            'message' => 'Endereco deleted successfully'
        ])->setStatusCode(200);

    }
}
