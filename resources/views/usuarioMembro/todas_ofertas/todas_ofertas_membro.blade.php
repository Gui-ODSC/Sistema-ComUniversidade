<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/modal_visualizar_oferta.js') }}"></script>
    <!-- CloudFlare -->
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css'>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/todas_ofertas/todas_ofertas_membro.css') }}">
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
            <div class="filtros">
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tipo Oferta
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#oferta_conhecimento" onclick="selecionarOpcao('oferta_conhecimento')">Oferta Conhecimento</a></li>
                        <li><a class="dropdown-item" href="#oferta_acao" onclick="selecionarOpcao('oferta_acao')">Oferta Ação</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Área Conhecimento
                    </button>
                    <ul class="dropdown-menu" id="areaConhecimentoDropdown">
                        <li><a class="dropdown-item" href="#">Engenharia</a></li>
                        <li><a class="dropdown-item" href="#">Tecnologia</a></li>
                        <li><a class="dropdown-item" href="#">Ciências Sociais</a></li>
                        <li><a class="dropdown-item" href="#">Saúde</a></li>
                        <li><a class="dropdown-item" href="#">Ciências Naturais</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Tempo Atuação
                    </button>
                    <ul class="dropdown-menu" id="tempoAtuacaoDropdown">
                        <li><a class="dropdown-item" href="#">Dias</a></li>
                        <li><a class="dropdown-item" href="#">Meses</a></li>
                        <li><a class="dropdown-item" href="#">Anos</a></li>
                        <li><a class="dropdown-item" href="#">Indefinido</a></li>
                    </ul>
                </div>
                <div class="dropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Status Registro
                    </button>
                    <ul class="dropdown-menu" id="tempoAtuacaoDropdown">
                        <li><a class="dropdown-item" href="#">Registrada</a></li>
                        <li><a class="dropdown-item" href="#">Não Registrada</a></li>
                    </ul>
                </div>
            </div>
            <div id="botao-buscar">
                <a href="#"><button>Buscar</button></a>
            </div>
        </div>
        <table class="table table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col">Id</th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Data Oferta</th>
                    <th scope="col">Status</th>
                    <th scope="col">Contato</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Melhoria da Experiência do Cliente</td>
                    <td>Otto</td>
                    <td>12/03/2022</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Desenvolvimento de Estratégia de Sustentabilidade</td>
                    <td>Thornton</td>
                    <td>25/07/2023</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Implementação de Programa de Bem-Estar</td>
                    <td>Thornton</td>
                    <td>05/09/2024</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Integração de Tecnologias Emergentes</td>
                    <td>Thornton</td>
                    <td>18/01/2025</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>08/06/2022</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>30/10/2023</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>21/12/2024</td>
                    <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                    <td><a onclick="openModalVisualizarOferta()" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
        <!-- MODAL VISUALIZAR OFERTA -->
        @include('usuarioMembro/todas_ofertas/modal_visualizar_oferta')
        <!-- MODAL VISUALIZAR OFERTA -->

        <!-- ZERA O CAMPO DE PESQUISA DA CAIXINHA -->
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