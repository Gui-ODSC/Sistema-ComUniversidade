<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_deletar_matchings.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <div class="clicar-fora-modal" id="clicar-fora-modal-{{$idMatching}}" onclick="closeModalDeletar({{$idMatching}})"></div>
    <div class="caixa-modal" id="caixa-modal-{{$idMatching}}">
        <span onclick="closeModalDeletar({{$idMatching}})" id="botao_fechar_modal"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
        <div class="modal-excluir">
            <h3>Deseja mesmo remover esta oferta da lista?</h3>
            <h6>Após removida, ela não será mostrada novamente.</h6>
            <div class="div-botoes">
                <form action="{{ route('matching_remover', [$idDemanda, $idMatching]) }}" method="POST">
                    {{-- @method('DELETE') --}}
                    @csrf
                    <button type="submit" id="botao-sim">Sim</button>
                </form>
                {{-- <a href="{{ route('demanda_matching_index', $idDemanda) }}"> --}}<button onclick="closeModalDeletar({{$idMatching}})" id="botao-nao">Não</button></a>
            </div>
        </div>
    </div>
</body>
</html>