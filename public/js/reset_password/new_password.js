// Selecionar o campo de entrada de e-mail
var emailInputPassword = document.getElementById('new_password');
var emailInputConfirm = document.getElementById('password_confirmation');

// Adicionar um ouvinte de evento de digitação ao campo de entrada de e-mail
emailInputPassword.addEventListener('input', function() {
    emailInputPassword.style.border = '';
    emailInputPassword.style.backgroundColor = '';
});

emailInputConfirm.addEventListener('input', function() {
    emailInputConfirm.style.border = '';
    emailInputConfirm.style.backgroundColor = '';
});