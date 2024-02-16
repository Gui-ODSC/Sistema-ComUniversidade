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
            'id_usuario' => [
                'required',
                Rule::exists(Usuario::class, 'id_usuario')
            ],
            'curso' => 'required|string|max:255',
            'ra' => 'required|integer|min:0|max:9'
        ];
    }

    public function list()
    {
        $usuarioAluno = $this->usuarioAlunoModel::all();
        
        return response()->json([
            'message' => 'Usuario Aluno successfully recovered',
            'data' => $usuarioAluno
        ]);
    }

    public function get($id_usuario_aluno)
    {
        return $this->usuarioAlunoModel::findOrFail($id_usuario_aluno);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_aluno' => [
                Rule::unique(UsuarioAluno::class, 'id_usuario_aluno')
                    ->where('id_usuario', $request->input('id_usuario'))
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $usuarioAluno = $this->usuarioAlunoModel::create([
            'id_usuario' => $validatedData['id_usuario'],
            'curso' => $validatedData['curso'],
            'ra' => $validatedData['ra'],
        ]);

        return response()->json([
            'message' => 'Usuario Aluno Created successfull',
            'data' => $usuarioAluno
        ])->setStatusCode(201); 
    }

    public function update($id_usuario_aluno, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_aluno' => [
                Rule::unique(UsuarioAluno::class, 'id_usuario_aluno')
                    ->where('id_usuario', $request->input('id_usuario'))
            ] 
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $usuarioAluno = $this->usuarioAlunoModel::findOrFail($id_usuario_aluno);

        $usuarioAluno->update([
            'id_usuario' => $validatedData['id_usuario'],
            'curso' => $validatedData['curso'],
            'ra' => $validatedData['ra'],
        ]);

        return response()->json([
            'message' => 'Usuario Aluno Updated Successfully',
            'data' => $usuarioAluno
        ])->setStatusCode(200);
        
    }

    public function delete($id_usuario_aluno) 
    {
        $usuarioAluno = $this->usuarioAlunoModel->findOrFail($id_usuario_aluno);
        $usuarioAluno->delete();

        return response()->json([
            'message' => 'Usuario Aluno deleted successfully'
        ])->setStatusCode(200);

    }
}
