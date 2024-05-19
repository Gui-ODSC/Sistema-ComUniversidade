function openModalDeletar(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-deletar-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-deletar-${id}`).style.display = 'block';
}

function closeModalDeletar(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-deletar-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-deletar-${id}`).style.display = 'none';
}