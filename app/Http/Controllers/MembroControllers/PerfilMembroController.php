<?php

namespace App\Http\Controllers\MembroControllers;

use App\Http\Controllers\Controller;
use App\Http\Controllers\EnderecoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Bairro;
use App\Models\Cidade;
use App\Models\Endereco;
use App\Models\Estado;
use App\Models\Usuario;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilMembroController extends Controller
{

    private $enderecoController;
    private $usuarioController;

    public function __construct(
        UsuarioController $usuarioController,
        EnderecoController $enderecoController
    ) {
        $this->enderecoController = $enderecoController;
        $this->usuarioController = $usuarioController;
    }
    public function index()
    {
        $userId = Auth::id();

        $usuario = Usuario::where('id_usuario', $userId)->first();
        $endereco = Endereco::where('id_endereco', $usuario->id_endereco)->first();
        $cidade = Cidade::where('id_cidade', $endereco->id_cidade)->first();
        $bairro = Bairro::where('id_bairro', $endereco->id_bairro)->first();
        $estado = Estado::where('id_estado', $endereco->id_estado)->first();

        return view(
            'usuarioMembro/perfil/perfil_membro',
            [
                'usuario' => $usuario,
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
        $endereco = Endereco::where('id_endereco', $usuario->id_endereco)->first();
        $cidade = Cidade::where('id_cidade', $endereco->id_cidade)->first();
        $bairro = Bairro::where('id_bairro', $endereco->id_bairro)->first();
        $estado = Estado::where('id_estado', $endereco->id_estado)->first();

        $cidades = Cidade::all();
        $bairros = Bairro::all();
        $estados = Estado::all();
        
        return view(
            'usuarioMembro/perfil/perfil_edit_membro',
            [
                'usuario' => $usuario,
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
        $endereco = Endereco::findOrFail($usuario->id_endereco);

        $validarUpdateEndereco = $this->enderecoController->validarUpdateEndereco($endereco->id_endereco, $request);
        $validarUpdateUsuario = $this->usuarioController->validarUpdateUsuario($usuarioId, $request);

        // Verifica se a validação dos campos de endereço falhou
        if ($validarUpdateEndereco->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateEndereco->errors()->all(),
                ...$this->listErrosEndereco($validarUpdateEndereco->errors())
            ]);
        }

        // Verifica se a validação dos campos do usuário falhou
        if ($validarUpdateUsuario->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateUsuario->errors()->all(),
                ...$this->listErrosUsuario($validarUpdateUsuario->errors())
            ]);
        }

        // Se a validação passou, prosseguimos com a Atualização do endereço e do usuário
        $validatedDataEndereco = $validarUpdateEndereco->validated();
        $validatedDataUsuario = $validarUpdateUsuario->validated();

        $endereco->update($validatedDataEndereco);

        $dadosAtualizados = [
            'nome' => $validatedDataUsuario['nome'],
            'sobrenome' => $validatedDataUsuario['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedDataUsuario['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedDataUsuario['telefone'],
            'email' => $validatedDataUsuario['email'],
            'email_secundario' => $validatedDataUsuario['email_secundario'] ?? null,
            'foto' => $validatedDataUsuario['foto'] ?? null,
        ];

        if (filled($validatedDataUsuario['password'])) {
            $dadosAtualizados['password'] = Hash::make($validatedDataUsuario['password']);
        }

        $usuario->update($dadosAtualizados);

        return redirect()->route('perfil_index')->with('perfil-update', 'Perfil atualizado com sucesso!');
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
