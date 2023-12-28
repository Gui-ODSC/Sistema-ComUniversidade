<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ofertas_membro/minhas_ofertas.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Minhas Ofertas</title>
</head>
<body> 
    <header class="barra-navegacao">
        <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Abrir</a>
        <h1>Extensao Universitaria</h1>
        <a href="#"><img src="{{ asset('img/perfil.png') }}" alt="imagem de perfil do usuario"></a>
    </header>
    <nav class="menu-navegacao" id="menu_navegacao">
        <a href="#" onclick="fecharMenu()">&times; Fechar</a>
        <a href="{{ route('minhas_ofertas') }}">Minhas Ofertas</a>
        <a href="{{ route('minhas_demandas') }}">Minhas Demandas</a>
        <a href="#">Ofertas/Demandas</a>
        <a href="#">Configurações</a>
        <a href="#">Perfil</a>
        <a href="#">Sair</a>
    </nav>
    <main class="minhas-ofertas" id="conteudo">
        <h1>Minhas Ofertas</h1>
        <a href="{{ route('cadastrar_ofertas') }}"><button>Cadastrar Novas Ofertas</button></a>
        <table class="table table-bordered p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Data Oferta</th>
                    <th scope="col">Detalhes</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <th scope="row">1</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>@mdo</td>
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
                    <th scope="row">3</th>
                    <td colspan="2">Larry the Bird</td>
                    <td>@twitter</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>