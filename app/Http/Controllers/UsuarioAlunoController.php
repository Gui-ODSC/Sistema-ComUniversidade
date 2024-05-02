<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioAluno;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuarioAlunoController extends Controller
{
    protected $usuarioAlunoModel;

    public function __construct(UsuarioAluno $usuarioAlunoModel)
    {
        $this->usuarioAlunoModel = $usuarioAlunoModel;
    }

    private function getValidationSchema()
    {
        return [
            'curso' => 'required|string|max:255',
            'ra' => 'required|integer'
        ];
    }

    public function list()
    {
        $usuarioAluno = $this->usuarioAlunoModel::all();
        
        return $usuarioAluno;
    }

    public function get($id_usuario_aluno)
    {
        return $this->usuarioAlunoModel::findOrFail($id_usuario_aluno);
    }

    public function validarCamposUsuarioEstudanteCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_aluno' => [
                Rule::unique(UsuarioAluno::class, 'id_usuario_aluno')
                    ->where('id_usuario', $request->input('id_usuario'))
            ]
        ], $this->messageValidation());

        return $validator;
        
    }

    public function validarCamposUsuarioEstudanteUpdate($id_usuario_aluno, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_aluno' => [
                Rule::unique(UsuarioAluno::class, 'id_usuario_aluno')
                    ->where('id_usuario', $request->input('id_usuario'))
                    ->ignore($id_usuario_aluno, 'id_usuario_aluno')
            ]
        ], $this->messageValidation());

        return $validator;
        
    }

    public function delete($id_usuario_aluno) 
    {
        $usuarioAluno = $this->usuarioAlunoModel->findOrFail($id_usuario_aluno);
        $usuarioAluno->delete();

        return response()->json([
            'message' => 'Usuario Aluno deleted successfully'
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'curso.required' => 'Campo curso é obrigatório.',
            'curso.string' => 'Campo curso deve ser um texto.',
            'curso.max' => 'Campo curso ultrapassou a quantidade de caracteres',
            'ra.required' => 'Campo RA é obrigatório.',
            'ra.string' => 'Campo RA deve ser um texto.',
            'ra.max' => 'Campo RA ultrapassou a quantidade de caracteres',
        ];
    }
}
