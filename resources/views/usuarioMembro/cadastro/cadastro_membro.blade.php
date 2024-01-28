<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/cadastro/cadastro_membro.css') }}">
    <title>Cadastro de Membros</title>
</head>
<header>
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav>
</header>
<body>
    <div class="cadastro-container">
        <form action="{{ route('login_membro') }}">
            <h1>Cadastro Membro</h1>
            <h4>Seja bem vindo(a)</h2>
            <input type="text" id="nome" name="nome" placeholder="Nome" required>
            <input type="text" id="nascimento" name="nascimento" placeholder="Nascimento" required>
            <input type="text" id="sobrenome" name="sobrenome" placeholder="Sobrenome" required>
            <input type="email" id="email" name="email" placeholder="Email" required>
            <input type="password" id="senha" name="senha" placeholder="Senha" required>
            <input type="tel" id="telefone" name="telefone" pattern="[0-9]{10}" placeholder="Telefone" required>
            <input type="text" id="cidade" name="cidade" placeholder="Cidade" required>
            <input type="text" id="rua" name="rua" placeholder="Rua" required>
            <input type="number" id="numero_endereco" name="numero_endereco" placeholder="Numero" required>
            <input type="text" id="complemento" name="complemento" placeholder="Complemento">
            <input type="text" id="estado" name="estado" placeholder="Estado" required>
            <button>Cadastrar</button>
        <form>
    </div>
</body>
</html>