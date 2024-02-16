<?php

namespace App\Http\Controllers;

use App\Enums\DuracaoOfertaAcao;
use App\Enums\RegimeOfertaAcao;
use App\Enums\StatusRegistroOfertaAcaoEnum;
use App\Models\Oferta;
use App\Models\OfertaAcao;
use App\Models\PublicoAlvo;
use App\Models\TipoAcao;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class OfertaAcaoController extends Controller
{
    protected $ofertaAcaoModel;

    public function __construct(OfertaAcao $ofertaAcaoModel)
    {
        $this->ofertaAcaoModel = $ofertaAcaoModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_oferta' => [
                'required',
                Rule::exists(Oferta::class, 'id_oferta')
            ],
            'id_tipo_acao' => [
                'required',
                Rule::exists(TipoAcao::class, 'id_tipo_acao')
            ],
            'id_publico_alvo' => [
                'required',
                Rule::exists(PublicoAlvo::class, 'id_publico_alvo')
            ],
            'status_registro' => [
                new Enum(StatusRegistroOfertaAcaoEnum::class)
            ],
            'duracao' => [
                new Enum(DuracaoOfertaAcao::class)
            ],
            'regime' => [
                new Enum(RegimeOfertaAcao::class)
            ]
        ];
    }

    public function list()
    {
        $ofertaAcao = $this->ofertaAcaoModel::all();
        
        return response()->json([
            'message' => 'Oferta Acao successfully recovered',
            'data' => $ofertaAcao
        ]);
    }

    public function get($id_oferta_acao)
    {
        return $this->ofertaAcaoModel::findOrFail($id_oferta_acao);
    }

    public function create(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_oferta_acao' => [
                Rule::unique(OfertaAcao::class, 'id_oferta_acao')
                    ->where('id_oferta', $request->input('id_oferta'))
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}

        $validatedData = $validator->validated();

        $oferta = $this->ofertaAcaoModel::create([
            'id_oferta' => $validatedData['id_oferta'],
            'id_tipo_acao' => $validatedData['id_tipo_acao'],
            'id_publico_alvo' => $validatedData['id_publico_alvo'],
            'status_registro' => $validatedData['status_registro'],
            'duracao' => $validatedData['duracao'],
            'regime' => $validatedData['regime']
        ]);

        return response()->json([
            'message' => 'Oferta Acao Created successfull',
            'data' => $oferta
        ])->setStatusCode(201); 
    }

    public function update($id_oferta_acao, Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_oferta_acao' => [
                Rule::unique(OfertaAcao::class, 'id_oferta_acao')
                    ->where('id_oferta', $request->input('id_oferta'))
            ]
        ]);

        if ($validator->fails()) {
			return response($validator->errors())->setStatusCode(400);
		}
        
        $validatedData = $validator->validated();

        $ofertaAcao = $this->ofertaAcaoModel::findOrFail($id_oferta_acao);

        $ofertaAcao->update([
            'id_oferta' => $validatedData['id_oferta'],
            'id_tipo_acao' => $validatedData['id_tipo_acao'],
            'id_publico_alvo' => $validatedData['id_publico_alvo'],
            'status_registro' => $validatedData['status_registro'],
            'duracao' => $validatedData['duracao'],
            'regime' => $validatedData['regime']
        ]);

        return response()->json([
            'message' => 'Oferta Acao Updated Successfully',
            'data' => $ofertaAcao
        ])->setStatusCode(200);
    }

    public function delete($id_oferta_acao) 
    {
            
        $ofertaAcao = $this->ofertaAcaoModel->findOrFail($id_oferta_acao);
        $ofertaAcao->delete();

        return response()->json([
            'message' => 'Oferta Acao deleted successfully'
        ])->setStatusCode(200);

    }
}
