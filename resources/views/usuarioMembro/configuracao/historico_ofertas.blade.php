<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/configuracao/historico_ofertas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main class="historico-oferta" id="conteudo">
        <h1>Historico de Ofertas</h1>
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
                    <td>Oferta 1</td>
                    <td>Saúde</td>
                    <td>22/12/2023</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/icones/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Oferta 2</td>
                    <td>Tecnologia</td>
                    <td>22/12/2023</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/icones/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Oferta 3</td>
                    <td>Engenharia</td>
                    <td>22/12/2023</td>
                    <td id="fundo-detalhes"><a href="#"><img id="detalhes" src="{{ asset('img/icones/detalhes.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
    </main>
</body>
</html>