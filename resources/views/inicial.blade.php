<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/inicial.css') }}">
    <title>UFSC_Extensao</title>
</head>
<body>
    <div class="botao-voltar">
        <a title="Voltar" onclick="goBack()" href="{{ route('home') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
    </div>
    <h1>Bem vindo ao Sistema</h1>
    <div class="selecao">
        <h2>Selecione como deseja acessar o sistema</h2>
        <a href="{{ route('login_membro_index') }}" class="botao">
            <button>Membro Externo</button>
        </a>
        <a href="{{ route('login_estudante_index') }}" class="botao">
            <button>Estudantes</button>
        </a>
        <a href="{{ route('login_professor_index') }}" class="botao">
            <button>Professores</button>
        </a>
    </div>
</body>
</html>