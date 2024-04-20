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
    <div class="clicar-fora-modal-visualizar" id="clicar-fora-modal-visualizar-{{$idDemanda}}" onclick="closeModalVisualizarOferta({{$idDemanda}})"></div>
        <div class="modal-visualizar" id="modal-visualizar-{{$idDemanda}}">
            <div class="dados-oferta">
                <div class="dados-usuario-professor">
                    <div class="informacao-professor">
                        <h2>{{$usuarioMembro->nome}}</h2>
                        <hr>
                        <h6>Tipo de Usuário: {{(ucwords(strtolower($usuarioMembro->tipo)))}}</h6>
                        <h6>Instituição: </h6>
                    </div>
                    <div class="informacao-email">
                        <h4>Contatos Email</h4>
                        <h6>{{$usuarioMembro->email}}</h6>
                        <h6>{{$usuarioMembro->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta">
                    <div id="titulo-oferta">
                        <h2>Título: {{$demanda->titulo}}</h2>
                    </div>
                    <div class="informacao-oferta-coluna">
                        <div>
                            <h6>Tipo: Demanda</h6>
                            <h6>Pessoas Afetadas: Aprox. {{$demanda->pessoas_afetadas}}</h6>
                            <h6>Duração: {{ucwords(strtolower($demanda->duracao))}}</h6>
                        </div>
                        <div>
                            <h6>Área Conhecimento: {{$demanda->areaConhecimento->nome}}</h6>
                            <h6>Público Alvo: {{$demanda->publicoAlvo->nome}}</h6>
                            <h6>Nivel Prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</h6>
                        </div>
                        <div>
                            <h6>Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h6>
                            <h6>Instituição: {{$demanda->instituicao_setor ?? '' }}</h6>
                        </div>
                    </div>
                </div>
            </div>
            <div class="descricao-oferta">
                <h6>Descricao Demanda:</h6>
                <p>{{$demanda->descricao}}</p>
            </div>
            <div class="botoes-oferta">
                <div>
                    <a onclick="openModalContatarOferta({{$idDemanda}})">
                        <button>Contatar
                            <img id="icone-telefone" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/telefone_contato.png') }}" alt="">
                        </button>
                    </a>
                </div>
                <form action="{{ route('contato_direto_visualizar_professor', [$idDemanda]) }}" method="POST">
                    @csrf
                    <span onclick="closeModalVisualizarOferta({{$idDemanda}})" id="botao-fechar-modal"><button>Fechar</button></span>
                </form>
                <x-usuario-professor.todas-demandas.modal-contatar-demanda :id-demanda="$demanda->id_demanda" />
            </div>
        </div>
    </div>
</body>
</html>