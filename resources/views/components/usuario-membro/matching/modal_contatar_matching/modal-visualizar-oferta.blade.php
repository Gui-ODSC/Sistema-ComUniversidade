<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_contatar/modal_visualizar_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_contatar_oferta.js') }}"></script>
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
                        <h2>{{$professor->nome}}</h2>
                        <hr>
                        <h6>Cargo: {{(ucwords(strtolower($professor->tipo)))}}</h6>
                        @if ($professor->instituicao)
                            <h6>Instituição: {{$professor->instituicao}}</h6>
                        @else 
                            <h6>Intituição: Não cadastrada</h6>
                        @endif
                        @if ($oferta->tipo === 'ACAO')
                            <h6>Tipo Oferta: Ação</h6>
                        @elseif ($oferta->tipo === 'CONHECIMENTO')
                            <h6>Tipo Oferta: Conhecimento</h6>
                        @endif
                    </div>
                    <div class="informacao-email">
                        <h4>Contatos Email</h4>
                        <h6>{{$professor->email}}</h6>
                        <h6>{{$professor->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta">
                    <div id="titulo-oferta">
                        <h2>Título: {{$oferta->titulo}}</h2>
                    </div>
                    <div class="informacao-oferta-coluna">
                        <div>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Público Alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</h6>
                                @if ($oferta->ofertaAcao->status_registro === 'REGISTRADA')
                                    <h6>Status da Oferta: Registrada</h6>
                                @elseif ($oferta->ofertaAcao->status_registro === 'NAO_REGISTRADA')
                                    <h6>Status da Oferta: Não Registrada</h6>
                                @endif
                            @endif
                            @if ($oferta->tipo == 'CONHECIMENTO')
                                <h6>Currículo Lattes: <a href="{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></h6>
                                <h6>Currículo Linkedin: <a href="{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></h6>
                            @endif
                            <h6>Área de Conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
                        </div>
                        <div>
                            <h6 id="data">Ofertado em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h6>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Duração: {{ucwords(strtolower($oferta->ofertaAcao->duracao))}}</h6>
                                <h6>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</h6>
                            @endif
                            @if ($oferta->tipo == 'CONHECIMENTO')
                                @if ($oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO')
                                    <h6>Tempo de Atuação: Menos de 1 Ano</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                                    <h6>Tempo de Atuação: Mais de 1 Ano</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                                    <h6>Tempo de Atuação: Mais de 3 Anos</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                                    <h6>Tempo de Atuação: Mais de 5 Anos</h6>
                                @endif
                            @endif
                        </div>
                        <div>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Tipo Ação: {{$oferta->ofertaAcao->tipoAcao->nome}}</h6> 
                                @if ($oferta->ofertaAcao->data_limite)
                                    <h6>Data Limite: {{ \Carbon\Carbon::parse($oferta->ofertaAcao->data_limite)->format('d/m/Y') }}</h6>
                                @else
                                    <h6>Data Limite: Indefinida</h6>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="descricao-oferta">
                <h6>Descricao Oferta:</h6>
                <p>{{$oferta->descricao}}</p>
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
                    <form action="{{ route('matching_visualizar', [$idDemanda, $idMatching]) }}" method="GET">
                        @csrf
                        <span onclick="closeModalVisualizarOferta({{$idMatching}})" id="botao-fechar-modal"><button>Fechar</button></span>
                    </form>
                </div>
            </div>
            <x-usuario-membro.matching.modal-contatar-oferta :id-matching="$idMatching" :id-demanda="$idDemanda"/>
        </div>
    </div>
</body>
</html>