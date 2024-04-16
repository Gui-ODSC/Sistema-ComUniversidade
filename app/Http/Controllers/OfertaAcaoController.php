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
                'required_if:id_oferta,',
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
            ],
            'data_limite' => 'nullable|date'
        ];
    }

    public function list()
    {
        $ofertaAcao = $this->ofertaAcaoModel::all();
        
        return $ofertaAcao;
    }

    public function get($id_oferta_acao)
    {
        return $this->ofertaAcaoModel::findOrFail($id_oferta_acao);
    }

    public function validarCamposOfertaAcaoCreate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            ...$this->getValidationSchema(),
            'id_oferta_acao' => [
                Rule::unique(OfertaAcao::class, 'id_oferta_acao')
                    ->where('id_oferta', $request->input('id_oferta'))
            ]
        ], $this->messageValidation());

        return $validator;
        
    }

    public function validarCamposOfertaAcaoUpdate(Request $request, $ofertaId)
    {
        $ofertaAcao = OfertaAcao::where('id_oferta', $ofertaId)->first();

        $dadosValidacao = array_merge($request->all(), ['id_oferta' => $ofertaId]);

        $validator = Validator::make($dadosValidacao, [
            ...$this->getValidationSchema(),
            'id_oferta_acao' => [
                Rule::unique(OfertaAcao::class, 'id_oferta_acao')
                    ->where('id_oferta', $request->input('id_oferta'))
                    ->ignore($ofertaAcao->id_oferta_acao, 'id_oferta_acao')
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
            'id_tipo_acao.required' => 'O campo ID da modalidade é obrigatória.',
            'id_tipo_acao.exists' => 'O ID da modalidade fornecida é inválida.',
            'id_publico_alvo.required' => 'O campo ID do id_publico_alvo é obrigatório.',
            'id_publico_alvo.exists' => 'O ID do id_publico_alvo fornecido é inválido.',
            'status_registro.required' => 'O valor selecionado para o Status de Registro é Obrigatório.',
            'status_registro' => 'O valor selecionado para o Status de Registro é inválido.',
            'duracao.required' => 'O valor selecionado para a Duracão da oferta é Obrigatório.',
            'duracao' => 'O valor selecionado para a Duracão da oferta é inválido.',
            'regime.required' => 'O valor selecionado para o Regime de oferta é Obrigatório.',
            'regime' => 'O valor selecionado para o Regime de oferta é inválido.',
            'data_limite' => 'Valor inválido para a data limite', 
        ];
    }
}
