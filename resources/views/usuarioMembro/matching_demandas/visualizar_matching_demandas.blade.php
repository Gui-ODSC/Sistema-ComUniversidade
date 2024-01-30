<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/visualizar_matching_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/demanda/modal_deletar_demanda.js') }}"></script>
    <title>Matching Demanda</title>
</head>
<body> 
    @include('menu')
    <main class="matchings" id="conteudo">
        <div class="container-info-demanda">
            <div class="header-demanda">
                <h4>Dados demanda:</h4>
                <h4>Criada em: 22/12/2023</h4>
            </div>
            <h2>Consultas Médicas em Áreas Inacessíveis</h2>
            <hr>
            <div class="dados-detalhados-demanda">
                <h5>Tipo: Demanda</h5>
                <h5>Área Conhecimento: Saúde</h5>
                <h5>Pessoas Afetadas: Aprox. 200</h5>
                <h5>Público Alvo: Moradores de áreas Isoladas</h5>
                <h5>Duração: Indefinido</h5>
                <h5>Nivel Prioridade: Alta</h5>
                <h5>Instituição: Penha Damasco</h5>
            </div>
        </div>
        <h1>Ofertas encontradas para esta demanda</h1>
        <table class="table table-bordered table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Data Oferta</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td></td>
                    <td></td>
                    <td></td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="#"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
            <!-- MODAL -->
            <div class="clicar-fora-modal" id="clicar-fora-modal" onclick="closeModalDeletar()"></div>
            <div class="caixa-modal" id="caixa-modal">
                <span onclick="closeModalDeletar()" id="botao_fechar_model"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
                @include('usuarioMembro/matching_demandas/modal_deletar_matchings')
            </div>
            <!-- MODAL -->
    </main>
</body>
</html>