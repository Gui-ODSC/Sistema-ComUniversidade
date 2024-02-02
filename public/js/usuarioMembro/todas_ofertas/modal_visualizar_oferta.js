function openModalVisualizarOferta() {
    // Exibe o modal e a sobreposição
    document.getElementById('modal-visualizar').style.display = 'block';
    document.getElementById('clicar-fora-modal-visualizar').style.display = 'block';
}

function closeModalVisualizarOferta() {
    // Oculta o modal e a sobreposição
    document.getElementById('modal-visualizar').style.display = 'none';
    document.getElementById('clicar-fora-modal-visualizar').style.display = 'none';
}