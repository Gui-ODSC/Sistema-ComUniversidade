<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\ContatoMensagem;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContatoMensagemController extends Controller
{
    protected $contatoMensagemModel;

    public function __construct(ContatoMensagem $contatoMensagemModel)
    {
        $this->contatoMensagemModel = $contatoMensagemModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_contato' => [
                'required',
                Rule::exists(Contato::class, 'id_contato')
            ],
            'id_usuario_origem' => [
                'required_if: id_usuario_destino, null',
                Rule::exists(Usuario::class, 'id_usuario')
            ],
            'id_usuario_destino' => [
                'required_if: id_usuario_origem, null',
                Rule::exists(Usuario::class, 'id_usuario')
            ],
            'mensagem' => 'required|string|max:255'
        ];
    }

    public function list()
    {
        $contatoMensagem = $this->contatoMensagemModel::all();
        
        return response()->json([
            'message' => 'Contato successfully recovered',
            'data' => $contatoMensagem
        ]);
    }

    public function get($id_contato_mensagem)
    {
        return $this->contatoMensagemModel::findOrFail($id_contato_mensagem);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $contatoMensagem = $this->contatoMensagemModel::create([
            'id_contato' => $validatedData['id_contato'],
            'id_usuario_origem' => $validatedData['id_usuario_origem'],
            'id_usuario_destino' => $validatedData['id_usuario_destino'],
            'mensagem' => $validatedData['mensagem']
        ]);

        return response()->json([
            'message' => 'Contato Created successfull',
            'data' => $contatoMensagem
        ])->setStatusCode(201); 
    }

    public function update($id_contato_mensagem, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());
        
        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $contatoMensagem = $this->contatoMensagemModel::findOrFail($id_contato_mensagem);

        $contatoMensagem->update([
            'id_contato' => $validatedData['id_contato'],
            'id_usuario_origem' => $validatedData['id_usuario_origem'],
            'id_usuario_destino' => $validatedData['id_usuario_destino'],
            'mensagem' => $validatedData['mensagem']
        ]);

        return response()->json([
            'message' => 'Contato Updated Successfully',
            'data' => $contatoMensagem
        ])->setStatusCode(200);
            
    }

    public function delete($id_contato_mensagem) 
    {
            
        $contatoMensagem = $this->contatoMensagemModel->findOrFail($id_contato_mensagem);
        $contatoMensagem->delete();

        return response()->json([
            'message' => 'Contato deleted successfully'
        ])->setStatusCode(200);

    }
}
