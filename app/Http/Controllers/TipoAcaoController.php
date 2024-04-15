<?php

namespace App\Http\Controllers;

use App\Models\TipoAcao;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

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
            'nome' => 'required|string|max:255'
        ];
    }

    public function list() 
    {
        $tipoAcao = $this->tipoAcaoModel::all();
        
        return $tipoAcao;
    }

    public function get($id_tipo_acao)
    {
        return $this->tipoAcaoModel::findOrFail($id_tipo_acao);
    }

    public function validarCamposTipoAcao(Request $request)
    {
        $tipoAcao = TipoAcao::where('nome', $request->input('tipo_acao'))->first();

        if (!$tipoAcao ) {
            return response()->json(['error' => 'A modalidade selecionada não foi encontrada.'], 400);
        }

        $validatedData = array_merge($request->all(), [
            'id_tipo_acao' => $tipoAcao->id_tipo_acao,
        ]);

        $validator = Validator::make($validatedData, [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(TipoAcao::class, 'nome')
            ]
        ], $this->messageValidation());
        
        return $validator;
    }

    public function update($id_tipo_acao, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'nome' => [
                Rule::unique(TipoAcao::class, 'nome')
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $tipoAcao = $this->tipoAcaoModel::findOrFail($id_tipo_acao);

        $tipoAcao->update([
            'nome' => $validatedData['nome']
        ]);

        return response()->json([
            'message' => 'AreaConhecimento updated successfully',
            'data' => $tipoAcao
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'nome.unique' => 'Já existe um nome de modalidade cadastrado.',
            'nome.required' => 'O nome para modalidade é obrigatório',
            'nome.string' => 'O nome deve ser um texto',
            'nome.max' => 'Número máximo de caracteres ultrapassado'
        ];
    }
}
