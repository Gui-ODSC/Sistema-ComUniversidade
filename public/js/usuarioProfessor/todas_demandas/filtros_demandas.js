function selecionarTipoOferta(tipo) {
    // Habilitar ou desabilitar dropdowns dependendo do tipo de oferta selecionada
    var textoEntreChaves = tipo.match(/\#(.*)/)[1];

// Atualizar o texto do botão com o texto entre as chaves
document.querySelector('.dropdown-toggle').innerText = textoEntreChaves;
        
        if (tipo === 'conhecimento') {
            document.getElementById('areaConhecimentoDropdown').disabled = false;
            document.getElementById('tempoAtuacaoDropdown').disabled = true;
            document.getElementById('statusRegistroDropdown').disabled = true;
        } else if (tipo === 'acao') {
            document.getElementById('areaConhecimentoDropdown').disabled = true;
            document.getElementById('tempoAtuacaoDropdown').disabled = false;
            document.getElementById('statusRegistroDropdown').disabled = false;
        }

        // Limpar e preencher opções dos dropdowns dinamicamente
        if (tipo === 'conhecimento') {
            // Preencher opções de área de conhecimento
            // Aqui você pode usar AJAX para buscar opções do backend e preencher o dropdown
        } else if (tipo === 'acao') {
            // Preencher opções de tempo de atuação e status de registro
            // Aqui você pode usar AJAX para buscar opções do backend e preencher os dropdowns
        }
    }