<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\CepController;
use App\Http\Controllers\CidadeController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\EstadoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Cep;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Hash;

class CadastroMembroController extends Controller
{
    private $usuarioController;
    private $usuarioModel;
    private $cepModel;
    private $cepController;
    private $cidadeController;
    private $estadoController;

    public function __construct(
        UsuarioController $usuarioController,
        CidadeController $cidadeController,
        EstadoController $estadoController,
        Usuario $usuarioModel,
        Cep $cepModel,
        CepController $cepController

    ) {
        $this->usuarioController = $usuarioController;
        $this->usuarioModel = $usuarioModel;
        $this->cepModel = $cepModel;
        $this->cepController = $cepController;
        $this->cidadeController = $cidadeController;
        $this->estadoController = $estadoController;
    }

    public function index()
    {
        return view('usuarioMembro/cadastro/cadastro_membro');
    }

    public function create(Request $request)
    {
        $validarCamposCep = $this->cepController->validarCamposCep($request);
        $validarCamposUsuario = $this->usuarioController->validarCamposUsuario($request);
    
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
    
        // Se a validação passou, prosseguimos com a criação do endereço e do usuário
        $validatedDataCep = $validarCamposCep->validated();
        $validatedDataUsuario = $validarCamposUsuario->validated();
    
        // Criação do usuário com o ID do endereço recém-criado
        $usuario = $this->usuarioModel::create([
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
            'tipo' => 'MEMBRO',
            'tipo_pessoa' => $validatedDataUsuario['tipo_pessoa'],
            'instituicao' => $validatedDataUsuario['instituicao'] ?? null,
        ]);

        // Tratamento do upload da imagem
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store("imagemPerfilMembro/$usuario->id_usuario", 's3-public');
            $usuario->update(['foto' => $fotoPath]);
        }

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
}
