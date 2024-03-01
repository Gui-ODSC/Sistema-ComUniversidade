<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/modal_deletar_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>

    <!-- MODAL -->
    <div class="clicar-fora-modal" id="clicar-fora-modal" onclick="closeModalDeletar()"></div>
        <div class="caixa-modal" id="caixa-modal">
            <span onclick="closeModalDeletar()" id="botao_fechar_model"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
            <div class="modal-excluir">
            <h2>Deseja mesmo Excluir ?</h2>
            <div class="div-botoes">
                <a href="{{ route('demanda_index') }}"><button id="botao-sim">Sim</button></a>
                <a href="{{ route('demanda_index') }}"><button id="botao-nao">Não</button></a>
            </div>
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>