function openModalVisualizarContatoRealizado(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-visualizar-contato-realizado-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-visualizar-contato-realizado-${id}`).style.display = 'block';
}

function closeModalVisualizarContatoRealizado(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-visualizar-contato-realizado-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-visualizar-contato-realizado-${id}`).style.display = 'none';
}


