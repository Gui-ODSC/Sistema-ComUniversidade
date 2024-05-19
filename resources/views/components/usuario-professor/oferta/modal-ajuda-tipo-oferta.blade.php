<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/oferta/modal_ajuda_tipo_oferta.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <div class="clicar-fora-modal-ajuda" id="clicar-fora-modal-ajuda-{{$idUsuario}}" onclick="closeModalAjudaTipoOferta({{$idUsuario}})"></div>
        <div class="caixa-modal-ajuda" id="caixa-modal-ajuda-{{$idUsuario}}">
            <div class="botao_fechar_model">
                <a href="{{route('ajuda_sistema_professor')}}" style="color: #FFF">Saiba mais em Ajuda</a>
                <a onclick="closeModalAjudaTipoOferta({{$idUsuario}})"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></a>
            </div>
            <h2>Ajuda - Tipo de Oferta</h2>
            <div class="container-explicao">
                <div class="caixa-ajuda">
                    <h6>Ofertas Conhecimento</h6>
                    <div class="texto-ajuda">
                        <p>Uma oferta do tipo conhecimento é aquela que o Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo eius ut magnam repellendus reiciendis id, ipsam ab. Accusantium autem inventore explicabo vero. A</p>
                    </div>
                </div>
                <div class="caixa-ajuda" style="margin-left: 3px">
                    <h6>Ofertas Ação</h6>
                    <div class="texto-ajuda">
                        <p>Uma oferta do tipo conhecimento é aquela que o Lorem ipsum dolor, sit amet consectetur adipisicing elit. Explicabo eius ut magnam repellendus reiciendis id, ipsam ab. Accusantium autem inventore explicabo vero. A</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

{{-- x-usuarioMembro.modal-deletar-demanda ->para acessar o componente dentro de uma pasta --}}