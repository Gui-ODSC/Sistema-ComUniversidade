<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_deletar_demanda.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Todas as Ofertas</title>
</head>
<body>
    <div class="clicar-fora-modal" id="clicar-fora-modal-{{$idDemanda}}" onclick="closeModalDeletar({{$idDemanda}})"></div>
    <div class="caixa-modal" id="caixa-modal-{{$idDemanda}}">
        <span onclick="closeModalDeletar({{$idDemanda}})" id="botao_fechar_modal"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
        <div class="modal-excluir">
            <h3>Deseja mesmo remover esta necessidade da lista?</h3>
            <h6>Após removida, ela não será mostrada novamente.</h6>
            <div class="div-botoes">
                <form action="{{ route('contato_direto_remover_professor', $idDemanda) }}" method="POST">
                    @csrf
                    <button type="submit" id="botao-sim">Sim</button>
                </form>
                <a href="{{ route('list_todas_ofertas') }}"><button id="botao-nao">Não</button></a>
            </div>
        </div>
    </div>
</body>
</html>