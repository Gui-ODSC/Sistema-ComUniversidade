function openModalDescricao(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-${id}`).style.display = 'block';
}

function closeModalDescricao(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-${id}`).style.display = 'none';
}