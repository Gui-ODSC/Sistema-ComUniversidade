<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/oferta/modal_deletar_oferta.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal" id="clicar-fora-modal-{{$idOferta}}" onclick="closeModalDeletar({{$idOferta}})"></div>
        <div class="caixa-modal" id="caixa-modal-{{$idOferta}}">
            <span onclick="closeModalDeletar({{$idOferta}})" id="botao_fechar_model"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
            <div class="modal-excluir">
                <h3>Deseja mesmo Excluir essa Oferta ?</h3>
                <div class="titulo-excluir">
                    <h6><strong>"{{$oferta->titulo}}"</strong></h6>
                </div>
            </div>
            <div class="div-botoes">
                @if ($oferta->tipo === 'ACAO')
                    <form action="{{ route('oferta_delete_store_acao', $idOferta) }}" method="POST">
                @elseif ($oferta->tipo === 'CONHECIMENTO')
                    <form action="{{ route('oferta_delete_store_conhecimento', $idOferta) }}" method="POST">
                @endif
                    @method('DELETE')
                    @csrf
                    <button type="submit" id="botao-sim">Sim</button>
                </form>
                <a {{-- href="{{ route('oferta_index') }}" --}} onclick="closeModalDeletar({{$idOferta}})"><button id="botao-nao">Não</button></a>
            </div>
        </div>
    </div>
    <!-- MODAL -->
</body>
</html>

{{-- x-usuarioMembro.modal-deletar-demanda ->para acessar o componente dentro de uma pasta --}}