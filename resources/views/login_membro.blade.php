<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/login_membro.css')}}">
    <title>Login-Membro</title>
</head>
<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="inicial">Extensão Universitaria</a></span>
        </div>
    </nav>
</header>
<body>
    <div class="login-container">
        <h1>Login Membro</h1>
        <label for="login">Login</label>
        <input type="text" id="senha" placeholder="Login">
        <label for="senha">Senha</label>
        <input type="text" id="senha" placeholder="Senha">
        <span><a href="">Recuperar a Senha</a></span><br>
        <button>Entrar</button>
        <span><a href="">Ainda não possui conta? Cadastre-se</a></span><br>
    </div>
</body>
</html>