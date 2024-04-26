<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/sair/sair_estudante.css') }}">
    <title>Sair</title>
</head>
<body>
<div class="sair">
        <h1>Deseja mesmo Sair?</h1>
        <a href="{{ route('login_estudante_destroy') }}"><button>SIM</button></a>
        <a href="{{ route('lista_todas_ofertas_estudante') }}"><button>NÃO</button></a>
    </div>
</body>
</html>