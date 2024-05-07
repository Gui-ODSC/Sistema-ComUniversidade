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
                <div style="position: relative;">
                    <input title="Nova senha" type="password" id="new_password" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206); margin-bottom: 5px; padding-right: 70px" placeholder="Senha Nova" required autocomplete="new-password">
                    <span id="toggle_new_password" onclick="toggleNewPassword('new_password', 'toggle_new_password')" style="position: absolute; top: 50%; left: 420px; transform: translateY(-50%); cursor: pointer;"><img src='{{ asset("img/usuarioMembro/cadastrar_demandas/olho_escuro_desmarcado.png")}}' alt="" style="width: 25px"></span>
                </div>
                <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; top: 48.5%; left: 870px; transform: translateY(-50%); cursor: pointer;">
                    <img src="{{ asset('img/cadastro_usuarios/icone_info_senha_escuro.png') }}" alt="Ícone informativo" style="width: 20px;">
                </span>
            @else
                <div style="position: relative;">
                    <input title="Nova senha" type="password" id="new_password" name="password" style="margin-bottom: 5px; padding-right: 70px" placeholder="Senha Nova" required autocomplete="new-password">
                    <span id="toggle_new_password" onclick="toggleNewPassword('new_password', 'toggle_new_password')" style="position: absolute; top: 50%; left: 420px; transform: translateY(-50%); cursor: pointer;"><img src='{{ asset("img/usuarioMembro/cadastrar_demandas/olho_escuro_desmarcado.png")}}' alt="" style="width: 25px"></span>
                </div>
                <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; top: 48.5%; left: 870px; transform: translateY(-50%); cursor: pointer;">
                    <img src="{{ asset('img/cadastro_usuarios/icone_info_senha_escuro.png') }}" alt="Ícone informativo" style="width: 20px;">
                </span>
            @enderror
            @error('password')
                <div class="msg-erro fade-effect-error">
                    <p>{{$message}}</p>
                </div>
            @enderror

            <label for="confirma">Confirmar Senha</label>
            @error('password')
                <div style="position: relative;">
                    <input title="Confirmar Senha" type="password" id="password_confirmation" name="password_confirmation" style="border: 1px solid red; background-color:rgb(235, 201, 206); margin-bottom: 5px; padding-right: 70px" placeholder="Confirmar Senha" required autocomplete="new-password">
                    <span id="toggle_password_confirmation" onclick="toggleConfirmPassword()" style="position: absolute; top: 50%; left: 420px; transform: translateY(-50%); cursor: pointer;"><img src='{{ asset("img/usuarioMembro/cadastrar_demandas/olho_escuro_desmarcado.png")}}' alt="" style="width: 25px"></span>
                </div>
                <span class="info-icon" onclick="showPasswordRules2()" style="position: absolute;top: 67.5%; left: 870px; transform: translateY(-50%); cursor: pointer;">
                    <img src="{{ asset('img/cadastro_usuarios/icone_info_senha_escuro.png') }}" alt="Ícone informativo" style="width: 20px;">
                </span>
            @else
                <div style="position: relative;">
                    <input title="Confirmar Senha" type="password" id="password_confirmation" name="password_confirmation" style="margin-bottom: 5px; padding-right: 70px" placeholder="Confirmar Senha" required autocomplete="new-password">
                    <span id="toggle_password_confirmation" onclick="toggleConfirmPassword()" style="position: absolute; top: 50%; left: 420px; transform: translateY(-50%); cursor: pointer;"><img src='{{ asset("img/usuarioMembro/cadastrar_demandas/olho_escuro_desmarcado.png")}}' alt="" style="width: 25px"></span>
                </div>
                <span class="info-icon" onclick="showPasswordRules2()" style="position: absolute;top: 63%; left: 870px; transform: translateY(-50%); cursor: pointer;">
                    <img src="{{ asset('img/cadastro_usuarios/icone_info_senha_escuro.png') }}" alt="Ícone informativo" style="width: 20px;">
                </span>
            @enderror
            @error('password')
                <div class="msg-erro fade-effect-error">
                    <p>{{$message}}</p>
                </div>
            @enderror
            <button type="submit">Login</button>
        </form>
    </div>

    <script>
        function toggleNewPassword() {
            var newPasswordField = document.getElementById('new_password');
            var toggleButton = document.getElementById('toggle_new_password');

            if (newPasswordField.type === "password") {
                newPasswordField.type = "text";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_escuro_marcado.png')}}" alt="" style="width: 25px">';
            } else {
                newPasswordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_escuro_desmarcado.png')}}" alt="" style="width: 25px">';
            }
        }

        function toggleConfirmPassword() {
            var confirmPasswordField = document.getElementById('password_confirmation');
            var toggleButton = document.getElementById('toggle_password_confirmation');

            if (confirmPasswordField.type === "password") {
                confirmPasswordField.type = "text";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_escuro_marcado.png')}}" alt="" style="width: 25px">';
            } else {
                confirmPasswordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_escuro_desmarcado.png')}}" alt="" style="width: 25px">';
            }
        }

        /* INFORMATIVO SENHA */
        function showPasswordRules() {
            // Caixa de diálogo das regras da senha
            var passwordRules = document.createElement("div");
            passwordRules.innerHTML = `
                <div id="password-rules" style="position: absolute; top: 100px; right: 20px; background-color: #4D6D7F; color: #FFF; border: 1px solid #FFF; padding: 10px; border-radius: 10px;">
                    <button onclick="closePasswordRules()" style="position: absolute; top: 5px; color: #FFF; right: 7px; cursor: pointer; background: transparent; border: none; outline: none;">Fechar</button>
                    <p>Regras de criação de senha:</p>
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

        /* INFORMATIVO SENHA */
        function showPasswordRules2() {
            // Caixa de diálogo das regras da senha
            var passwordRules = document.createElement("div");
            passwordRules.innerHTML = `
                <div id="password-rules" style="position: relative; top: 190px; right: 20px; background-color: #4D6D7F; color: #FFF; border: 1px solid #FFF; padding: 10px; border-radius: 10px;">
                    <button onclick="closePasswordRules2()" style="position: absolute; top: 5px; color: #FFF; right: 7px; cursor: pointer; background: transparent; border: none; outline: none;">Fechar</button>
                    <p>Regras de criação de senha:</p>
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

        function closePasswordRules2() {
            // Remove a caixa de diálogo das regras da senha
            var passwordRules = document.getElementById('password-rules');
            passwordRules.remove();
        }
    </script>
</body>
</html>
