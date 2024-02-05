function openModalContatoRespondido() {
    // Exibe o modal e a sobreposição

    closeModalConfirmaInteresse();
    closeModalConfirmaDesinteresse();
    closeModalVisualizarContatoRecebido();

    document.getElementById('modal-contato-respondido').style.display = 'block';
    document.getElementById('clicar-fora-contato-respondido').style.display = 'block';
}

function closeModalContatoRespondido() {
    // Oculta o modal e a sobreposição

    openModalConfirmaInteresse();
    openModalConfirmaDesinteresse();
    openModalVisualizarContatoRecebido();

    document.getElementById('modal-contato-respondido').style.display = 'none';
    document.getElementById('clicar-fora-contato-respondido').style.display = 'none';
}

function confirmarResposta() {

    var formPaginaAnterior = document.getElementById('form-contato');

    formPaginaAnterior.submit();
    
}

