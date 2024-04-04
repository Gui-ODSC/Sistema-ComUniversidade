function abrirMenu() {
    event.preventDefault(); // Impede o comportamento padrão do link
    document.getElementById('menu_navegacao').style.width = '320px';
    document.getElementById('conteudo').style.marginLeft = '320px';
}

function fecharMenu() {
    event.preventDefault(); // Impede o comportamento padrão do link
    document.getElementById('menu_navegacao').style.width = '0px';
    document.getElementById('conteudo').style.marginLeft = '0px';
}