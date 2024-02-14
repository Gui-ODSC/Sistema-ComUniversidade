<?php

namespace App\Http\Controllers;

use App\Enums\TipoOfertaEnum;
use App\Models\AreaConhecimento;
use App\Models\Oferta;
use App\Models\UsuarioProfessor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class OfertaController extends Controller
{
    protected $ofertaModel;

    public function __construct(Oferta $ofertaModel)
    {
        $this->ofertaModel = $ofertaModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_usuario_professor' => [
                'required',
                Rule::exists(UsuarioProfessor::class, 'id_usuario_professor')
            ],
            'id_area_conhecimento' => [
                'required',
                Rule::exists(AreaConhecimento::class, 'id_area_conhecimento')
            ],
            'titulo' => 'required|string|max:255',
            'descricao' => 'required|string|max:255',
            'tipo' => [
                new Enum(TipoOfertaEnum::class)
            ]
        ];
    }

    public function list()
    {
        $oferta = $this->ofertaModel::all();
        
        return response()->json([
            'message' => 'Oferta successfully recovered',
            'data' => $oferta
        ]);
    }

    public function get($id_oferta)
    {
        return $this->ofertaModel::findOrFail($id_oferta);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $oferta = $this->ofertaModel::create([
            'id_usuario_professor' => $validatedData['id_usuario_professor'],
            'id_area_conhecimento' => $validatedData['id_area_conhecimento'],
            'titulo' => $validatedData['titulo'],
            'descricao' => $validatedData['descricao'],
            'tipo' => $validatedData['tipo']
        ]);

        return response()->json([
            'message' => 'Oferta Created successfull',
            'data' => $oferta
        ])->setStatusCode(201); 
    }

    public function update($id_oferta, Request $request)
    {
        $validator = Validator::make($request->all(), $this->getValidationSchema());

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $oferta = $this->ofertaModel::findOrFail($id_oferta);

        $oferta->update([
            'id_usuario_professor' => $validatedData['id_usuario_professor'],
            'id_area_conhecimento' => $validatedData['id_area_conhecimento'],
            'titulo' => $validatedData['titulo'],
            'descricao' => $validatedData['descricao'],
            'tipo' => $validatedData['tipo']
        ]);

        return response()->json([
            'message' => 'Oferta Updated Successfully',
            'data' => $oferta
        ])->setStatusCode(200);
    }

    public function delete($id_oferta) 
    {
            
        $oferta = $this->ofertaModel->findOrFail($id_oferta);
        $oferta->delete();

        return response()->json([
            'message' => 'Oferta deleted successfully'
        ])->setStatusCode(200);

    }
}
