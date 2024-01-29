function openModalVisualizacao() {
    // Exibe o modal e a sobreposição
    document.getElementById('modal-visualizar').style.display = 'block';
    document.getElementById('clicar-fora-modal-visualizar').style.display = 'block';
}

function closeModalVisualizacao() {
    // Oculta o modal e a sobreposição
    document.getElementById('modal-visualizar').style.display = 'none';
    document.getElementById('clicar-fora-modal-visualizar').style.display = 'none';
}