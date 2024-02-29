<?php

namespace App\Http\Controllers;

use App\Models\PublicoAlvo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
        
        return $publicoAlvo;
    }

    public function get($id_tipo_acao)
    {
        return $this->publicoAlvoModel::findOrFail($id_tipo_acao);
    }

    public function validarCamposPublicoAlvo(Request $request)
    {
        
        $publicoAlvo = PublicoAlvo::where('nome', $request->input('publico_alvo'))->first();

        if (!$publicoAlvo ) {
            return response()->json(['error' => 'O público alvo selecionado não foi encontrado.'], 400);
        }

        $validatedData = array_merge($request->all(), [
            'id_publico_alvo' => $publicoAlvo->id_publico_alvo,
        ]);

        $validator = Validator::make($validatedData, [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(PublicoAlvo::class, 'nome')
            ]
        ], $this->messageValidation());

        return $validator;
    }

    public function update($id_tipo_acao, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(PublicoAlvo::class, 'nome')
            ]
        ]);

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

    protected function messageValidation()
    {
        return [
            'nome.unique' => 'Já existe um nome de publico alvo cadastrado.',
            'nome.required' => 'O nome do público alvo é obrigatório',
            'nome.string' => 'O nome deve ser um texto',
            'nome.max' => 'Número máximo de caracteres ultrapassado'
        ];
    }
}
