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
        <div class="modal-visualizar" id="modal-visualizar-{{$idMatching}}">
            <div class="dados-oferta">
                <div class="dados-usuario-professor">
                    <div class="informacao-professor">
                        <h2>{{$professor->nome}}</h2>
                        <hr>
                        <h6>Cargo: Professor</h6>
                        <h6>Instituição: </h6>
                        <h6>Tipo Oferta: {{ucwords(strtolower($oferta->tipo))}}</h6>
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
                                <h6>Status da Oferta: {{ucwords(strtolower($oferta->ofertaAcao->status_registro))}}</h6>
                            @endif
                            @if ($oferta->tipo == 'CONHECIMENTO')
                                <h6>Currículo Lattes: <a href="{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></h6>
                                <h6>Currículo Linkedin: <a href="{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></h6>
                            @endif
                            <h6>Área de Conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
                        </div>
                        <div>
                            <h6 id="data">Ofertado em: 22/12/2023</h6>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Duração: Anos</h6>
                                <h6>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</h6>
                            @endif
                            @if ($oferta->tipo == 'CONHECIMENTO')
                                <h6>Tempo de Atuação: {{$oferta->ofertaConhecimento->tempo_atuacao}}</h6>
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
                    <span onclick="closeModalVisualizarOferta({{$idMatching}})" id="botao-fechar-modal"><button>Fechar</button></span>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    {{-- <!-- MODAL CONTATAR -->
    @include('usuarioMembro/matching_demandas/modal_contatar/modal_contatar_oferta')
    <!-- MODAL CONTATAR --> --}}
</body>
</html>