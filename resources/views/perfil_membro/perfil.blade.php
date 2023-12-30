<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/perfil_membro/perfil.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Perfil</title>
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
    <main class="perfil" id="conteudo">
        <form action="{{ route('login_membro') }}">
            <button>Editar</button>
            <div id="container">
                <img src="{{ asset('img/perfil_foto.jpeg') }}" alt="foto perfil" id="imagem">
                <input type="file" id="arquivo" accept=".jpg, .jpeg, .png" onchange="mostrarImagem()">
            </div>
            <h1>Perfil</h1>
            <div class="cadastro-container">
                <input type="text" id="nome" name="nome" placeholder="Guilherme" required>
                <input type="text" id="nascimento" name="nascimento" placeholder="15/03/2003" required>
                <input type="text" id="sobrenome" name="sobrenome" placeholder="Oliveira de Sá Cabrera" required>
                <input type="email" id="email" name="email" placeholder="gui@gmail.com" required>
                <input type="password" id="senha" name="senha" placeholder="***********" required>
                <input type="tel" id="telefone" name="telefone" pattern="[0-9]{10}" placeholder="(11) 94363-4828" required>
                <input type="text" id="cidade" name="cidade" placeholder="Araranguá" required>
                <input type="text" id="rua" name="rua" placeholder="Violetas" required>
                <input type="number" id="numero_endereco" name="numero_endereco" placeholder="2087" required>
                <input type="text" id="complemento" name="complemento" placeholder="Complemento">
                <input type="text" id="estado" name="estado" placeholder="SC" required>
            </div>
        <form>
    </main>
</body>
</html>