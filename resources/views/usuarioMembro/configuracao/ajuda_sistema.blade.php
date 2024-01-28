<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/configuracao/ajuda_sistema.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('menu')
    <main class="ajuda-sistema" id="conteudo">
        <h1>Ajuda do Sistema</h1>
        <div class="sessao">
            <h4>Como o Sistema está estruturado?</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.</p>
        </div>
        <hr>
        <div class="sessao">
            <h4>Posso confiar quanto a segurança dos dados?</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.</p>
        </div>
        <hr>
        <div class="sessao">
            <h4>Quero cadastrar uma demanda como faço?</h4>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.Lorem ipsum dolor sit amet consectetur adipisicing elit. Et est impedit non ad cum repellendus. Neque, ex reiciendis? Illum quo incidunt voluptate in nesciunt deserunt pariatur facilis molestias porro nam.</p>
        </div>
    </main>
</body>
</html>