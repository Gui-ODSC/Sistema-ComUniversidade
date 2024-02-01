<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/todas_ofertas/todas_ofertas_membro.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/demanda/modal_deletar_demanda.js') }}"></script>
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css'>
    <title>Todas as Ofertas</title>
</head>
<body> 
    @include('menu')
    <main class="todas-ofertas" id="conteudo">
        <h1>Todas as Ofertas Disponíveis</h1>
        <div class="caixa-pesquisa-oferta">
            <input id="campo-pesquisa" type="text" placeholder="Busca de Ofertas">
            <a href="#"><div id="lupa"></div></a>
        </div>
        <hr>
        <div class="secao-filtros">
            <div id="filtros">
                <a href=""><button>Tipo Oferta<img src="{{ asset('img/usuarioMembro/todas_ofertas/seta_baixo.png') }}" alt=""></button></a>
                <a href=""><button>Área Conhecimento<img src="{{ asset('img/usuarioMembro/todas_ofertas/seta_baixo.png') }}" alt=""></button></a>
                <a href=""><button>Tempo Atuação<img src="{{ asset('img/usuarioMembro/todas_ofertas/seta_baixo.png') }}" alt=""></button></a>
            </div>
            <div id="botao-buscar">
                <button>Buscar</button>
            </div>
        </div>
        <table class="table table-bordered table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Data Oferta</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Melhoria da Experiência do Cliente</td>
                    <td>Otto</td>
                    <td>12/03/2022</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Desenvolvimento de Estratégia de Sustentabilidade</td>
                    <td>Thornton</td>
                    <td>25/07/2023</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Implementação de Programa de Bem-Estar</td>
                    <td>Thornton</td>
                    <td>05/09/2024</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Integração de Tecnologias Emergentes</td>
                    <td>Thornton</td>
                    <td>18/01/2025</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>08/06/2022</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>30/10/2023</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>21/12/2024</td>
                    <td><a href="{{ route('editar_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
        <script>
            // Obtém o elemento do campo de pesquisa pelo ID
            var campoPesquisa = document.getElementById('campo-pesquisa');

            // Define o valor do campo de pesquisa como vazio ao carregar a página
            window.onload = function() {
                campoPesquisa.value = '';
            };
        </script>
    </main>
</body>
</html>