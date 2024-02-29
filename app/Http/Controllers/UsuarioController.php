<?php

namespace App\Http\Controllers;

use App\Enums\TipoUsuarioEnum;
use App\Models\Endereco;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
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
            'nome' => 'required|string|max:255',
            'sobrenome' => 'required|string|max:255',
            'nascimento' => 'required|date_format:d/m/Y', //(20/01/2020)
            'telefone' => 'required|string|regex:/^\(\d{2}\) \d{5}-\d{4}$/', //(XX) XXXX-XXXX
            'email' => [
                'required',
                'email',
            ],
            'email_secundario' => [
                'nullable',
                'email',
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            ],
            'foto' => 'nullable|string',
        ];
    }

    public function list()
    {
        $usuario = $this->usuarioModel::all();
        
        return $usuario;
    }

    public function get($id_usuario)
    {
        return $this->usuarioModel::findOrFail($id_usuario);
    }

    public function validarCamposUsuario(Request $request)
    {
        
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'email' => [
                Rule::unique(Usuario::class, 'email')
            ] 
        ], $this->messageValidation());

        return $validator;
        
    }

    public function update($id_usuario, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'email' => [
                Rule::unique(Usuario::class, 'email')
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $usuario = $this->usuarioModel::findOrFail($id_usuario);

        $usuario->update([
            'id_endereco' => $validatedData['id_endereco'],
            'nome' => $validatedData['nome'],
            'sobrenome' => $validatedData['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d-m-Y', $validatedData['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedData['telefone'],
            'email' => $validatedData['email'],
            'email_secundario' => $validatedData['email_secundario'] ?? null,
            'password' => Hash::make($validatedData['password']),
            'foto' => $validatedData['foto'],
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

    protected function messageValidation()
    {
        return [
            'nome.required' => 'Nome: Campo obrigatório.',
            'nome.string' => 'Nome: Deve ser um texto.',
            'nome.max' => 'Nome: Numero de caracteres ultrapassado',
            'sobrenome.required' => 'Sobrenome: Campo obrigatório.',
            'sobrenome.string' => 'Sobrenome: Deve ser uma texto.',
            'sobrenome.max' => 'Sobrenome: número de caracteres ultrapassado',
            'nascimento.required' => 'Data Nascimento: Campo obrigatório.',
            'nascimento.date_format' => 'Data Nascimento: Deve seguir o formato dd/mm/aaaa.',
            'telefone.required' => 'Telefone: Campo obrigatório.',
            'telefone.regex' => 'Telefone: Deve seguir o formato (XX) XXXXX-XXXX.',
            'email.required' => 'Email: Campo obrigatório.',
            'email.unique' => 'Email: Esse email já está em uso',
            'email.email' => 'Email: O e-mail deve ser um endereço de e-mail válido.',
            'email_secundario.email' => 'Email-Secundario: O e-mail secundário deve ser um endereço de e-mail válido.',
            'password.required' => 'Senha: Campo obrigatório.',
            'password.string' => 'Senha: Deve ser um texto.',
            'password.min' => 'Senha: Deve conter no mínimo 8 caracteres.',
            'password.regex' => 'Senha: Deve conter pelo menos uma letra maiúscula, uma letra minúscula, um número e um caractere especial.',
        ];
    }
}
