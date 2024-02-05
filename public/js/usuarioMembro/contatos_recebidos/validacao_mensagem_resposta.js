function validarEnviarFormulario() {
    var mensagemContato = document.getElementById('mensagem-contato').value.trim();

    if (mensagemContato === '') {
        alert('Por favor, preencha a descrição da oferta antes de enviar.');
        return false;
    }

    return true; // Permite o envio imediato do formulário após a validação
}

function habilitarBotoes() {
    var mensagemContato = document.getElementById('mensagem-contato').value.trim();
    var botaoInteressado = document.getElementById('botao-interessado');
    var botaoNaoInteressado = document.getElementById('botao-nao-interessado');

    if (mensagemContato !== '') {
        botaoInteressado.removeAttribute('disabled');
        botaoNaoInteressado.removeAttribute('disabled');
    } else {
        botaoInteressado.setAttribute('disabled', 'true');
        botaoNaoInteressado.setAttribute('disabled', 'true');
    }
}
