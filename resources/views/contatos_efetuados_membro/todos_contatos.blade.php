<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contatos_efetuados_membro/todos_contatos.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body> 
    <header class="barra-navegacao">
        <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Abrir</a>
        <h1>Extensao Universitaria</h1>
        <a href="{{ route('perfil') }}"><img src="{{ asset('img/icones/perfil.png') }}" alt="imagem de perfil do usuario"></a>
    </header>
    <nav class="menu-navegacao" id="menu_navegacao">
        <a href="#" onclick="fecharMenu()">&times; Fechar</a>
        <a href="{{ route('minhas_ofertas') }}">Minhas Ofertas</a>
        <a href="{{ route('minhas_demandas') }}">Minhas Demandas</a>
        <a href="{{ route('demandas_ofertas') }}">Ofertas/Demandas</a>
        <a href="{{ route('todos_contatos') }}">Contatos</a>
        <a href="{{ route('configuracoes') }}">Configurações</a>
        <a href="{{ route('perfil') }}">Perfil</a>
        <a href="{{ route('sair') }}">Sair</a>
    </nav>
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
                        <a href=""><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
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
                        <a href=""><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
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
                        <a href=""><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
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
                        <a href=""><img src="{{ asset('img/icones/icone_plus.png') }}" alt="icone mais info" id="imagem-plus"></a>
                    </div>
                </div>
            </div>
        </div>
    </main>
</body>
</html>