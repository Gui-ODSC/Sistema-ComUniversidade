function openModalVisualizarContatoRecebido(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.display = 'block';
}

function closeModalVisualizarContatoRecebido(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-visualizar-recebido-${id}`).style.display = 'none';
}