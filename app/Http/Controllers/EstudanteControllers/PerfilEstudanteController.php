<?php

namespace App\Http\Controllers\EstudanteControllers;

use App\Http\Controllers\CepController;
use App\Http\Controllers\Controller;
use App\Http\Controllers\UsuarioAlunoController;
use App\Http\Controllers\UsuarioController;
use App\Models\Cep;
use App\Models\Cidade;
use App\Models\Estado;
use App\Models\Usuario;
use App\Models\UsuarioAluno;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class PerfilEstudanteController extends Controller
{

    private $cepController;
    private $usuarioController;
    private $usuarioAlunoController;

    public function __construct(
        UsuarioController $usuarioController,
        CepController $cepController,
        UsuarioAlunoController $usuarioAlunoController
    ) {
        $this->cepController = $cepController;
        $this->usuarioController = $usuarioController;
        $this->usuarioAlunoController = $usuarioAlunoController;
    }
    public function index()
    {
        $userId = Auth::id();

        $usuario = Usuario::where('id_usuario', $userId)->first();
        $usuarioEstudante = UsuarioAluno::where('id_usuario', $usuario->id_usuario)->first();
        $cep = Cep::where('id_cep', $usuario->id_cep)->first();
        $cidade = Cidade::where('id_cidade', $cep->id_cidade)->first();
        $estado = Estado::where('id_estado', $cep->id_estado)->first();

        $formattedCep = $this->formatCep($cep->cep);

        return view('usuarioEstudante/perfil/perfil_estudante',
            [
                'usuario' => $usuario,
                'usuarioEstudante' => $usuarioEstudante,
                'nascimentoFormat' => Carbon::parse($usuario->nascimento)->format('d/m/Y'),
                'cep' => $cep,
                'cidade' => $cidade,
                'estado' => $estado,
                'cepFormat' => $formattedCep
            ]
        );
    }

    public function editIndex($usuarioId)
    {
        $usuario = Usuario::where('id_usuario', $usuarioId)->first();
        $usuarioEstudante = UsuarioAluno::where('id_usuario', $usuario->id_usuario)->first();
        $cep = Cep::where('id_cep', $usuario->id_cep)->first();
        $cidade = Cidade::where('id_cidade', $cep->id_cidade)->first();
        $estado = Estado::where('id_estado', $cep->id_estado)->first();

        $formattedCep = $this->formatCep($cep->cep);

        return view('usuarioEstudante/perfil/perfil_edit_estudante',
            [
                'usuario' => $usuario,
                'usuarioEstudante' => $usuarioEstudante,
                'nascimentoFormat' => Carbon::parse($usuario->nascimento)->format('d/m/Y'),
                'cep' => $cep,
                'cidade' => $cidade,
                'estado' => $estado,
                'cepFormat' => $formattedCep
            ]
        );
    }

    public function editStore(Request $request, $usuarioId)
    {

        $request->merge(['tipo_pessoa' => 'FISICA']);

        $usuario = Usuario::findOrFail($usuarioId);
        $usuarioEstudante = UsuarioAluno::where('id_usuario', $usuario->id_usuario)->first();
        $cep = Cep::findOrFail($usuario->id_cep);

        $validarUpdateCep = $this->cepController->validarUpdateCep($cep->id_cep, $request);
        $validarUpdateUsuario = $this->usuarioController->validarUpdateUsuario($usuarioId, $request);
        $validarUpdateUsuarioEstudante = $this->usuarioAlunoController->validarCamposUsuarioEstudanteUpdate($usuarioEstudante, $request);

        // Verifica se a validação dos campos de endereço falhou
        if ($validarUpdateCep->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateCep->errors()->all(),
                ...$this->listErrosEndereco($validarUpdateCep->errors())
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

        // Verifica se a validação dos campos do usuário falhou
        if ($validarUpdateUsuarioEstudante->fails()) {
            return back()->withErrors([
                "message" => 'Campos preenchidos inválidos!',
                "dados" => $validarUpdateUsuarioEstudante->errors()->all(),
                ...$this->listErrosUsuarioEstudante($validarUpdateUsuarioEstudante->errors())
            ]);
        }

        // Se a validação passou, prosseguimos com a Atualização do endereço e do usuário
        $validatedDataCep = $validarUpdateCep->validated();
        $validatedDataUsuario = $validarUpdateUsuario->validated();
        $validatedDataUsuarioEstudante = $validarUpdateUsuarioEstudante->validated();

        // Tratamento do upload da imagem
        if ($request->hasFile('foto') && $request->file('foto')->isValid()) {
            $fotoPath = $request->file('foto')->store('imagemPerfilAluno');
            $validatedDataUsuario['foto'] = $fotoPath;
        }else {
            $validatedDataUsuario['foto'] = null;
        }
        
        $dadosAtualizados = [
            'id_cep' => $validatedDataCep['id_cep'],
            'nome' => $validatedDataUsuario['nome'],
            'sobrenome' => $validatedDataUsuario['sobrenome'],
            'nascimento' => Carbon::createFromFormat('d/m/Y', $validatedDataUsuario['nascimento'])->format('Y-m-d'),
            'telefone' => $validatedDataUsuario['telefone'],
            'email' => $validatedDataUsuario['email'],
            'email_secundario' => $validatedDataUsuario['email_secundario'] ?? null,
            'foto' => $validatedDataUsuario['foto'],
            'numero' => $validatedDataUsuario['numero'],
            'complemento' => $validatedDataUsuario['complemento'] ?? null,
            'tipo_pessoa' => $validatedDataUsuario['tipo_pessoa'],
            'instituicao' => $validatedDataUsuario['instituicao'] ?? null,
        ];

        if (filled($validatedDataUsuario['password'])) {
            $dadosAtualizados['password'] = Hash::make($validatedDataUsuario['password']);
        }

        $usuario->update($dadosAtualizados);

        $usuarioEstudante->update($validatedDataUsuarioEstudante);

        return redirect()->route('perfil_index_estudante')->with('perfil-update', 'Perfil atualizado com sucesso!');
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


    private function listErrosUsuarioEstudante($errors)
    {
        return [
            "id_usuario" => $errors->first('id_usuario'),
            "curso" => $errors->first('curso'),
            "ra" => $errors->first('ra'),
        ];
    }

    private function formatCep($cep) {
        $cep = preg_replace('/[^0-9]/', '', $cep);
        if (strlen($cep) === 8) {
            return substr($cep, 0, 5) . '-' . substr($cep, 5);
        }
        return $cep;
    }
}
