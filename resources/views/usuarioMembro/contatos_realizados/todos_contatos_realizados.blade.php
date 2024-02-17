<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_realizados/todos_contatos_realizados.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_realizados/modal_visualizar_contato_check.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/contatos_realizados/modal_visualizar_contato_realizado.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body> 
    @include('menu')
    <main class="todos-contatos" id="conteudo">
        <h1>Contatos Realizados</h1>
        <div class="secao-contatos">
            <div class="contato" id="oferta-requisitada">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Arnaldo Silveira</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div class="barra-titulo">
                        <div id="barra-separadora">
                            <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                        </div>
                        <div id="info-contato-realizado">
                            <h4>Interesse em Conhecimento</h4>
                            <h5>Data: 03/01/2024</h5>
                        </div>
                    </div>
                    <div id="icones-contato">
                        <img id="imagem-status-contato-realizado" src="{{ asset('img/usuarioMembro/contatos_realizados/status_realizado.png') }}" alt="icone email">
                        <a onclick="openModalVisualizarContatoRealizado()"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos_realizados/visualizar_contato.png') }}" alt="icone mais info"></a>
                    </div>
                </div>
            </div>
            <div class="contato" id="demanda-atendida">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Roberta Andrade</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div class="barra-titulo">
                        <div id="barra-separadora">
                            <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                        </div>
                        <div id="info-contato-realizado">
                            <h4>Interesse em Oferta</h4>
                            <h5>Data: 22/12/2023</h5>
                        </div>
                    </div>
                    <div id="icones-contato">
                        <img id="imagem-status-contato-realizado" src="{{ asset('img/usuarioMembro/contatos_realizados/status_realizado.png') }}" alt="icone email">
                        <a onclick="openModalVisualizarContatoRealizado()"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos_realizados/visualizar_contato.png') }}" alt="icone mais info"></a>
                    </div>
                </div>
            </div>
            <div class="contato" id="oferta-requisitada">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Arnaldo Silveira</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div class="barra-titulo">
                        <div id="barra-separadora">
                            <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                        </div>
                        <div id="info-contato-realizado">
                            <h4>Interesse em Conhecimento</h4>
                            <h5>Data: 20/12/2023</h5>
                        </div>
                    </div>    
                    <div id="icones-contato">
                        <img id="imagem-status-contato-check" src="{{ asset('img/usuarioMembro/contatos_realizados/status_check.png') }}" alt="icone email">
                        <a onclick="openModalVisualizarContatoRealizadoCheck()"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos_realizados/visualizar_contato.png') }}" alt="icone mais info"></a>
                    </div>
                </div>
            </div>
            <div class="contato" id="demanda-atendida">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Jânia Pereira</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div class="barra-titulo">
                        <div id="barra-separadora">
                            <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                        </div>
                        <div id="info-contato-realizado">
                            <h4>Interesse em Oferta</h4>
                            <h5>Data: 10/06/2023</h5>
                        </div>
                    </div>
                    <div id="icones-contato">
                        <img id="imagem-status-contato-realizado" src="{{ asset('img/usuarioMembro/contatos_realizados/status_realizado.png') }}" alt="icone email">
                        <a onclick="openModalVisualizarContatoRealizado()"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos_realizados/visualizar_contato.png') }}" alt="icone mais info"></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- MODAL VISUALIZAR CONTATO RECEBIDO -->
        @include('usuarioMembro/contatos_realizados/modal_visualizar_contato_check')
        <!-- MODAL VISUALIZAR CONTATO RECEBIDO -->
        <!-- MODAL VISUALIZAR CONTATO RECEBIDO -->
        @include('usuarioMembro/contatos_realizados/modal_visualizar_contato_realizado')
        <!-- MODAL VISUALIZAR CONTATO RECEBIDO -->
    </main>
</body>
</html>