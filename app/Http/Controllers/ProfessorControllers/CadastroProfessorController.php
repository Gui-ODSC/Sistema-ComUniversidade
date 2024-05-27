<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\BairroController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\UsuarioAlunoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioProfessorController;
use App\Models\Cep;
use App\Models\Endereco;
use App\Models\Usuario;
use App\Models\UsuarioAluno;
use App\Models\UsuarioProfessor;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CadastroProfessorController extends Controller
{
    private $usuarioController;
    private $usuarioModel;
    private $cepModel;
    private $cepController;
    private $cidadeController;
    private $estadoController;
    private $usuarioProfessorController;
    private $usuarioProfessorModel;

    public function __construct(
        UsuarioController $usuarioController,
        UsuarioProfessorController $usuarioProfessorController,
        CepController $cepController,
        CidadeController $cidadeController,
        EstadoController $estadoController,
        Usuario $usuarioModel,
        UsuarioProfessor $usuarioProfessorModel,
        Cep $cepModel,

    ) {
        $this->usuarioController = $usuarioController;
        $this->usuarioModel = $usuarioModel;
        $this->cepModel = $cepModel;
        $this->cepController = $cepController;
        $this->cidadeController = $cidadeController;
        $this->estadoController = $estadoController;
        $this->usuarioProfessorController = $usuarioProfessorController;
        $this->usuarioProfessorModel = $usuarioProfessorModel;
    }

    public function indexCreateProfessor()
    {
        return view('usuarioProfessor/cadastro/cadastro_professor');
    }

    public function createProfessor(Request $request)
    {

        $request->merge(['tipo_pessoa' => 'FISICA']);

        $validarCamposCep = $this->cepController->validarCamposCep($request);
        $validarCamposUsuario = $this->usuarioController->validarCamposUsuario($request);
        $validarCamposUsuarioProfessor = $this->usuarioProfessorController->validarCamposUsuarioProfessorCreate($request);

        // Verifica se a validação dos campos de endereço falhou
        if ($validarCamposCep->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Endereços Inválidos',
                "dados" => $validarCamposCep->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos do usuário falhou
        if ($validarCamposUsuario->fails()) {
            return back()->withErrors([
                "message" => 'Campo de dados pessoais inválidos',
                "dados" => $validarCamposUsuario->errors()->all(),
            ])->withInput();
        }

        // Verifica se a validação dos campos do usuárioAluno falhou
        if ($validarCamposUsuarioProfessor->fails()) {
            return back()->withErrors([
                "message" => 'Campo de dados pessoais inválidos',
                "dados" => $validarCamposUsuarioProfessor->errors()->all(),
            ])->withInput();
        }

        // Se a validação passou, prosseguimos com a criação do endereço e do usuário
        $validatedDataCep = $validarCamposCep->validated();
        $validatedDataUsuario = $validarCamposUsuario->validated();
        $validatedDataUsuarioProfessor = $validarCamposUsuarioProfessor->validated();

        // Tratamento do upload da imagem
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store('imagemPerfilProfessor');
            $validatedDataUsuario['foto'] = $fotoPath;
        }else {
            $validatedDataUsuario['foto'] = null;
        }

        // Criação do usuário com o ID do endereço recém-criado
        $newUsuario = $this->usuarioModel::create([
            'id_cep' => $validatedDataCep['id_cep'],
            'nome' => $validatedDataUsuario['nome'],
            'sobrenome' => $validatedDataUsuario['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedDataUsuario['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedDataUsuario['telefone'],
            'email' => $validatedDataUsuario['email'],
            'email_secundario' => $validatedDataUsuario['email_secundario'] ?? null,
            'password' => Hash::make($validatedDataUsuario['password']),
            'foto' => $validatedDataUsuario['foto'],
            'numero' => $validatedDataUsuario['numero'],
            'complemento' => $validatedDataUsuario['complemento'] ?? null,
            'tipo' => 'PROFESSOR',
            'tipo_pessoa' => $validatedDataUsuario['tipo_pessoa'],
            'instituicao' => $validatedDataUsuario['instituicao'] ?? null,
            'created_at' => now(),
            'updated_at' => null
        ]);

        $this->usuarioProfessorModel::create([
            'id_usuario' => $newUsuario->id_usuario,
            'link_curriculo' => $validatedDataUsuarioProfessor['link_curriculo'] ?? null,
            'numero_registro' => $validatedDataUsuarioProfessor['numero_registro'], 
            'created_at' => now(),
            'updated_at' => null
        ]);

        return redirect()->route('login_professor_index')->with("success", "Professor Cadastrado com Sucesso.");
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

   private function listErrosCep($errors)
    {
        return [
            'cep' => $errors->first('cep'),
            'logradouro' => $errors->first('logradouro'),
            'bairro' => $errors->first('bairro'),
            'complemento' => $errors->first('complemento'),
            'id_cidade' => $errors->first('id_cidade'),
            'id_estado' => $errors->first('id_estado'),
        ];
    }

    private function listErrosUsuarioProfessor($errors)
    {
        return [
            "id_usuario" => $errors->first('id_usuario'),
            'link_curriculo' => $errors->first('link_curriculo'),
            'numero_registro' => $errors->first('numero_registro'), 
        ];
    }
}
