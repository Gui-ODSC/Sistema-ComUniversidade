//ABRE E FECHA O MODAL
function openModalContatarOferta(id) {
    // Exibe o modal e a sobreposição
    document.getElementById(`modal-contatar-${id}`).style.display = 'block';
    document.getElementById(`clicar-fora-modal-contatar-${id}`).style.display = 'block';
}

function closeModalContatarOferta(id) {
    // Oculta o modal e a sobreposição
    document.getElementById(`modal-contatar-${id}`).style.display = 'none';
    document.getElementById(`clicar-fora-modal-contatar-${id}`).style.display = 'none';
}