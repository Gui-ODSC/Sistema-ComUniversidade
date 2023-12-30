<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/demandas_ofertas_membro/demandas_ofertas.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Demandas e Ofertas</title>
</head>
<body> 
    <header class="barra-navegacao">
        <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Abrir</a>
        <h1>Extensao Universitaria</h1>
        <a href="{{ route('perfil') }}"><img src="{{ asset('img/perfil.png') }}" alt="imagem de perfil do usuario"></a>
    </header>
    <nav class="menu-navegacao" id="menu_navegacao">
        <a href="#" onclick="fecharMenu()">&times; Fechar</a>
        <a href="{{ route('minhas_ofertas') }}">Minhas Ofertas</a>
        <a href="{{ route('minhas_demandas') }}">Minhas Demandas</a>
        <a href="{{ route('demandas_ofertas') }}">Ofertas/Demandas</a>
        <a href="{{ route('configuracoes') }}">Configurações</a>
        <a href="{{ route('perfil') }}">Perfil</a>
        <a href="{{ route('sair') }}">Sair</a>
    </nav>
    <main class="demandas-ofertas" id="conteudo">
        <h1>Demandas e Ofertas Disponíveis</h1>
        <table class="table table-bordered p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Demanda/Oferta</th>
                    <th scope="col">Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>Otto</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>@fat</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>