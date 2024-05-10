function openModalAjudaOferta(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-ajuda-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-ajuda-${id}`).style.display = 'block';
}

function closeModalAjudaOferta(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-ajuda-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-ajuda-${id}`).style.display = 'none';
}