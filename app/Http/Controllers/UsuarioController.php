<?php

namespace App\Http\Controllers;

use App\Enums\TipoPessoaEnum;
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
            'nascimento' => [
                'required',
                'date_format:d/m/Y', //(20/01/2020)
                function ($attribute, $value, $fail) {
                    $parsedDate = \DateTime::createFromFormat('d/m/Y', $value);
                    $today = new \DateTime();
                    $minDate = (new \DateTime())->modify('-180 years');

                    if ($parsedDate > $today || $parsedDate < $minDate) {
                        $fail('Data Nascimento: A data de nascimento deve ser uma data válida e ser menor que a data atual.');
                    }
                },
            ],
            'telefone' => 'required|string|regex:/^\(\d{2}\) \d{5}-\d{4}$/', //(XX) XXXX-XXXX
            'email' => [
                'required',
                'email',
            ],
            'email_secundario' => [
                'nullable',
                'email',
                function ($attribute, $value, $fail) {
                    $emailPrincipal = request()->input('email');
                    if ($value && $value === $emailPrincipal) {
                        $fail('Email: Os emails principal e secundário não podem ser iguais.');
                    }
                },
            ],
            'password' => [
                'required',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            ],
            'foto' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'foto_atual' => 'nullable|string',
            'numero' => 'required|string|max:10',
            'complemento' => 'nullable|string|max:255',
            'tipo_pessoa' => [
                'required',
                new Enum(TipoPessoaEnum::class)
            ],
            'instituicao' => 'string|nullable|max:100'
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

    public function validarUpdateUsuario($id_usuario, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'password' => [
                'nullable',
                'string',
                'min:8',
                'regex:/^(?=.*[A-Z])(?=.*[a-z])(?=.*\d)(?=.*[@$!%*#?&])[A-Za-z\d@$!%*#?&]{8,}$/',
            ],
            'email' => [
                Rule::unique(Usuario::class, 'email')
                    ->ignore($id_usuario, 'id_usuario')
            ]
        ], $this->messageValidation());

        return $validator;

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
            'nascimento.date_format' => 'Data Nascimento: Formato Inválido, deve seguir o exemplo: dia/mes/ano.',
            'nascimento.date' => 'Data Nascimento: Data inválida.',
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
            'instituicao.string' => 'Instituição: A instituicao deve ser um texto.',
            'instituicao.max' => 'Instituição: Número de caracteres ultrapassado',
            'foto.mimes' => 'Foto: A imagem deve ter um dos seguintes formatos: jpeg, png, jpg ou gif.',
            'foto.max' => 'Foto: A imagem deve ter até no máximo 2MB.',
            'numero.required' => 'Número: Campo obrigatório',
            'numero.max' => 'Número: Deve conter no máximo 10 digitos.',
            'complemento.max' => 'Complemento: Numero de caracteres ultrapassado'
        ];
    }
}