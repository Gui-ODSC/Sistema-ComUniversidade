function openModalVisualizarOferta(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-visualizar-${id}`).style.display = 'block';
}

function closeModalVisualizarOferta(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-visualizar-${id}`).style.display = 'none';
}