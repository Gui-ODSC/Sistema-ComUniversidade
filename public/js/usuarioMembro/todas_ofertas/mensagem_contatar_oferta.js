var envioAutomaticoAgendado = false; // Variável para controlar o envio automático

function validarEnviarFormulario() {
    var mensagemContato = document.getElementById('mensagem-contato').value.trim();

    if (mensagemContato === '') {
        alert('Por favor, preencha a descrição da oferta antes de enviar.');
        return false; // Impede o envio do formulário
    }

    // Mostrar o modal de sucesso
    mostrarModalSucesso();

    // Agendar o envio real do formulário após um breve intervalo (para dar tempo ao usuário de ver o modal)
    setTimeout(function() {
        if (!envioAutomaticoAgendado) {
            document.getElementById('form-contato').submit();
        }
    }, 10000); // Tempo em milissegundos (aqui definido como 10 segundos para ilustração)

    return false; // Impede o envio do formulário imediatamente
}

function mostrarModalSucesso() {
    // Mostra o modal de sucesso
    var modal = document.getElementById('modal-sucesso');
    modal.style.display = 'block';
}

function fecharModalSucesso() {
    // Fecha o modal de sucesso
    var modal = document.getElementById('modal-sucesso');
    modal.style.display = 'none';

    // Atualiza a variável para indicar que o envio automático foi cancelado
    envioAutomaticoAgendado = true;

    // Envia o formulário imediatamente
    document.getElementById('form-contato').submit();
}
