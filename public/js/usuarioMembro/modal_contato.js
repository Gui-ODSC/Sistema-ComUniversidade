function openModal() {
    // Exibe o modal e a sobreposição
    document.getElementById('caixa-modal').style.display = 'block';
    document.getElementById('clicar-fora-modal').style.display = 'block';
}

function closeModal() {
    // Oculta o modal e a sobreposição
    document.getElementById('caixa-modal').style.display = 'none';
    document.getElementById('clicar-fora-modal').style.display = 'none';
}