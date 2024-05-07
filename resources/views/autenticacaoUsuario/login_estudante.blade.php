<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/autenticacao_usuario/login_professor.css')}}">
    <title>Login Estudante</title>
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
        <form method="POST" action="{{ route('login_estudante_store') }}">
            @csrf
            @if (session()->has('success'))
                <div class="alert alert-success" style="text-align: center">
                    <p>{{session('success')}}</p>
                </div>
            @endif
            <h1>Login Estudante</h1>
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
                <div style="position: relative;">
                    <input type="password" id="password" name="password" placeholder="Senha" required oninput="toggleEye()">
                    <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 40%; left: 420px; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioEstudante/login/olho_desmarcado.png')}}" alt="" style="width: 20px"></span>
                    <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; top: 45%; right: 15px; transform: translateY(-50%); cursor: pointer;">
                        <img src="{{ asset('img/cadastro_usuarios/icone_info_senha_escuro.png') }}" alt="Ícone informativo" style="width: 20px;">
                    </span>
                </div>
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
            <span><a href="{{ route('cadastro_estudante_index') }}">Ainda não possui conta? Cadastre-se</a></span><br>
        </form>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
    </div>
    <script>
        /* OLINHO DA SENHA */
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioEstudante/login/olho_marcado.png')}}" alt="" style="width: 20px">';
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioEstudante/login/olho_desmarcado.png')}}" alt="" style="width: 20px">';
            }
        }

        // Verifica se há dados no campo de senha para exibir o ícone do olho
        function toggleEye() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");

            if (passwordField.value !== "") {
                toggleButton.style.display = "inline-block";
            } else {
                toggleButton.style.display = "none";
            }
        }

        /* INFORMATIVO SENHA */
        function showPasswordRules() {
            // Caixa de diálogo das regras da senha
            var passwordRules = document.createElement("div");
            passwordRules.innerHTML = `
                <div id="password-rules" style="position: absolute; top: 215px; right: 60px; background-color: #4D6D7F; color: #FFF; border: 1px solid #FFF; padding: 10px; border-radius: 10px;">
                    <button onclick="closePasswordRules()" style="position: absolute; top: 5px; color: #FFF; right: 7px; cursor: pointer; background: transparent; border: none; outline: none; width: 80px; padding-left: 15px;">Fechar</button>
                    <p>Regras de senha:</p>
                    <ul>
                        <li>Deve conter pelo menos 8 caracteres</li>
                        <li>Deve conter pelo menos uma letra maiúscula</li>
                        <li>Deve conter pelo menos uma letra minúscula</li>
                        <li>Deve conter pelo menos um número</li>
                    </ul>
                </div>
            `;

            // Adiciona a caixa de diálogo ao corpo do documento
            document.body.appendChild(passwordRules);

            // Remove a caixa de diálogo após 5 segundos
            setTimeout(function() {
                passwordRules.remove();
            }, 5000);
        }

        function closePasswordRules() {
            // Remove a caixa de diálogo das regras da senha
            var passwordRules = document.getElementById('password-rules');
            passwordRules.remove();
        }
    </script>
</body>
</html>