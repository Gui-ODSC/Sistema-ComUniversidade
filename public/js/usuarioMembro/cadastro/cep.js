const baseUrl = `${window.location.origin}/web/membro/api/cep/`;

function buscaCep() {
    let cep = document.getElementById('cep').value;
    if (cep !== "") {
        cep = cep.replace('-', '');
        let url = baseUrl + cep;

        let req = new XMLHttpRequest();
        req.open("GET", url);

        req.send();

        /* Tratamento de resposta da requisição */
        req.onload = function() {
            if (req.status === 200) {
                let endereco = JSON.parse(req.response);
                document.getElementById('logradouro').value = endereco.data.logradouro;
                document.getElementById('cidade').value = endereco.data.cidade;
                document.getElementById('bairro').value = endereco.data.bairro;
                document.getElementById('estado').value = endereco.data.estado + ' - ' + endereco.data.uf;
            } else if (req.status === 404) {
                alert('CEP inválido');
                // Limpa o campo do CEP se for inválido
                document.getElementById('cep').value = "";
            } else {
                alert('Erro ao buscar o CEP.');
                // Limpa o campo do CEP se ocorrer um erro genérico
                document.getElementById('cep').value = "";
            }
        }

        req.onerror = function() {
            alert('Erro de rede');
        }
    }
}

window.onload = function() {
    let cep = document.getElementById('cep');
    cep.addEventListener('blur', buscaCep);

    // Adiciona um ouvinte para o evento de envio do formulário
    document.getElementById('seu-formulario-id').addEventListener('submit', function(event) {
        // Verifica se o campo do CEP está vazio ou se o valor é inválido
        if (document.getElementById('cep').value === "") {
            alert('Por favor, insira um CEP');
            event.preventDefault(); // Impede o envio do formulário
        }
    });
}
