<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/reset_password/new_password.css')}}">
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
    <div class="password-container">
        <form action="{{ route('new_password') }}" method="POST">
            @csrf
            <input type="hidden" name="token" value="{{$token}}">
            <h1>Recuperacao Senha</h1>
            <label for="new_password">Nova Senha</label>
            @error('password')
                <input title="{{$message}}" type="password" id="new_password" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Senha Nova" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');">
                <div class="msg-erro fade-effect-error">
                    <p>{{$message}}</p>
                </div>
            @else
                <input type="password" id="new_password" name="password" placeholder="Senha Nova" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');">
            @enderror
            <label for="confirma">Confirmar Senha</label>
            @error('password')
                <input title="{{$message}}" type="password" id="password_confirmation" name="password_confirmation" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Confirmar Senha" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');">
                <div class="msg-erro fade-effect-error">
                    <p>{{$message}}</p>
                </div>
            @else
                <input type="password" id="password_confirmation" name="password_confirmation" placeholder="Confirmar Senha" required autocomplete="new-password" readonly onfocus="this.removeAttribute('readonly');">
            @enderror
            <button type="submit">Login</button>
        <form>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
        <script src="{{ asset('js/reset_password/new_password.js') }}"></script>
    </div>
</body>
</html>