<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/modal_nao_interessado_contato_recebido.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_contato_respondido.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-confirmar-desinteresse" id="clicar-fora-confirmar-desinteresse"></div>
        <div class="modal-confirmar-desinteresse" id="modal-confirmar-desinteresse">
            <div class="secao-confirma-desinteresse">
                <div class="texto-modal-confirma-desinteresse">
                    <h4>Confirme o envio da mensagem com a informação demostrando <br>"<span id="font-vermelha">NÃO INTERESSADO</span>" no contato!</h4>
                </div>
                <div class="botoes-modal-confirma-desinteresse">
                    <button onclick="openModalContatoRespondido()">Confirmar</button>
                    <button onclick="closeModalConfirmaInteresse()">Cancelar</button>
                </div>
            </div>
        </div>
    <!-- MODAL -->

    <!-- MODAL CONTATO RESPONDIDO-->
    @include('usuarioMembro/contatos_recebidos/modal_contato_respondido')
    <!-- MODAL CONTATO RESPONDIDO -->

</body>
</html>