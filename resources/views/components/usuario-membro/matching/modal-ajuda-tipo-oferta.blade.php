<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_ajuda_tipo_oferta.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <div class="clicar-fora-modal-ajuda" id="clicar-fora-modal-ajuda-{{$idDemanda}}" onclick="closeModalAjudaTipoOferta({{$idDemanda}})"></div>
        <div class="caixa-modal-ajuda" id="caixa-modal-ajuda-{{$idDemanda}}">
            <div class="botao_fechar_model">
                <a href="{{route('ajuda_sistema')}}" style="color: #FFF">Saiba mais em Ajuda</a>
                <a onclick="closeModalAjudaTipoOferta({{$idDemanda}})"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></a>
            </div>
            <h2>Ajuda - Tipo de Oferta</h2>
            <div class="container-explicao">
                <div class="caixa-ajuda">
                    <h6>Ofertas Conhecimento</h6>
                    <div class="texto-ajuda">
                        <p>As Ofertas do Tipo Conhecimento são aquelas que envolvem a disponibilização do saber acumulado pelos servidores de uma instituição. Essas ofertas não estão necessariamente ligadas a uma ação específica ou prática, mas focam na disseminação do conhecimento teórico e prático que os profissionais podem compartilhar. </p>
                    </div>
                </div>
                <div class="caixa-ajuda" style="margin-left: 3px">
                    <h6>Ofertas Ação</h6>
                    <div class="texto-ajuda">
                        <p>As Ofertas do Tipo Ação são iniciativas práticas voltadas para o desenvolvimento de atividades específicas que envolvem cursos, projetos, programas e eventos de extensão. Essas ações são direcionadas tanto para a comunidade interna de uma instituição quanto para o público externo, com o objetivo de promover a interação, a troca de conhecimentos e o engajamento social.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

{{-- x-usuarioMembro.modal-deletar-demanda ->para acessar o componente dentro de uma pasta --}}