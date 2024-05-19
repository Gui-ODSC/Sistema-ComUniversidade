function abrirMenu() {
    event.preventDefault(); // Impede o comportamento padrão do link
    document.getElementById('menu_navegacao').style.width = '310px';
}

function fecharMenu() {
    event.preventDefault(); // Impede o comportamento padrão do link
    document.getElementById('menu_navegacao').style.width = '0px';
}