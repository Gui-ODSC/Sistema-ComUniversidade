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
    private $enderecoModel;
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
        Endereco $enderecoModel,

    ) {
        $this->usuarioController = $usuarioController;
        $this->usuarioModel = $usuarioModel;
        $this->enderecoModel = $enderecoModel;
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
        $validarCamposEndereco = $this->enderecoController->validarCamposEndereco($request);
        $validarCamposUsuario = $this->usuarioController->validarCamposUsuario($request);

        // Verifica se a validação dos campos de endereço falhou
        if ($validarCamposEndereco->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Endereços Inválidos',
                "dados" => $validarCamposEndereco->errors()->all(),
                ...$this->listErrosEndereco($validarCamposEndereco->errors())
            ])->withInput();
        }

        // Verifica se a validação dos campos do usuário falhou
        if ($validarCamposUsuario->fails()) {
            return back()->withErrors([
                "message" => 'Campo de dados pessoais inválidos',
                "dados" => $validarCamposUsuario->errors()->all(),
                ...$this->listErrosUsuario($validarCamposUsuario->errors())
            ])->withInput();
        }

        // Se a validação passou, prosseguimos com a criação do endereço e do usuário
        $validatedDataEndereco = $validarCamposEndereco->validated();
        $validatedDataUsuario = $validarCamposUsuario->validated();

        // Tratamento do upload da imagem
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store('imagemPerfilMembro');
            $validatedDataUsuario['foto'] = $fotoPath;
        }

        // Criação do endereço
        $newEndereco = $this->enderecoModel::create($validatedDataEndereco);

        // Criação do usuário com o ID do endereço recém-criado
        $this->usuarioModel::create([
            'id_endereco' => $newEndereco->id_endereco,
            'nome' => $validatedDataUsuario['nome'],
            'sobrenome' => $validatedDataUsuario['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedDataUsuario['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedDataUsuario['telefone'],
            'email' => $validatedDataUsuario['email'],
            'email_secundario' => $validatedDataUsuario['email_secundario'] ?? null,
            'password' => Hash::make($validatedDataUsuario['password']),
            'foto' => $validatedDataUsuario['foto'] ?? null,
            'tipo' => 'MEMBRO',
            'tipo_pessoa' => $validatedDataUsuario['tipo_pessoa'],
            'instituicao' => $validatedDataUsuario['instituicao'] ?? null,
        ]);

        return redirect()->route('login_membro_index')->with("success", "Usuário Cadastrado com Sucesso.");
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
            "tipo_pessoa" => $errors->first('tipo_pessoa'),
            "instituicao" => $errors->first('instituicao'),
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
