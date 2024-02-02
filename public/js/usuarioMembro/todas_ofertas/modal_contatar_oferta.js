//ABRE E FECHA O MODAL
function openModalContatarOferta() {
    // Exibe o modal e a sobreposição
    document.getElementById('modal-contatar').style.display = 'block';
    document.getElementById('clicar-fora-modal-contatar').style.display = 'block';
}

function closeModalContatarOferta() {
    // Oculta o modal e a sobreposição
    document.getElementById('modal-contatar').style.display = 'none';
    document.getElementById('clicar-fora-modal-contatar').style.display = 'none';
}