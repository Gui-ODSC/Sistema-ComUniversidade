function validarEnviarFormularioConhecimento(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();

    if (mensagemContato === '') {
        alert('Por favor, preencha a descrição da oferta antes de enviar.');
        return false;
    }

    var botaoInteressado = document.getElementById(`botao-interessado-${id}`);
    var botaoSemDisponibilidade = document.getElementById(`botao-sem-disponibilidade-${id}`);

    botaoInteressado.addEventListener('click', function() {
        openModalConfirmaInteresse(id);
    });
    
    botaoSemDisponibilidade.addEventListener('click', function() {
        openModalConfirmaSemDisponibilidade(id);
    });

    return false; // Impede o envio do formulário imediatamente
}

function validarEnviarFormularioAcao(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();

    if (mensagemContato === '') {
        alert('Por favor, preencha a descrição da oferta antes de enviar.');
        return false;
    }

    var botaoContatoRespondido = document.getElementById(`botao-contato-respondido-${id}`);

    botaoContatoRespondido.addEventListener('click', function() {
        openModalConfirmaContatoRespondido(id);
    });

    return false;
}

function habilitarBotoesConhecimento(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();
    var botaoInteressado = document.getElementById(`botao-interessado-${id}`);
    var botaoNaoInteressado = document.getElementById(`botao-sem-disponibilidade-${id}`);
    var botaoContatoRespondido = document.getElementById(`botao-contato-respondido-${id}`);

    if (mensagemContato !== '') {
        botaoInteressado.removeAttribute('disabled');
        botaoNaoInteressado.removeAttribute('disabled');
        botaoContatoRespondido.removeAttribute('disabled');
    } else {
        botaoInteressado.setAttribute('disabled', 'true');
        botaoNaoInteressado.setAttribute('disabled', 'true');
        botaoContatoRespondido.setAttribute('disabled', 'true');
    }
}

function habilitarBotoesAcao(id) {
    var mensagemContato = document.getElementById(`mensagem-contato-${id}`).value.trim();
    var botaoContatoRespondido = document.getElementById(`botao-contato-respondido-${id}`);

    if (mensagemContato !== '') {
        botaoContatoRespondido.removeAttribute('disabled');
    } else {
        botaoContatoRespondido.setAttribute('disabled', 'true');
    }
}

/* ___________________________________________________________________________________________________________ */
/* MODAL INTERESSE */
function openModalConfirmaInteresse(id) {

    document.getElementById(`modal-confirmar-interesse-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-confirmar-interesse-${id}`).style.display = 'block';

    var botaoConfirmaEnvioInteresse = document.getElementById(`botao-confirma-envio-interesse-${id}`);

    botaoConfirmaEnvioInteresse.addEventListener('click', function() {
        form = document.getElementById(`form-contato-${id}`);
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'tipo_mensagem';
        inputHidden.value = 'INTERESSADO';
        form.appendChild(inputHidden);
        form.submit();
    });

}

function closeModalConfirmaInteresse(id) {
    // Oculta o modal e a sobreposição

    document.getElementById(`modal-confirmar-interesse-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-confirmar-interesse-${id}`).style.display = 'none';
}

/* ___________________________________________________________________________________________________________ */
/* MODAL SEM DISPONIBILIDADE */
function openModalConfirmaSemDisponibilidade(id) {

    document.getElementById(`modal-confirmar-sem-disponibilidade-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-confirmar-sem-disponibilidade-${id}`).style.display = 'block';

    var botaoConfirmaEnvioSemDisponibilidade = document.getElementById(`botao-confirma-envio-sem-disponibilidade-${id}`);

    botaoConfirmaEnvioSemDisponibilidade.addEventListener('click', function() {
        form = document.getElementById(`form-contato-${id}`);
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'tipo_mensagem';
        inputHidden.value = 'SEM_DISPONIBILIDADE';
        form.appendChild(inputHidden);
        form.submit();
    });
}

function closeModalConfirmaSemDisponibilidade(id) {
    // Oculta o modal e a sobreposição

    document.getElementById(`modal-confirmar-sem-disponibilidade-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-confirmar-sem-disponibilidade-${id}`).style.display = 'none';
}

/* ___________________________________________________________________________________________________________ */

/* MODAL CONTATO RESPONDIDO*/
function openModalConfirmaContatoRespondido(id) {

    document.getElementById(`modal-confirmar-contato-respondido-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-confirmar-contato-respondido-${id}`).style.display = 'block';

    var botaoConfirmaEnvioResposta = document.getElementById(`botao-confirma-envio-resposta-${id}`);

    botaoConfirmaEnvioResposta.addEventListener('click', function() {
        form = document.getElementById(`form-contato-${id}`);
        const inputHidden = document.createElement('input');
        inputHidden.type = 'hidden';
        inputHidden.name = 'tipo_mensagem';
        inputHidden.value = 'RESPONDIDA';
        form.appendChild(inputHidden);
        form.submit();
    });
}

function closeModalConfirmaContatoRespondido(id) {
    // Oculta o modal e a sobreposição

    document.getElementById(`modal-confirmar-contato-respondido-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-confirmar-contato-respondido-${id}`).style.display = 'none';
}

/* ___________________________________________________________________________________________________________ */


/* MODAL CONTATO RECEBIDO */
function openModalVisualizarContatoRecebido(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.display = 'block';

    
}

function closeModalVisualizarContatoRecebido(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.display = 'none';

}
