<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/recuperacao_senha.css')}}">
    <title>Recuperacao Senha</title>
</head>
<header>
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav>
</header>
<body>
    <div class="recuperacao-senha-container">
        <form action="{{ route('login_membro') }}">
            <h1>Recuperacao Senha</h1>
            <label for="email">Email</label>
            <input type="text" id="password" placeholder="Email" required>
            <label for="senha_nova">Senha Nova</label>
            <input type="password" id="senha_nova" placeholder="Senha Nova" required>
            <label for="confirma">Confirmar Senha</label>
            <input type="password" id="confirma" placeholder="Confirmar Senha" required>
            <button>Login</button>
        <form>
    </div>
</body>
</html>