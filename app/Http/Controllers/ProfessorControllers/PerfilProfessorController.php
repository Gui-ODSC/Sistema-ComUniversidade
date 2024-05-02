<?php

namespace App\Http\Controllers\ProfessorControllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\UsuarioAlunoController;
use App\Http\Controllers\UsuarioController;
use App\Http\Controllers\UsuarioProfessorController;
use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Usuario;
use App\Models\UsuarioAluno;
use App\Models\UsuarioProfessor;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilProfessorController extends Controller
{

    private $enderecoController;
    private $usuarioController;
    private $usuarioProfessorController;

    public function __construct(
        UsuarioController $usuarioController,
        EnderecoController $enderecoController,
        UsuarioProfessorController $usuarioProfessorController
    ) {
        $this->enderecoController = $enderecoController;
        $this->usuarioController = $usuarioController;
        $this->usuarioProfessorController = $usuarioProfessorController;
    }
    public function index()
    {
        $userId = Auth::id();

        $usuario = Usuario::where('id_usuario', $userId)->first();
        $usuarioProfessor = UsuarioProfessor::where('id_usuario', $usuario->id_usuario)->first();
        $endereco = Endereco::where('id_endereco', $usuario->id_endereco)->first();
        $cidade = Cidade::where('id_cidade', $endereco->id_cidade)->first();
        $bairro = Bairro::where('id_bairro', $endereco->id_bairro)->first();
        $estado = Estado::where('id_estado', $endereco->id_estado)->first();

        return view('usuarioProfessor/perfil/perfil_professor',
            [
                'usuario' => $usuario,
                'usuarioProfessor' => $usuarioProfessor,
                'nascimentoFormat' => Carbon::parse($usuario->nascimento)->format('d/m/Y'),
                'endereco' => $endereco,
                'cidade' => $cidade,
                'bairro' => $bairro,
                'estado' => $estado,
            ]
        );
    }

    public function editIndex($usuarioId)
    {
        $usuario = Usuario::where('id_usuario', $usuarioId)->first();
        $usuarioProfessor = UsuarioProfessor::where('id_usuario', $usuario->id_usuario)->first();
        $endereco = Endereco::where('id_endereco', $usuario->id_endereco)->first();
        $cidade = Cidade::where('id_cidade', $endereco->id_cidade)->first();
        $bairro = Bairro::where('id_bairro', $endereco->id_bairro)->first();
        $estado = Estado::where('id_estado', $endereco->id_estado)->first();

        $cidades = Cidade::all();
        $bairros = Bairro::all();
        $estados = Estado::all();
        
        return view('usuarioProfessor/perfil/perfil_edit_professor',
            [
                'usuario' => $usuario,
                'usuarioProfessor' => $usuarioProfessor,
                'nascimentoFormat' => Carbon::parse($usuario->nascimento)->format('d/m/Y'),
                'endereco' => $endereco,
                'cidade' => $cidade,
                'bairro' => $bairro,
                'estado' => $estado,
                'listCidades' => $cidades,
                'listBairros' => $bairros,
                'listEstados' => $estados,
            ]
        );
    }

    public function editStore(Request $request, $usuarioId)
    {
        $usuario = Usuario::findOrFail($usuarioId);
        $usuarioProfessor = UsuarioProfessor::where('id_usuario', $usuario->id_usuario)->first();
        $endereco = Endereco::findOrFail($usuario->id_endereco);

        $validarUpdateEndereco = $this->enderecoController->validarUpdateEndereco($endereco->id_endereco, $request);
        $validarUpdateUsuario = $this->usuarioController->validarUpdateUsuario($usuarioId, $request);
        $validarUpdateUsuarioProfessor = $this->usuarioProfessorController->validarCamposUsuarioProfessorUpdate($usuarioProfessor, $request);

        // Verifica se a validação dos campos de endereço falhou
        if ($validarUpdateEndereco->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateEndereco->errors()->all(),
            ]);
        }

        // Verifica se a validação dos campos do usuário falhou
        if ($validarUpdateUsuario->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateUsuario->errors()->all(),
            ]);
        }

        // Verifica se a validação dos campos do usuário falhou
        if ($validarUpdateUsuarioProfessor->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateUsuarioProfessor->errors()->all(),
            ]);
        }

        // Se a validação passou, prosseguimos com a Atualização do endereço e do usuário
        $validatedDataEndereco = $validarUpdateEndereco->validated();
        $validatedDataUsuario = $validarUpdateUsuario->validated();
        $validatedDataUsuarioProfessor = $validarUpdateUsuarioProfessor->validated();

        $endereco->update($validatedDataEndereco);

        $dadosAtualizados = [
            'nome' => $validatedDataUsuario['nome'],
            'sobrenome' => $validatedDataUsuario['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedDataUsuario['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedDataUsuario['telefone'],
            'email' => $validatedDataUsuario['email'],
            'email_secundario' => $validatedDataUsuario['email_secundario'] ?? null,
            'foto' => $validatedDataUsuario['foto']->store('imagemPerfilProfessor') ?? null,
            'tipo_pessoa' => $validatedDataUsuario['tipo_pessoa'],
            'instituicao' => $validatedDataUsuario['instituicao'] ?? null,
        ];

        if (filled($validatedDataUsuario['password'])) {
            $dadosAtualizados['password'] = Hash::make($validatedDataUsuario['password']);
        }

        $usuario->update($dadosAtualizados);

        $usuarioProfessor->update($validatedDataUsuarioProfessor);

        return redirect()->route('perfil_index_professor')->with('perfil-update', 'Perfil atualizado com sucesso!');
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

    private function listErrosUsuarioProfessor($errors)
    {
        return [
            "id_usuario" => $errors->first('id_usuario'),
            'link_curriculo' => $errors->first('link_curriculo'),
            'numero_registro' => $errors->first('numero_registro'), 
        ];
    }
}
