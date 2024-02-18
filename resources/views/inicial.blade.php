<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/inicial.css') }}">
    <title>UFSC_Extensao</title>
</head>
<body>
    <h1>Bem vindo ao Sistema</h1>
    <div class="selecao">
        <h2>Selecione como deseja acessar o sistema</h2>
        <a href="{{ route('login_index') }}" class="botao">
            <button>Membro da Sociedade</button>
        </a>
        <a href="{{ route('login_aluno') }}" class="botao">
            <button>Alunos</button>
        </a>
        <a href="{{ route('login_professor') }}" class="botao">
            <button>Professores</button>
        </a>
    </div>
</body>
</html>