<?php

namespace App\Http\Controllers\EstudanteControllers;

use App\Http\Controllers\BairroController;
use App\Http\Controllers\CepController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\UsuarioAlunoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Cep;
use App\Models\Usuario;
use App\Models\UsuarioAluno;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CadastroEstudanteController extends Controller
{
    private $usuarioController;
    private $usuarioModel;
    private $cepModel;
    private $cepController;
    private $cidadeController;
    private $estadoController;
    private $usuarioAlunoController;
    private $usuarioAlunoModel;

    public function __construct(
        UsuarioController $usuarioController,
        UsuarioAlunoController $usuarioAlunoController,
        CepController $cepController,
        CidadeController $cidadeController,
        EstadoController $estadoController,
        Usuario $usuarioModel,
        UsuarioAluno $usuarioAlunoModel,
        Cep $cepModel,

    ) {
        $this->usuarioController = $usuarioController;
        $this->usuarioModel = $usuarioModel;
        $this->cepModel = $cepModel;
        $this->cepController = $cepController;
        $this->cidadeController = $cidadeController;
        $this->estadoController = $estadoController;
        $this->usuarioAlunoController = $usuarioAlunoController;
        $this->usuarioAlunoModel = $usuarioAlunoModel;
    }

    public function indexCreateEstudante()
    {
        return view('usuarioEstudante/cadastro/cadastro_estudante');
    }

    public function createEstudante(Request $request)
    {

        $request->merge(['tipo_pessoa' => 'FISICA']);

        $validarCamposCep = $this->cepController->validarCamposCep($request);
        $validarCamposUsuario = $this->usuarioController->validarCamposUsuario($request);
        $validarCamposUsuarioAluno = $this->usuarioAlunoController->validarCamposUsuarioEstudanteCreate($request);

        // Verifica se a validação dos campos de endereço falhou
        if ($validarCamposCep->fails()) {
            return back()->withErrors([
                "message" => 'Campos de Cep Inválidos',
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
        if ($validarCamposUsuarioAluno->fails()) {
            return back()->withErrors([
                "message" => 'Campo de dados pessoais inválidos',
                "dados" => $validarCamposUsuarioAluno->errors()->all(),
            ])->withInput();
        }

        // Se a validação passou, prosseguimos com a criação do endereço e do usuário
        $validatedDataCep = $validarCamposCep->validated();
        $validatedDataUsuario = $validarCamposUsuario->validated();
        $validatedDataUsuarioAluno = $validarCamposUsuarioAluno->validated();

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
            'foto' => null,
            'numero' => $validatedDataUsuario['numero'],
            'complemento' => $validatedDataUsuario['complemento'] ?? null,
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

        // Tratamento do upload da imagem
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store("imagemPerfilEstudante/$newUsuario->id_usuario", 's3-public');
            $newUsuario->update(['foto' => $fotoPath]);
        }

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

    private function listErrosUsuarioAluno($errors)
    {
        return [
            "id_usuario" => $errors->first('id_usuario'),
            "curso" => $errors->first('curso'),
            "ra" => $errors->first('ra'),
        ];
    }
}
