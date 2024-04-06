<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/contato_realizado/modal_descricao_oferta.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="clicar-fora-modal" id="clicar-fora-modal-{{$idOferta}}" onclick="closeModalDescricao({{$idOferta}})"></div>
    <div class="caixa-modal" id="caixa-modal-{{$idOferta}}">
        <span onclick="closeModalDescricao({{$idOferta}})" id="botao_fechar_modal"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
        <div class="modal-descricao">
            <h3>Descrição da Oferta</h3>
            <h6>{{$oferta->descricao}}</h6>
        </div>
    </div>
</body>
</html>