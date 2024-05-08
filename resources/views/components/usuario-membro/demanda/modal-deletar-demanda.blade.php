<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/demanda/modal_deletar_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal" id="clicar-fora-modal-{{$idDemanda}}" onclick="closeModalDeletar({{$idDemanda}})"></div>
        <div class="caixa-modal" id="caixa-modal-{{$idDemanda}}">
            <span onclick="closeModalDeletar({{$idDemanda}})" id="botao_fechar_model"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
            <div class="modal-excluir">
            <h3 style="padding-top: 25px">Deseja mesmo Excluir essa necessidade ?</h3>
            <h4><strong>"{{$demanda->titulo}}"</strong></h4>
            <div class="div-botoes">
                <form action="{{ route('demanda_delete_store', $idDemanda) }}" method="POST">
                    @method('DELETE')
                    @csrf
                    <button type="submit" id="botao-sim">Sim</button>
                </form>
                <a href="{{ route('demanda_index') }}"><button id="botao-nao">Não</button></a>
            </div>
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>

{{-- x-usuarioMembro.modal-deletar-demanda ->para acessar o componente dentro de uma pasta --}}