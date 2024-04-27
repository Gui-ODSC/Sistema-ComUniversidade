<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/configuracao/configuracoes.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="configuracoes" id="conteudo">
        <h1>Configurações</h1>
        <a href="{{ route('ajuda_sistema_professor') }}"><button>Ajuda do Sistema</button></a>
        <a href="{{ route('enviar_feedback_professor') }}"><button>Enviar Feedback</button></a>
        <a href="{{ route('sobre_nos_professor') }}"><button>Sobre nós</button></a>
    </main>
</body>
</html>