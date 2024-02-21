<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Estado;
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
            'complemento' => 'nullable|string|max:255',
            'id_bairro' => [
                'required',
                Rule::exists(Bairro::class, 'id_bairro')
            ],
            'id_cidade' => [
                'required',
                Rule::exists(Cidade::class, 'id_cidade')
            ],
            'id_estado' => [
                'required',
                Rule::exists(Estado::class, 'id_estado')
            ]
        ];
    }

    public function list()
    {
        $endereco = $this->enderecoModel::all();
        
        return $endereco;
    }

    public function get($id_endereco)
    {
        return $this->enderecoModel::findOrFail($id_endereco);
    }

    public function validarCamposEndereco(Request $request)
    {
        $cidade = Cidade::where('nome', $request->input('nome_cidade'))->first();
        $bairro = Bairro::where('nome', $request->input('nome_bairro'))->first();
        $estado = Estado::where('nome', $request->input('nome_estado'))->first();

        if (!$cidade || !$bairro || !$estado) {
            return response()->json(['error' => 'Alguma das entidades de Endereço não foi encontrada.'], 400);
        }

        $validatedData = array_merge($request->all(), [
            'id_cidade' => $cidade->id_cidade,
            'id_bairro' => $bairro->id_bairro,
            'id_estado' => $estado->id_estado
        ]);

        $validator = Validator::make(
            $validatedData, 
            $this->getValidationSchema(), 
            $this->messageValidation()
        );
        
        return $validator;
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
            'id_bairro' => $validatedData['id_bairro'],
            'id_cidade' => $validatedData['id_cidade'],
            'id_estado' => $validatedData['id_estado']
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

    protected function messageValidation()
    {
        return [
            'rua.required' => 'Rua é obrigatório.',
            'rua.string' => 'Rua deve ser um texto .',
            'rua.max' => 'Numero de caracteres ultrapassado.',
            'numero.required' => 'Número é obrigatório.',
            'numero.integer' => 'Número deve ser inteiro.',
            'complemento.string' => 'O campo complemento deve ser um texto.',
            'complemento.max' => 'Numero de caracteres ultrapassado.',
            'id_bairro.required' => 'Bairro é obrigatório.',
            'id_bairro.exists' => 'Bairro selecionado é inválido.',
            'id_cidade.required' => 'Cidade é obrigatório.',
            'id_cidade.exists' => 'Cidade selecionada é inválida.',
            'id_estado.required' => 'Estado é obrigatório.',
            'id_estado.exists' => 'Estado selecionado é inválido.'
        ];
    }
}
