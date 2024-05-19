<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_visualizar_oferta.css') }}">
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_contatar_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-visualizar" id="clicar-fora-modal-visualizar-{{$idMatching}}" onclick="closeModalVisualizarOferta({{$idMatching}})"></div>
    </form>
        <div class="modal-visualizar" id="modal-visualizar-{{$idMatching}}">
            <div class="dados-oferta">
                <div class="dados-usuario-professor">
                    <div class="informacao-professor">
                        <h2>{{$usuarioMembro->nome}}</h2>
                        <hr>
                        @if ($usuarioMembro->tipo === 'MEMBRO')
                            <h6>Tipo de usuário: Membro externo</h6>
                        @elseif ($usuarioMembro->tipo === 'ALUNO')
                            <h6>Tipo de usuário: Estudante</h6>
                        @endif
                        <h6>Instituição: {{$usuarioMembro->instituicao ?? 'Não cadastrada'}}</h6>
                    </div>
                    <div class="informacao-email">
                        <h4>Contatos Email</h4>
                        <h6 title="{{$usuarioMembro->email}}">{{$usuarioMembro->email}}</h6>
                        <h6 title="{{$usuarioMembro->email_secundario}}">{{$usuarioMembro->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta">
                    <div class="titulo-oferta">
                        <h2>{{$demanda->titulo}}</h2>
                    </div>
                    <div class="informacao-oferta-coluna">
                        <div>
                            <h6>Tipo: Necessidade</h6>
                            <h6>Pessoas atingidas: aprox. {{$demanda->pessoas_afetadas}}</h6>
                            <h6>Duração: {{ucwords(strtolower($demanda->duracao))}}</h6>
                        </div>
                        <div>
                            <h6>Área conhecimento: {{$demanda->areaConhecimento->nome}}</h6>
                            <h6>Público alvo: {{$demanda->publicoAlvo->nome}}</h6>
                            <h6>Nivel prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</h6>
                        </div>
                        <div>
                            <h6 style="font-weight: bold">Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h6>
                            <h6>Instituição: {{$demanda->instituicao_setor ?? 'Não cadastrada' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="descricao-oferta">
                <h6>Descrição da necessidade:</h6>
                <p>{{$demanda->descricao}}</p>
            </div>
            <div class="botoes-oferta">
                <div>
                    <a onclick="openModalContatarOferta({{$idMatching}})">
                        <button>Contatar
                            <img id="icone-telefone" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/telefone_contato.png') }}" alt="">
                        </button>
                    </a>
                </div>
                <div>
                    <form action="{{ route('matching_visualizar_demanda', [$idMatching, $idOferta]) }}" method="GET">
                        @csrf
                        <span onclick="closeModalVisualizarOferta({{$idMatching}})" id="botao-fechar-modal"><button>Fechar</button></span>
                    </form>
                </div>
            </div>
            <x-usuario-professor.matching-acao.modal-contatar-demanda :id-matching="$idMatching" :id-oferta="$id_oferta"/>
        </div>
    </div>
</body>
</html>