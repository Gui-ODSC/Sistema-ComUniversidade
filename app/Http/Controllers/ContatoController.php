<?php

namespace App\Http\Controllers;

use App\Models\Contato;
use App\Models\Demanda;
use App\Models\Oferta;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class ContatoController extends Controller
{
    protected $contatoModel;

    public function __construct(Contato $contatoModel)
    {
        $this->contatoModel = $contatoModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_usuario_origem' => [
                'required',
                Rule::exists(Usuario::class, 'id_usuario')
            ],
            'id_usuario_destino' => [
                'required',
                Rule::exists(Usuario::class, 'id_usuario')
            ],
            'id_oferta' => [
                'required_if:id_demanda, null',
                Rule::exists(Oferta::class, 'id_oferta')
            ],
            'id_demanda' => [
                'required_if:id_oferta, null',
                Rule::exists(Demanda::class, 'id_demanda')
            ],
        ];
    }

    public function list()
    {
        $contato = $this->contatoModel::all();
        
        return response()->json([
            'message' => 'Contato successfully recovered',
            'data' => $contato
        ]);
    }

    public function get($id_contato)
    {
        return $this->contatoModel::findOrFail($id_contato);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_origem' => [
                Rule::unique(Contato::class, 'id_usuario_origem')
                    ->where('id_usuario_destino', $request->input('id_usuario_destino'))
                    ->where('id_oferta', $request->input('id_oferta'))
                    ->where('id_demanda', $request->input('id_demanda'))
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $contato = $this->contatoModel::create([
            'id_usuario_origem' => $validatedData['id_usuario_origem'],
            'id_usuario_destino' => $validatedData['id_usuario_destino'],
            'id_oferta' => $validatedData['id_oferta'],
            'id_demanda' => $validatedData['id_demanda'],
        ]);

        return response()->json([
            'message' => 'Contato Created successfull',
            'data' => $contato
        ])->setStatusCode(201); 
    }

    public function update($id_contato, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_usuario_origem' => [
                Rule::unique(Contato::class, 'id_usuario_origem')
                    ->where('id_usuario_destino', $request->input('id_usuario_destino'))
                    ->where('id_oferta', $request->input('id_oferta'))
                    ->where('id_demanda', $request->input('id_demanda'))
            ]
        ]);
        
        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $contato = $this->contatoModel::findOrFail($id_contato);

        $contato->update([
            'id_usuario_origem' => $validatedData['id_usuario_origem'],
            'id_usuario_destino' => $validatedData['id_usuario_destino'],
            'id_oferta' => $validatedData['id_oferta'],
            'id_demanda' => $validatedData['id_demanda'],
        ]);

        return response()->json([
            'message' => 'Contato Updated Successfully',
            'data' => $contato
        ])->setStatusCode(200);
            
    }

    public function delete($id_contato) 
    {
            
        $contato = $this->contatoModel->findOrFail($id_contato);
        $contato->delete();

        return response()->json([
            'message' => 'Contato deleted successfully'
        ])->setStatusCode(200);

    }
}
