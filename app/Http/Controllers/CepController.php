<?php

namespace App\Http\Controllers;

use App\Models\Bairro;
use App\Models\Cep;
use App\Models\Cidade;
use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CepController extends Controller
{
    protected $cepModel;

    public function __construct(Cep $cepModel)
    {
        $this->cepModel = $cepModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_cep' => 'required|integer',
            'cep' => 'required|string|max:8',
            'logradouro' => 'nullable|string|max:255',
            'bairro' => 'nullable|string|max:255',
            'complemento' => 'nullable|string|max:255',
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
        $cep = $this->cepModel::all();
        
        return $cep;
    }

    public function get($id_cep)
    {
        return $this->cepModel::findOrFail($id_cep);
    }

    public function validarCamposCep(Request $request)
    {
        $cepInput = str_replace('-', '', $request->input('cep'));

        $cep = Cep::where('cep', $cepInput)->first();

        if (!$cep) {
            // Retornar um validador com um erro falso para indicar falha
            $validator = Validator::make([], []);
            $validator->errors()->add('cep', 'Alguma das entidades de Endereço não foi encontrada.');
            return $validator;
        }

        $data = [
            'id_cep' => $cep->id_cep,
            'cep' => $cep->cep,
            'logradouro' => $cep->logradouro,
            'bairro' => $cep->bairro,
            'complemento' => $cep->complemento,
            'id_cidade' => $cep->id_cidade,
            'id_estado' => $cep->id_estado,
        ];

        $validator = Validator::make(
            $data,
            $this->getValidationSchema(),
            $this->messageValidation()
        );

        return $validator;
    }

    public function validarUpdateCep($id_cep, Request $request)
    {
        $cepInput = str_replace('-', '', $request->input('cep'));

        $cep = Cep::where('cep', $cepInput)->first();

        if (!$cep) {
            // Retornar um validador com um erro falso para indicar falha
            $validator = Validator::make([], []);
            $validator->errors()->add('cep', 'Alguma das entidades de Endereço não foi encontrada.');
            return $validator;
        }

        $data = [
            'id_cep' => $cep->id_cep,
            'cep' => $cep->cep,
            'logradouro' => $cep->logradouro,
            'bairro' => $cep->bairro,
            'complemento' => $cep->complemento,
            'id_cidade' => $cep->id_cidade,
            'id_estado' => $cep->id_estado,
        ];

        $validator = Validator::make(
            $data,
            $this->getValidationSchema(),
            $this->messageValidation()
        );

        return $validator;
            
    }

    public function getCepData($cep)
    {
        $cepData = Cep::where('cep', $cep)->first();

        if ($cepData) {
            return response()->json([
                'success' => true,
                'data' => [
                    'logradouro' => $cepData->logradouro,
                    'bairro' => $cepData->bairro,
                    'estado' => $cepData->estado->nome,  
                    'cidade' => $cepData->cidade->nome, 
                    'uf' => $cepData->estado->uf,  
                ]
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'CEP não encontrado!'
            ], 400);
        }
    }

    public function delete($id_cep) 
    {
            
        $cep = $this->cepModel->findOrFail($id_cep);
        $cep->delete();

        return response()->json([
            'message' => 'Endereco deleted successfully'
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'cep.required' => 'O campo CEP é obrigatório.',
            'cep.string' => 'O campo CEP deve ser uma string.',
            'cep.max' => 'O campo CEP não pode ter mais que 8 caracteres.',
            'logradouro.string' => 'O campo logradouro deve ser uma string.',
            'logradouro.max' => 'O campo logradouro não pode ter mais que 255 caracteres.',
            'bairro.string' => 'O campo bairro deve ser uma string.',
            'bairro.max' => 'O campo bairro não pode ter mais que 255 caracteres.',
            'complemento.string' => 'O campo complemento deve ser uma string.',
            'complemento.max' => 'O campo complemento não pode ter mais que 255 caracteres.',
            'id_cidade.required' => 'O campo cidade é obrigatório.',
            'id_cidade.exists' => 'A cidade selecionada é inválida.',
            'id_estado.required' => 'O campo estado é obrigatório.',
            'id_estado.exists' => 'O estado selecionado é inválido.'
        ];
    }
}
