<?php

namespace App\Http\Controllers\EstudanteControllers;

use App\Http\Controllers\BairroController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\UsuarioAlunoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Endereco;
use App\Models\Usuario;
use App\Models\UsuarioAluno;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CadastroEstudanteController extends Controller
{
    private $usuarioController;
    private $usuarioModel;
    private $enderecoModel;
    private $enderecoController;
    private $cidadeController;
    private $estadoController;
    private $bairroController;
    private $usuarioAlunoController;
    private $usuarioAlunoModel;

    public function __construct(
        UsuarioController $usuarioController,
        UsuarioAlunoController $usuarioAlunoController,
        EnderecoController $enderecoController,
        CidadeController $cidadeController,
        EstadoController $estadoController,
        BairroController $bairroController,
        Usuario $usuarioModel,
        UsuarioAluno $usuarioAlunoModel,
        Endereco $enderecoModel,

    ) {
        $this->usuarioController = $usuarioController;
        $this->usuarioModel = $usuarioModel;
        $this->enderecoModel = $enderecoModel;
        $this->enderecoController = $enderecoController;
        $this->cidadeController = $cidadeController;
        $this->estadoController = $estadoController;
        $this->bairroController = $bairroController;
        $this->usuarioAlunoController = $usuarioAlunoController;
        $this->usuarioAlunoModel = $usuarioAlunoModel;
    }

    public function indexCreateEstudante()
    {
        $listBairro = $this->bairroController->list();
        $listCidade = $this->cidadeController->list();
        $listEstado = $this->estadoController->list();
        return view('usuarioEstudante/cadastro/cadastro_estudante', 
            [
                'bairros' => $listBairro,
                'cidades' => $listCidade,
                'estados' => $listEstado,
            ]
        );
    }

    public function createEstudante(Request $request)
    {
        $validarCamposEndereco = $this->enderecoController->validarCamposEndereco($request);
        $validarCamposUsuario = $this->usuarioController->validarCamposUsuario($request);
        $validarCamposUsuarioAluno = $this->usuarioAlunoController->validarCamposUsuarioEstudanteCreate($request);

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

        // Verifica se a validação dos campos do usuárioAluno falhou
        if ($validarCamposUsuarioAluno->fails()) {
            return back()->withErrors([
                "message" => 'Campo de dados pessoais inválidos',
                "dados" => $validarCamposUsuarioAluno->errors()->all(),
                ...$this->listErrosUsuarioAluno($validarCamposUsuarioAluno->errors())
            ])->withInput();
        }

        // Se a validação passou, prosseguimos com a criação do endereço e do usuário
        $validatedDataEndereco = $validarCamposEndereco->validated();
        $validatedDataUsuario = $validarCamposUsuario->validated();
        $validatedDataUsuarioAluno = $validarCamposUsuarioAluno->validated();

        // Tratamento do upload da imagem
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store('imagemPerfilEstudante');
            $validatedDataUsuario['foto'] = $fotoPath;
        }

        // Criação do endereço
        $newEndereco = $this->enderecoModel::create($validatedDataEndereco);

        // Criação do usuário com o ID do endereço recém-criado
        $newUsuario = $this->usuarioModel::create([
            'id_endereco' => $newEndereco->id_endereco,
            'nome' => $validatedDataUsuario['nome'],
            'sobrenome' => $validatedDataUsuario['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedDataUsuario['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedDataUsuario['telefone'],
            'email' => $validatedDataUsuario['email'],
            'email_secundario' => $validatedDataUsuario['email_secundario'] ?? null,
            'password' => Hash::make($validatedDataUsuario['password']),
            'foto' => $validatedDataUsuario['foto'] ?? null,
            'tipo' => 'ALUNO',
            'tipo_pessoa' => $validatedDataUsuario['tipo_pessoa'],
            'instituicao' => $validatedDataUsuario['instituicao'] ?? null,
            'created_at' => now(),
            'updated_at' => null
        ]);

        $this->usuarioAlunoModel::create([
            'id_usuario' => $newUsuario->id_usuario,
            'curso' => $validatedDataUsuarioAluno['curso'],
            'ra' => $validatedDataUsuarioAluno['ra'], 
            'created_at' => now(),
            'updated_at' => null
        ]);

        return redirect()->route('login_estudante_index')->with("success", "Estudante Cadastrado com Sucesso.");
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

    private function listErrosUsuarioAluno($errors)
    {
        return [
            "id_usuario" => $errors->first('id_usuario'),
            "curso" => $errors->first('curso'),
            "ra" => $errors->first('ra'),
        ];
    }
}
