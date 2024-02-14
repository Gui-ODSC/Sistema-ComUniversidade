<?php

namespace App\Http\Controllers;

use App\Enums\TipoUsuarioEnum;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class UsuarioController extends Controller
{
    protected $usuarioModel;

    public function __construct(Usuario $usuarioModel)
    {
        $this->usuarioModel = $usuarioModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_endereco' => [
                'required',
                Rule::exists(Endereco::class, 'id_endereco')
            ],
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'nascimento' => 'required|date_format:d-m-y', //(20/01/2020)
            'telefone' => 'required|regex:/^\(\d{2}\) \d{4}-\d{4}$/', //(XX) XXXX-XXXX
            'email_primario' => [
                'required',
                'email',
                Rule::unique(Usuario::class, 'email_primario')
            ],
            'email_secundario' => [
                'required',
                'email',
                Rule::unique(Usuario::class, 'email_secundario')
            ],
            'senha' => [
                'required',
                'string',
                'min:8',
                'regex:/[A-Z]/',
                'regex:/[a-z]/',
                'regex:/[0-9]/',
                'regex:/[@$!%*#?&]/',
            ],
            'foto' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048',
            'tipo' => [
                'required',
                new Enum(TipoUsuarioEnum::class)
            ]
        ];
    }

    public function list()
    {
        $usuario = $this->usuarioModel::all();
        
        return response()->json([
            'message' => 'Usuario successfully recovered',
            'data' => $usuario
        ]);
    }

    public function get($id_usuario)
    {
        return $this->usuarioModel::findOrFail($id_usuario);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $usuario = $this->usuarioModel::create([
            'id_endereco' => $validatedData['id_endereco'],
            'nome' => $validatedData['nome'],
            'sobrenome' => $validatedData['sobrenome'],
            'nascimento' => $validatedData['nascimento'],
            'telefone' => $validatedData['telefone'],
            'email_primario' => $validatedData['email_primario'],
            'email_secundario' => $validatedData['email_secundario'],
            'senha' => $validatedData['senha'],
            'foto' => $validatedData['foto'],
            'tipo' => $validatedData['tipo']
        ]);

        return response()->json([
            'message' => 'Usuario Created successfull',
            'data' => $usuario
        ])->setStatusCode(201); 
    }

    public function update($id_usuario, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $usuario = $this->usuarioModel::findOrFail($id_usuario);

        $usuario->update([
            'id_endereco' => $validatedData['id_endereco'],
            'nome' => $validatedData['nome'],
            'sobrenome' => $validatedData['sobrenome'],
            'nascimento' => $validatedData['nascimento'],
            'telefone' => $validatedData['telefone'],
            'email_primario' => $validatedData['email_primario'],
            'email_secundario' => $validatedData['email_secundario'],
            'senha' => $validatedData['senha'],
            'foto' => $validatedData['foto'],
            'tipo' => $validatedData['tipo']
        ]);

        return response()->json([
            'message' => 'Usuario Updated Successfully',
            'data' => $usuario
        ])->setStatusCode(200);
        
    }

    public function delete($id_usuario) 
    {
        $usuario = $this->usuarioModel->findOrFail($id_usuario);
        $usuario->delete();

        return response()->json([
            'message' => 'Usuario deleted successfully'
        ])->setStatusCode(200);

    }
}
