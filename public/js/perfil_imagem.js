function mostrarImagem() {
    var arquivoInput = document.getElementById('arquivo');
    var imagem = document.getElementById('imagem');

    var arquivoSelecionado = arquivoInput.files[0];

    if (arquivoSelecionado) {
        var leitor = new FileReader();

        leitor.onload = function (e) {
            imagem.src = e.target.result;
        };

        leitor.readAsDataURL(arquivoSelecionado);
    }
}
