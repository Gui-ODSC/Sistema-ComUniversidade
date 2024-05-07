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
            'titulo' => 'required|string|max:150',
            'descricao' => 'required|string',
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

    public function validarCamposOfertaCreate(Request $request)
    {
        $idUsuarioLogado = auth()->id();
        $usuarioProfessor = UsuarioProfessor::where('id_usuario', $idUsuarioLogado)->firstOrFail();

        $dadosValidacao = array_merge($request->all(), ['id_usuario_professor' => $usuarioProfessor->id_usuario_professor]);

        $validator = Validator::make($dadosValidacao, [
            ...$this->getValidationSchema(),
            'id_usuario_professor' => [
                Rule::unique(Oferta::class, 'id_usuario_professor')
                    ->where('titulo', $request->input('titulo'))
            ]
        ], $this->messageValidation());

        return $validator;

    }

    public function validarCamposOfertaUpdate(Request $request, $ofertaId)
    {
        $idUsuarioLogado = auth()->id();
        $usuarioProfessor = UsuarioProfessor::where('id_usuario', $idUsuarioLogado)->firstOrFail();

        $dadosValidacao = array_merge($request->all(), ['id_usuario_professor' => $usuarioProfessor->id_usuario_professor]);

        $validator = Validator::make($dadosValidacao, [
            ...$this->getValidationSchema(),
            'id_usuario_professor' => [
                Rule::unique(Oferta::class, 'id_usuario_professor')
                    ->where('titulo', $request->input('titulo'))
                    ->ignore($ofertaId, 'id_oferta')
            ]
        ], $this->messageValidation());

        return $validator;

    }

    public function delete($id_oferta) 
    {
            
        $oferta = $this->ofertaModel->findOrFail($id_oferta);
        $oferta->delete();

        return response()->json([
            'message' => 'Oferta deleted successfully'
        ])->setStatusCode(200);

    }

    protected function messageValidation()
    {
        return [
            'id_usuario_professor.unique' => 'Esse título já está em uso em suas ofertas. Por favor, escolha outro.',
            'id_usuario_professor.exists' => 'Esse usuário não existe no banco de dados.',
            'id_usuario_professor.required' => 'O campo ID do usuário é obrigatório.',
            'id_area_conhecimento.required' => 'O campo ID da área de conhecimento é obrigatório.',
            'id_area_conhecimento.exists' => 'O ID da área de conhecimento fornecido é inválido.',
            'titulo.required' => 'O campo título é obrigatório.',
            'titulo.string' => 'O campo título deve ser um texto.',
            'titulo.max' => 'O campo título ultrapassou o numero de caracteres.',
            'descricao.required' => 'O campo descrição é obrigatório.',
            'descricao.string' => 'O campo descrição deve ser um texto.',
            'tipo.required' => 'O valor selecionado para o Tipo Oferta é Obrigatório.',
            'tipo' => 'O valor selecionado para o Tipo Oferta é inválido.',
        ];
    }
}
