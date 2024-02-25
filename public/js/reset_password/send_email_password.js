// Selecionar o campo de entrada de e-mail
var emailInput = document.getElementById('email');

// Adicionar um ouvinte de evento de digitação ao campo de entrada de e-mail
emailInput.addEventListener('input', function() {
    emailInput.style.border = '';
    emailInput.style.backgroundColor = '';
});