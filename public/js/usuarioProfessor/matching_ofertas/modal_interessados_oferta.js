function openModalUsuariosInteressados(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`caixa-modal-interessados-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-interessados-${id}`).style.display = 'block';
}

function closeModalUsuariosInteressados(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`caixa-modal-interessados-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-interessados-${id}`).style.display = 'none';
}