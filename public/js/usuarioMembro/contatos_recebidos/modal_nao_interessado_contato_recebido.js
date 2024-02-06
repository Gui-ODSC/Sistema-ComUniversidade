//ABRE E FECHA O MODAL
function openModalConfirmaDesinteresse() {
    // Exibe o modal e a sobreposição

    closeModalVisualizarContatoRecebido();

    document.getElementById('modal-confirmar-desinteresse').style.display = 'block';
    document.getElementById('clicar-fora-confirmar-desinteresse').style.display = 'block';
}

function closeModalConfirmaDesinteresse() {
    // Oculta o modal e a sobreposição

    openModalVisualizarContatoRecebido();

    document.getElementById('modal-confirmar-desinteresse').style.display = 'none';
    document.getElementById('clicar-fora-confirmar-desinteresse').style.display = 'none';
}