<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/minhas_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/modal/modal_padrao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body> 
    @include('menu')
    <main class="minhas-demandas" id="conteudo">
        <h1>Minhas Demandas</h1>
        <a href="{{ route('cadastrar_demandas') }}"><button>Cadastrar Novas Demandas</button></a>
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
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">2</th>
                    <td>Desenvolvimento de Estratégia de Sustentabilidade</td>
                    <td>Thornton</td>
                    <td>25/07/2023</td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">3</th>
                    <td>Implementação de Programa de Bem-Estar</td>
                    <td>Thornton</td>
                    <td>05/09/2024</td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">4</th>
                    <td>Integração de Tecnologias Emergentes</td>
                    <td>Thornton</td>
                    <td>18/01/2025</td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">5</th>
                    <td>Jacob</td>
                    <td>Thornton</td>
                    <td>08/06/2022</td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">6</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>30/10/2023</td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
                <tr>
                    <th scope="row">7</th>
                    <td>Mark</td>
                    <td>Otto</td>
                    <td>21/12/2024</td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a onclick="openModal()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                    <td><a href="{{ route('editar_demandas') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                </tr>
            </tbody>
        </table>
            <!-- MODAL -->
            <div class="clicar-fora-modal" id="clicar-fora-modal" onclick="closeModal()"></div>
            <div class="caixa-modal" id="caixa-modal">
                <span onclick="closeModal()" id="botao_fechar_model"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
                @include('usuarioMembro/demanda/modal_deletar_demandas')
            </div>
            <!-- MODAL -->
    </main>
</body>
</html>