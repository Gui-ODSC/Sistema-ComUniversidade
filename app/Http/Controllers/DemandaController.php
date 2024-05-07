<?php

namespace App\Http\Controllers;

use App\Enums\DuracaoDemandaEnum;
use App\Enums\NivelPrioridadeDemandaEnum;
use App\Models\AreaConhecimento;
use App\Models\Demanda;
use App\Models\PublicoAlvo;
use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Enum;

class DemandaController extends Controller
{
    protected $demandaModel;

    public function __construct(Demanda $demandaModel)
    {
        $this->demandaModel = $demandaModel;
    }

    private function getValidationSchema()
    {
        return [
            'id_usuario' => [
                'required',
                Rule::exists(Usuario::class, 'id_usuario'),
            ],
            'id_publico_alvo' => [
                'required',
                Rule::exists(PublicoAlvo::class, 'id_publico_alvo')
            ],
            'id_area_conhecimento' => [
                'required',
                Rule::exists(AreaConhecimento::class, 'id_area_conhecimento')
            ],
            'titulo' => 'required|string|max:150',
            'descricao' => 'required|string',
            'pessoas_afetadas' => 'required|integer|min:1',
            'duracao' => [
                'required',
                new Enum(DuracaoDemandaEnum::class)
            ],
            'nivel_prioridade' => [
                'required',
                new Enum(NivelPrioridadeDemandaEnum::class)
            ],
            'instituicao_setor' => 'string|max:255|nullable'
        ];
    }

    public function list()
    {
        $demanda = $this->demandaModel::all();
        
        return $demanda;
    }

    public function get($id_demanda)
    {
        return $this->demandaModel::findOrFail($id_demanda);
    }

    public function validarCamposDemandaCreate(Request $request)
    {

        $idUsuarioLogado = auth()->id();

        $dadosValidacao = array_merge($request->all(), ['id_usuario' => $idUsuarioLogado]);

        $validator = Validator::make($dadosValidacao, [
            ...$this->getValidationSchema(), 
            'id_usuario' => [
                Rule::unique(Demanda::class, 'id_usuario')
                    ->where('titulo', $request->input('titulo'))
            ]
        ], $this->messageValidation());

        return $validator;

    }

    public function validarCamposDemandaUpdate(Request $request, $demandaId)
    {
        $idUsuarioLogado = auth()->id();

        $dadosValidacao = array_merge($request->all(), ['id_usuario' => $idUsuarioLogado]);

        $validator = Validator::make($dadosValidacao, [
            ...$this->getValidationSchema(), 
            'id_usuario' => [
                Rule::unique(Demanda::class, 'id_usuario')
                    ->where('titulo', $request->input('titulo'))
                    ->ignore($demandaId, 'id_demanda')
            ]
        ], $this->messageValidation());

        return $validator;
            
    }

    public function delete($id_demanda) 
    {
            
        $demanda = $this->demandaModel->findOrFail($id_demanda);
        $demanda->delete();

        return response()->json([
            'message' => 'Demanda deleted successfully'
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'id_usuario.unique' => 'Esse título já está em uso em suas demandas. Por favor, escolha outro.',
            'id_usuario.exists' => 'Esse usuário não existe no banco de dados.',
            'id_usuario.required' => 'O campo ID do usuário é obrigatório.',
            'id_publico_alvo.required' => 'O campo ID do público-alvo é obrigatório.',
            'id_publico_alvo.exists' => 'O ID do público-alvo fornecido é inválido.',
            'id_area_conhecimento.required' => 'O campo ID da área de conhecimento é obrigatório.',
            'id_area_conhecimento.exists' => 'O ID da área de conhecimento fornecido é inválido.',
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser um texto.',
            'titulo.max' => 'O campo título ultrapassou o numero de caracteres.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser um texto.',
            'descricao.max' => 'O campo descricao ultrapassou o numero de caracteres.',
            'pessoas_afetadas.required' => 'O campo pessoas atingidas é obrigatório.',
            'pessoas_afetadas.integer' => 'O campo pessoas atingidas deve ser um número inteiro.',
            'pessoas_afetadas.min' => 'O campo pessoas atingidas deve ser no mínimo 1.',
            'duracao.required' => 'O valor selecionado para a duração é Obrigatório.',
            'duracao' => 'O valor selecionado para a duração é inválido.',
            'nivel_prioridade.required' => 'O valor selecionado para o nível de prioridade é Obrigatório.',
            'nivel_prioridade' => 'O valor selecionado para o nível de prioridade é inválido.',
            'instituicao_setor.string' => 'O campo instituição/setor deve ser um texto.',
            'instituicao_setor.max' => 'O campo instituição/setor ultrapassou o número de caracteres.'
        ];
    }



    
}
