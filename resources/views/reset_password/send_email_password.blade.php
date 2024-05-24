<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/reset_password/send_email_password.css')}}">
    <title>Redefinir Senha</title>
</head>
{{-- <header>
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav>
</header> --}}
<body>
    <div class="login-container">
        <form method="POST" action="{{ route('send_email_password') }}">
            @csrf
            <h1>Redefinir Senha</h1>
            <p>Enviaremos um link para seu email, use o link para redefinir a senha</p>
            @if (session()->has('success'))
                <div class="alert alert-success">
                    {{ session('success')}}
                </div>
            @elseif (session()->has('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif
            @if (session()->has('token'))
                <div class="alert alert-warning">
                    {{ session('token') }}
                </div>
            @endif
            <label for="email">Email</label>
            
            @error('email')
                <input title="{{$message}}" type="email" id="email" name="email" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Email" required>
                <div class="msg-erro fade-effect-error">
                    <p>{{ $message }}</p>
                </div>
            @else
                <input type="email" id="email" name="email" placeholder="Email" required>
            @enderror
            <button type="submit">Enviar</button>
        </form>
    </div>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    <script src="{{ asset('js/reset_password/send_email_password.js') }}"></script>
</body>
</html>
