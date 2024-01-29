<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_realizados/todos_contatos_realizados.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/modal/modal_padrao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body> 
    @include('menu')
    <main class="todos-contatos" id="conteudo">
        <h1>Contatos Realizados</h1>
        <div class="secao-contatos">
            <div class="contato" id="oferta-requisitada">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/foto_usuario_perfil/perfil_foto.jpeg') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Guilherme Oliveira</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div id="barra-separadora">
                        <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                    </div>
                    <div id="info-contato-realizado">
                        <h4>Oferta Requisitada</h4>
                        <h5>Data: 03/01/2024</h5>
                    </div>
                    <div id="icones-contato">
                        <a href=""><img src="{{ asset('img/icones/email.png') }}" alt="icone email" id="imagem-email"></a>
                        <a onclick="openModal()"><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
                    </div>
                </div>
            </div>
            <div class="contato" id="demanda-atendida">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/foto_usuario_perfil/perfil_garota.jpg') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Roberta Andrade</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div id="barra-separadora">
                        <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                    </div>
                    <div id="info-contato-realizado">
                        <h4>Demanda Atendida</h4>
                        <h5>Data: 22/12/2023</h5>
                    </div>
                    <div id="icones-contato">
                        <a href=""><img src="{{ asset('img/icones/email.png') }}" alt="icone email" id="imagem-email"></a>
                        <a href="#"><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
                    </div>
                </div>
            </div>
            <div class="contato" id="oferta-requisitada">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/foto_usuario_perfil/perfil_homem.jpg') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Arnaldo Silveira</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div id="barra-separadora">
                        <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                    </div>
                    <div id="info-contato-realizado">
                        <h4>Oferta Requisitada</h4>
                        <h5>Data: 20/12/2023</h5>
                    </div>
                    <div id="icones-contato">
                        <a href=""><img src="{{ asset('img/icones/email.png') }}" alt="icone email" id="imagem-email"></a>
                        <a href="#"><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
                    </div>
                </div>
            </div>
            <div class="contato" id="demanda-atendida">
                <div class="info-esquerda">
                    <div id="img-contato">
                        <img src="{{ asset('img/foto_usuario_perfil/perfil_mulher.jpg') }}" alt="foto perfil" id="imagem">
                    </div>
                    <div id="info-usuario-contato">
                        <h4>Jânia Pereira</h4>
                        <h5>status: Professor(a)</h5>
                    </div>
                </div>
                <div class="info-direita">
                    <div id="barra-separadora">
                        <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                    </div>
                    <div id="info-contato-realizado">
                        <h4>Demanda Atendida</h4>
                        <h5>Data: 10/06/2023</h5>
                    </div>
                    <div id="icones-contato">
                        <a href=""><img src="{{ asset('img/icones/email.png') }}" alt="icone email" id="imagem-email"></a>
                        <a href="#"><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
                    </div>
                </div>
            </div>
        </div>


        <!-- MODAL -->
            <div class="clicar-fora-modal" id="clicar-fora-modal" onclick="closeModal()"></div>
            <div class="caixa-modal" id="caixa-modal">
                @include('usuarioMembro/contatos_realizados/model_visualizar_contatos_realizados')
                <span onclick="closeModal()">Fechar [X]</span>
            </div>
        <!-- MODAL -->
    </main>
</body>
</html>