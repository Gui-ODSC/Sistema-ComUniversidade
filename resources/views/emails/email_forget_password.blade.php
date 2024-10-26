<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/emails/email_forget_password.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="container">
        <h1>Redefinição de Senha</h1>
        <div class="content">
            <p>Olá,</p>
            <p>Você está recebendo este e-mail porque uma solicitação de redefinição de senha foi recebida para sua conta. Se você não solicitou isso, ignore este e-mail.</p>
            <p>Para redefinir sua senha, clique no botão abaixo:</p>
            <p><a href="{{ route('reset_password', $token) }}" class="button">Redefinir Senha</a></p>
            <p>Se você não solicitou uma redefinição de senha, nenhuma ação adicional é necessária.</p>
            <p>Obrigado,<br/>Equipe de Suporte</p>
        </div>
    </div>
</body>
</html>

