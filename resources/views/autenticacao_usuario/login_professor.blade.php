<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/autenticacao_usuario/login_professor.css')}}">
    <title>Login-Professor</title>
</head>
<header>
    <nav class="navbar bg-dark">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav>
</header>
<body>
    <div class="login-container">
        <h1>Login Professor</h1>
        <label for="login">Login</label>
        <input type="text" id="password" placeholder="Login">
        <label for="password">Senha</label>
        <input type="password" id="password" placeholder="Senha">
        <span><a href="{{ route('recuperacao_senha') }}">Recuperar a Senha</a></span><br>
        <button>Entrar</button>
    </div>
</body>
</html>