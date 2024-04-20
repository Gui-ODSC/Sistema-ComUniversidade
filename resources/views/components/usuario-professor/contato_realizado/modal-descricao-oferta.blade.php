<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/contato_realizado/modal_descricao_oferta.css') }}">
    <title>Document</title>
</head>
<body>
    <div class="clicar-fora-modal" id="clicar-fora-modal-{{$idDemanda}}" onclick="closeModalDescricao({{$idDemanda}})"></div>
    <div class="caixa-modal" id="caixa-modal-{{$idDemanda}}">
        <span onclick="closeModalDescricao({{$idDemanda}})" id="botao_fechar_modal"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
        <div class="modal-descricao">
            <h3>Descrição da Demanda</h3>
            <h6>{{$demanda->descricao}}</h6>
        </div>
    </div>
</body>
</html>