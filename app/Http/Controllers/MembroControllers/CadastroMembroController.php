<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\BairroController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class CadastroMembroController extends Controller
{
    private $usuarioController;
    private $usuarioModel;

    private $enderecoController;
    private $cidadeController;
    private $estadoController;
    private $bairroController;

    public function __construct(
        UsuarioController $usuarioController,
        EnderecoController $enderecoController,
        CidadeController $cidadeController,
        EstadoController $estadoController,
        BairroController $bairroController,
        Usuario $usuarioModel,

    ) {
        $this->usuarioController = $usuarioController;
        $this->usuarioModel = $usuarioModel;
        $this->enderecoController = $enderecoController;
        $this->cidadeController = $cidadeController;
        $this->estadoController = $estadoController;
        $this->bairroController = $bairroController;
    }

    public function index()
    {
        $listBairro = $this->bairroController->list();
        $listCidade = $this->cidadeController->list();
        $listEstado = $this->estadoController->list();
        return view(
            'usuarioMembro/cadastro/cadastro_membro', 
            [
                'bairros' => $listBairro,
                'cidades' => $listCidade,
                'estados' => $listEstado,
            ]
        );
    }

    public function create(Request $request)
    {
        $validarCamposEndereco = $this->enderecoController->create($request);
        
        $validarCamposUsuario = $this->usuarioController->validarCamposUsuario($request);

        
        if ($validarCamposEndereco instanceof \Illuminate\Support\MessageBag) {
            return back()->withErrors([
                "message" => 'Campos Endereco Inválidos',
                "dados" => $validarCamposEndereco->all(),
                ...$this->listErrosEndereco($validarCamposEndereco)
            ]);
            /* return $validarCamposEndereco->all(); */
        }
        
        if ($validarCamposUsuario->fails()) {
            /* return $validarCamposUsuario->errors()->all(); */
            return back()->withErrors([
                "message" => 'Campo de dados pessoais inválidos',
                "dados" => $validarCamposUsuario->errors()->all(),
                ...$this->listErrosUsuario($validarCamposUsuario->errors())
            ]);
        }
        
        $validatedData = $validarCamposUsuario->validated();
        $this->usuarioModel::create([
            'id_endereco' => $validarCamposEndereco->id_endereco,
            'nome' => $validatedData['nome'],
            'sobrenome' => $validatedData['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedData['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedData['telefone'],
            'email' => $validatedData['email'],
            'email_secundario' => $validatedData['email_secundario'] ?? null,
            'password' => Hash::make($validatedData['password']),
            'foto' => $validatedData['foto'] ?? null,
            'tipo' => 'MEMBRO'
        ]);

        return redirect()->route('login_index');

    }

    private function listErrosUsuario($errors)
    {
        return [
            "nome" => $errors->first('nome'),
            "sobrenome" => $errors->first('sobrenome'),
            "nascimento" => $errors->first('nascimento'),
            "telefone" => $errors->first('telefone'),
            "email" => $errors->first('email'),
            "email_secundario" => $errors->first('email_secundario'),
            "password" => $errors->first('password'),
            "foto" => $errors->first('foto'),
        ];
    }

    private function listErrosEndereco($errors)
    {
        return [
            "rua" => $errors->first('rua'),
            "numero" => $errors->first('numero'),
            "complemento" => $errors->first('complemento'),
            "id_bairro" => $errors->first('id_bairro'),
            "id_cidade" => $errors->first('id_cidade'),
            "id_estado" => $errors->first('id_estado'),
        ];
    }
}
