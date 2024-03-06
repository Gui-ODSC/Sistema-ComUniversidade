<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/perfil/perfil_membro.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Perfil</title>
</head>
<body> 
    @include('menu')
    <main class="perfil" id="conteudo">
        <form action="#">
            <button>Editar</button>
            <div id="container">
                <img src="{{ asset('img/foto_usuario_perfil/perfil_foto.jpeg') }}" alt="foto perfil" id="imagem">
                <input type="file" id="arquivo" accept=".jpg, .jpeg, .png" onchange="mostrarImagem()">
            </div>
            <h1>Perfil</h1>
            <div class="cadastro-container">
                <input type="text" id="nome" name="nome" value="Guilherme" required>
                <input type="text" id="nascimento" name="nascimento" value="15/03/2003" required>
                <input type="text" id="sobrenome" name="sobrenome" value="Oliveira de Sá Cabrera" required>
                <input type="email" id="email" name="email" value="gui@gmail.com" required>
                <input type="password" id="senha" name="senha" value="***********" required>
                <input type="tel" id="telefone" name="telefone" pattern="[0-9]{10}" value="(11) 94363-4828" required>
                <input type="text" id="cidade" name="cidade" value="Araranguá" required>
                <input type="text" id="rua" name="rua" value="Violetas" required>
                <input type="number" id="numero_endereco" name="numero_endereco" value="2087" required>
                <input type="text" id="complemento" name="complemento" value="Complemento">
                <input type="text" id="estado" name="estado" value="SC" required>
            </div>
        <form>
    </main>
</body>
</html>