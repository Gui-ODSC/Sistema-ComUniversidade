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
                'required_if:id_oferta,',
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
        
        return $ofertaConhecimento;
    }

    public function get($id_oferta_conhecimento)
    {
        return $this->ofertaConhecimentoModel::findOrFail($id_oferta_conhecimento);
    }

    public function validarCamposOfertaConhecimentoCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_oferta_conhecimento' => [
                Rule::unique(OfertaConhecimento::class, 'id_oferta_conhecimento')
                    ->where('id_oferta', $request->input('id_oferta'))
            ]
        ], $this->messageValidation());

        return $validator;
    }

    public function validarCamposOfertaConhecimentoUpdate(Request $request, $ofertaId)
    {
        $ofertaConhecimento = OfertaConhecimento::where('id_oferta', $ofertaId)->first();

        $dadosValidacao = array_merge($request->all(), ['id_oferta' => $ofertaId]);

        $validator = Validator::make($dadosValidacao, [
            ...$this->getValidationSchema(),
            'id_oferta_conhecimento' => [
                Rule::unique(OfertaConhecimento::class, 'id_oferta_conhecimento')
                    ->where('id_oferta', $request->input('id_oferta'))
                    ->ignore($ofertaConhecimento->id_oferta_conhecimento, 'id_oferta_conhecimento')
            ]
        ], $this->messageValidation());

        return $validator;
    }

    protected function messageValidation()
    {
        return [
            'id_oferta.unique' => 'Essa oferta já existe. Por favor, escolha outra.',
            'id_oferta.exists' => 'Essa oferta não existe no banco de dados.',
            'id_oferta.required' => 'Oferta é um campo Obrigatório.',
            'tempo_atuacao.required' => 'O valor selecionado para o Tempo Atuação é Obrigatório.',
            'tempo_atuacao' => 'O valor selecionado para o Tempo Atuação é inválido.',
            'data_limite' => 'Valor inválido para a data limite', 
            'link_lattes.string' => 'O valor para o Link Lattes deve ser um texto.',
            'link_lattes.url' => 'O valor para o Link Lattes deve conter https ou http.',
            'link_linkedin.string' => 'O valor para o Link Linkedin deve ser um texto.',
            'link_linkedin.url' => 'O valor para o Link Linkedin deve conter https ou http.',
        ];
    }
}
