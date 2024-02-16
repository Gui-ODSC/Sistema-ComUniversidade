<?php

namespace App\Http\Controllers;

use App\Enums\TempoAtuacaoOfertaConhecimentoEnum;
use App\Models\Oferta;
use App\Models\OfertaConhecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class OfertaConhecimentoController extends Controller
{
    protected $ofertaConhecimentoModel;

    public function __construct(OfertaConhecimento $ofertaConhecimentoModel)
    {
        $this->ofertaConhecimentoModel = $ofertaConhecimentoModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_oferta' => [
                'required',
                Rule::exists(Oferta::class, 'id_oferta')
            ],
            'tempo_atuacao' => [
                new Enum(TempoAtuacaoOfertaConhecimentoEnum::class)
            ],
            'link_lattes' => 'nullable|string|url:http,https',
            'link_linkedin' => 'nullable|string|url:http,https'
        ];
    }

    public function list()
    {
        $ofertaConhecimento = $this->ofertaConhecimentoModel::all();
        
        return response()->json([
            'message' => 'Oferta Conhecimento successfully recovered',
            'data' => $ofertaConhecimento
        ]);
    }

    public function get($id_oferta_conhecimento)
    {
        return $this->ofertaConhecimentoModel::findOrFail($id_oferta_conhecimento);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_oferta_conhecimento' => [
                Rule::unique(OfertaConhecimento::class, 'id_oferta_conhecimento')
                    ->where('id_oferta', $request->input('id_oferta'))
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $oferta = $this->ofertaConhecimentoModel::create([
            'id_oferta' => $validatedData['id_oferta'],
            'tempo_atuacao' => $validatedData['tempo_atuacao'],
            'link_lattes' => $validatedData['link_lattes'],
            'link_linkedin' => $validatedData['link_linkedin']
        ]);

        return response()->json([
            'message' => 'Oferta Conhecimento Created successfull',
            'data' => $oferta
        ])->setStatusCode(201); 
    }

    public function update($id_oferta_conhecimento, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_oferta_conhecimento' => [
                Rule::unique(OfertaConhecimento::class, 'id_oferta_conhecimento')
                    ->where('id_oferta', $request->input('id_oferta'))
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $ofertaConhecimento = $this->ofertaConhecimentoModel::findOrFail($id_oferta_conhecimento);

        $ofertaConhecimento->update([
            'id_oferta' => $validatedData['id_oferta'],
            'tempo_atuacao' => $validatedData['tempo_atuacao'],
            'link_lattes' => $validatedData['link_lattes'],
            'link_linkedin' => $validatedData['link_linkedin']
        ]);

        return response()->json([
            'message' => 'Oferta Conhecimento Updated Successfully',
            'data' => $ofertaConhecimento
        ])->setStatusCode(200);
    }

    public function delete($id_oferta_conhecimento) 
    {
            
        $ofertaConhecimento = $this->ofertaConhecimentoModel->findOrFail($id_oferta_conhecimento);
        $ofertaConhecimento->delete();

        return response()->json([
            'message' => 'Oferta Conhecimento deleted successfully'
        ])->setStatusCode(200);

    }
}
