<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/sair/sair_professor.css') }}">
    <title>Sair</title>
</head>
<body>
<div class="sair">
        <h1>Deseja mesmo Sair?</h1>
        <a href="{{ route('login_professor_destroy') }}"><button>SIM</button></a>
        <a href="{{ route('oferta_index') }}"><button>NÃO</button></a>
    </div>
</body>
</html>