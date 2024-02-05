//ABRE E FECHA O MODAL
function openModalConfirmaInteresse() {
    // Exibe o modal e a sobreposição

    closeModalVisualizarContatoRecebido();

    document.getElementById('modal-confirmar-interesse').style.display = 'block';
    document.getElementById('clicar-fora-confirmar-interesse').style.display = 'block';
}

function closeModalConfirmaInteresse() {
    // Oculta o modal e a sobreposição
    
    openModalVisualizarContatoRecebido();

    document.getElementById('modal-confirmar-interesse').style.display = 'none';
    document.getElementById('clicar-fora-confirmar-interesse').style.display = 'none';
}

