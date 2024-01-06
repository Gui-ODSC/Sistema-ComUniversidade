<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/configuracao_membro/enviar_feedback.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    <header class="barra-navegacao">
        <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Abrir</a>
        <h1>Extensao Universitaria</h1>
        <a href="{{ route('perfil') }}"><img src="{{ asset('img/perfil.png') }}" alt="imagem de perfil do usuario"></a>
    </header>
    <nav class="menu-navegacao" id="menu_navegacao">
        <a href="#" onclick="fecharMenu()">&times; Fechar</a>
        <a href="{{ route('minhas_ofertas') }}">Minhas Ofertas</a>
        <a href="{{ route('minhas_demandas') }}">Minhas Demandas</a>
        <a href="{{ route('demandas_ofertas') }}">Ofertas/Demandas</a>
        <a href="{{ route('configuracoes') }}">Configurações</a>
        <a href="{{ route('perfil') }}">Perfil</a>
        <a href="{{ route('sair') }}">Sair</a>
    </nav>
    <main class="historico-demanda" id="conteudo">
        <div class="enviar-feedback">
            <h1>Enviar Feedback</h1>
            <hr>
            <div class="session-img">
                <a href="{{ route('perfil') }}"><img id='imagem-perfil' src="{{ asset('img/perfil_foto.jpeg') }}" alt="imagem de perfil do usuario"></a>
                <h5>Guilherme Oliveira</h5>
            </div>
            <hr>
            <form action="#">
                <label for="">Assunto</label>
                <br>
                <input type="text">
                <label for="">Feedback</label>
                <br>
                <textarea name="" id="" cols="10" rows="5"></textarea>
                <button>Enviar Feedback</button>
            </form>
        </div>
    </main>
</body>
</html>