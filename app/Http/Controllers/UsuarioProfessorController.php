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
            'id_usuario' => [
                'required',
                Rule::exists(Usuario::class, 'id_usuario')
            ],
            'link_curriculo' => 'required|string|max:255'
        ];
    }

    public function list()
    {
        $usuarioProfessor = $this->usuarioProfessorModel::all();
        
        return response()->json([
            'message' => 'Usuario Professor successfully recovered',
            'data' => $usuarioProfessor
        ]);
    }

    public function get($id_usuario_professor)
    {
        return $this->usuarioProfessorModel::findOrFail($id_usuario_professor);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $usuarioProfessor = $this->usuarioProfessorModel::create([
            'id_usuario' => $validatedData['id_usuario'],
            'link_curriculo' => $validatedData['link_curriculo']
        ]);

        return response()->json([
            'message' => 'Usuario Professor Created successfull',
            'data' => $usuarioProfessor
        ])->setStatusCode(201); 
    }

    public function update($id_usuario_professor, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $usuarioProfessor = $this->usuarioProfessorModel::findOrFail($id_usuario_professor);

        $usuarioProfessor->update([
            'id_usuario' => $validatedData['id_usuario'],
            'link_curriculo' => $validatedData['link_curriculo']
        ]);

        return response()->json([
            'message' => 'Usuario Professor Updated Successfully',
            'data' => $usuarioProfessor
        ])->setStatusCode(200);
        
    }

    public function delete($id_usuario_professor) 
    {
        $usuarioProfessor = $this->usuarioProfessorModel->findOrFail($id_usuario_professor);
        $usuarioProfessor->delete();

        return response()->json([
            'message' => 'Usuario Professor deleted successfully'
        ])->setStatusCode(200);

    }
}
