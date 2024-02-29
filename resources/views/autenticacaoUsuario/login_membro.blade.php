<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/autenticacao_usuario/login_membro.css')}}">
    <title>Login-Membro</title>
</head>
<header>
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav>
</header>
<body>
    <div class="login-container">
        <form method="POST" action="{{ route('login_store') }}">
            @csrf
            @if (session()->has('success'))
                <div class="alert alert-success" style="text-align: center">
                    <p>{{session('success')}}</p>
                </div>
            @endif
            <h1>Login Membro</h1>
            <label for="email">Login</label>
            <input class="is-invalid" type="text" id="email" name="email" placeholder="Login" value={{ old('email')}}>
            @error('email')
                <div id="error-message-email" class="msg-erro fade-effect-error">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            @error('message')
            <div id="error-message-email" class="msg-erro fade-effect-error">
                <p>{{ $message }}</p>
            </div>
            @enderror
            <label for="password">Senha</label>
            <input type="password" id="password" name="password" placeholder="Senha">
            @error('password')
                <div id="error-message-password" class="msg-erro fade-effect-error">
                    <p>{{ $message }}</p>
                </div>
            @enderror
            @error('message')
            <div id="error-message-email" class="msg-erro fade-effect-error">
                <p>{{ $message }}</p>
            </div>
            @enderror
            <span><a href="{{ route('reset_index') }}">Recuperar a Senha</a></span><br>
            <button type="submit" >Entrar</button>
            <span><a href="{{ route('cadastro_index') }}">Ainda não possui conta? Cadastre-se</a></span><br>
        </form>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    </div>
</body>
</html>