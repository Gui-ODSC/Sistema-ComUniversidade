<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use App\Models\UsuarioProfessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class UsuarioProfessorController extends Controller
{
    protected $usuarioProfessorModel;

    public function __construct(UsuarioProfessor $usuarioProfessorModel)
    {
        $this->usuarioProfessorModel = $usuarioProfessorModel;
    }

    private function getValidationSchema()
    {
        return [
            'link_curriculo' => 'nullable|string|max:255|url:http,https',
            'numero_registro' => 'required|integer'
        ];
    }

    public function list()
    {
        $usuarioProfessor = $this->usuarioProfessorModel::all();
        
        return $usuarioProfessor;
    }

    public function get($id_usuario_professor)
    {
        return $this->usuarioProfessorModel::findOrFail($id_usuario_professor);
    }

    public function validarCamposUsuarioProfessorCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_professor' => [
                Rule::unique(UsuarioProfessor::class, 'id_usuario_professor')
                    ->where('id_usuario', $request->input('id_usuario'))
            ]
        ], $this->messageValidation());

        return $validator;
        
    }

    public function validarCamposUsuarioProfessorUpdate($id_usuario_professor, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_professor' => [
                Rule::unique(UsuarioProfessor::class, 'id_usuario_professor')
                    ->where('id_usuario', $request->input('id_usuario'))
                    ->ignore($id_usuario_professor, 'id_usuario_professor')
            ]
        ], $this->messageValidation());

        return $validator;
        
    }

    public function delete($id_usuario_professor) 
    {
        $usuarioProfessor = $this->usuarioProfessorModel->findOrFail($id_usuario_professor);
        $usuarioProfessor->delete();

        return response()->json([
            'message' => 'Usuario Professor deleted successfully'
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'link_curriculo.string' => 'Campo link deve ser um texto.',
            'link_curriculo.max' => 'Campo link ultrapassou a quantidade de caracteres',
            'link_curriculo.url' => 'O campo para o Link do curriculo deve conter https ou http.',
            'numero_registro.required' => 'Campo Numero de Registro é obrigatório.',
            'numero_registro.integer' => 'Campo Numero de Registro deve ser um numero inteiro.',
        ];
    }
}
