<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/todas_ofertas/modal_visualizar_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/modal_contatar_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Todas ofertas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-visualizar" id="clicar-fora-modal-visualizar-{{$idOferta}}" onclick="closeModalVisualizarOferta({{$idOferta}})"></div>
        <div class="modal-visualizar" id="modal-visualizar-{{$idOferta}}">
            <div class="dados-oferta">
                <div class="dados-usuario-professor">
                    <div class="informacao-professor">
                        <h2>{{$professor->nome}}</h2>
                        <hr>
                        @if ($professor->tipo === 'PROFESSOR')
                            <h6>Tipo de usuário: Servidor(a)</h6>
                        @endif
                        @if ($professor->instituicao != null)
                            <h6>Instituição: {{$professor->instituicao}}</h6>
                        @else
                            <h6>Instituição: Não cadastrada</h6>
                        @endif
                    </div>
                    <div class="informacao-email">
                        <h4>Contatos Email</h4>
                        <h6>{{$professor->email}}</h6>
                        <h6>{{$professor->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta">
                    <div class="informacao-oferta">
                        <div class="titulo-oferta">
                            <h2>{{$oferta->titulo}}</h2>
                        </div>
                        <div class="informacao-oferta-coluna">
                            <div>
                                @if ($oferta->tipo == 'ACAO')
                                    <h6>Público alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</h6>
                                    @if ($oferta->ofertaAcao->status_registro === 'REGISTRADA')
                                        <h6>Status da oferta: Registrada</h6>
                                    @elseif ($oferta->ofertaAcao->status_registro === 'NAO_REGISTRADA')
                                        <h6>Status da oferta: Não registrada</h6>
                                    @endif
                                @endif
                                @if ($oferta->tipo == 'CONHECIMENTO')
                                    @if ($oferta->ofertaConhecimento->link_lattes != null)
                                        <h6 class="truncar-texto">Currículo lattes: <a href="{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></h6>
                                    @else
                                        <h6 class="truncar-texto">Currículo lattes: Link não adicionado</h6>
                                    @endif
                                    @if ($oferta->ofertaConhecimento->link_linkedin != null)
                                        <h6 class="truncar-texto">Currículo linkedin: <a href="{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></h6>
                                    @else
                                        <h6 class="truncar-texto">Currículo linkedin: Link não adicionado</h6>
                                    @endif
                                @endif
                                <h6>Área de conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
                            </div>
                            <div>
                                <h6 id="data">Ofertado em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h6>
                                @if ($oferta->tipo == 'ACAO')
                                    <h6>Duração: {{ucwords(strtolower($oferta->ofertaAcao->duracao))}}</h6>
                                    <h6>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</h6>
                                @endif
                                @if ($oferta->tipo == 'CONHECIMENTO')
                                    @if ($oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO')
                                        <h6>Tempo de experiência: Menos de 1 Ano</h6>
                                    @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                                        <h6>Tempo de experiência: Mais de 1 Ano</h6>
                                    @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                                        <h6>Tempo de experiência: Mais de 3 Anos</h6>
                                    @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                                        <h6>Tempo de experiência: Mais de 5 Anos</h6>
                                    @endif
                                @endif
                            </div>
                            <div>
                                @if ($oferta->tipo == 'ACAO')
                                    <h6>Tipo ação: {{$oferta->ofertaAcao->tipoAcao->nome}}</h6>
                                    @if ($oferta->ofertaAcao->data_limite)
                                        <h6><strong>Data limite: {{ \Carbon\Carbon::parse($oferta->ofertaAcao->data_limite)->format('d/m/Y') }}</strong></h6>
                                    @else
                                        <h6><strong>Data limite: Indefinida</strong></h6>
                                    @endif
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="descricao-oferta">
                <h6>Descricao oferta:</h6>
                <p>{{$oferta->descricao}}</p>
            </div>
            <div class="botoes-oferta">
                <div>
                    <a onclick="openModalContatarOferta({{$idOferta}})">
                        <button>Contatar
                            <img id="icone-telefone" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/telefone_contato.png') }}" alt="">
                        </button>
                    </a>
                </div>
                <form action="{{ route('contato_direto_visualizar', [$idOferta]) }}" method="POST">
                    @csrf
                    <span onclick="closeModalVisualizarOferta({{$idOferta}})" id="botao-fechar-modal"><button>Fechar</button></span>
                </form>
                <x-usuario-membro.todas-ofertas.modal-contatar-oferta :id-oferta="$oferta->id_oferta" />
            </div>
        </div>
    </div>
</body>
</html>