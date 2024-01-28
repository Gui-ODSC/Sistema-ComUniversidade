<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/sair/sair_membro.css') }}">
    <title>Sair</title>
</head>
<body>
<div class="sair">
        <h1>Deseja mesmo Sair?</h1>
        <a href="{{ route('inicial') }}"><button>SIM</button></a>
        <a href="{{ route('minhas_demandas') }}"><button>NÃO</button></a>
    </div>
</body>
</html>