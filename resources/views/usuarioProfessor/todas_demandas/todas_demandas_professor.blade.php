<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/modal_visualizar_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/modal_deletar_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/filtros_demandas.js') }}"></script>
    <!-- CloudFlare -->
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css'>
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/todas_demandas/todas_demandas_professor.css') }}">
    <title>Todas as Ofertas</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="todas-ofertas" id="conteudo">
        <div class="titulo">
            <h1>Todas as Demandas Disponíveis</h1>
        </div>
        <div class="caixa-pesquisa-oferta">
            <input id="campo-pesquisa" type="text" placeholder="Busca de Ofertas">
            <a href="#"><div id="lupa"></div></a>
        </div>
        <hr>
        <div class="secao-filtros">
            <div class="filtros">
                <div class="dropdown" id="areaConhecimentoDropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                        Área Conhecimento
                    </button>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="#">Engenharia</a></li>
                        <li><a class="dropdown-item" href="#">Tecnologia</a></li>
                        <li><a class="dropdown-item" href="#">Ciências Sociais</a></li>
                        <li><a class="dropdown-item" href="#">Saúde</a></li>
                        <li><a class="dropdown-item" href="#">Ciências Naturais</a></li>
                    </ul>
                </div>
                <div class="dropdown" id="tempoAtuacaoDropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" disabled>
                        Tempo Atuação
                    </button>
                    <ul class="dropdown-menu" id="tempoAtuacaoDropdown">
                        <li><a class="dropdown-item" href="#">Dias</a></li>
                        <li><a class="dropdown-item" href="#">Meses</a></li>
                        <li><a class="dropdown-item" href="#">Anos</a></li>
                        <li><a class="dropdown-item" href="#">Indefinido</a></li>
                    </ul>
                </div>
                <div class="dropdown" id="statusRegistroDropdown">
                    <button class="btn btn-secondary dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false" disabled>
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
        @if( session()->has('msg-deletar'))
            <div class="alert alert-success" style="text-align: center">
                <p>{{session('msg-deletar')}}</p>
            </div>
        @endif
        <table class="table table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Data Oferta</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Contato</th>
                </tr>
            </thead>
            <tbody>
                @php  $contador = 1; @endphp 
                @if (count($demandas) < 1)
                    <tr>
                        <td colspan="7"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px">-- Nenhuma Demanda Disponível no Momento --</p></td>
                    </tr>
                @else
                    @foreach ($demandas as $key => $demanda)
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td>{{$demanda['demanda']->titulo}}</td>
                            <td>{{$demanda['demanda']->areaConhecimento->nome}}</td>
                            <td>{{ \Carbon\Carbon::parse($demanda['demanda']->created_at)->format('d/m/Y') }}</td>
                            @if ($demanda['status'] == 'nao_visualizado')
                                <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                            @elseif ($demanda['status'] == 'visualizado')
                                <td><img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                            @endif
                            <td><a onclick="openModalDeletar({{$demanda['demanda']->id_demanda}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-professor.todas-demandas.modal-deletar-demanda :id-demanda="$demanda['demanda']->id_demanda" />
                            <td><a onclick="openModalVisualizarOferta({{$demanda['demanda']->id_demanda}})" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-professor.todas-demandas.modal-visualizar-demanda :id-demanda="$demanda['demanda']->id_demanda" />
                        </tr>
                        @php $contador++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <!-- ZERA O CAMPO DE PESQUISA DA CAIXINHA -->
        <script>
            // Obtém o elemento do campo de pesquisa pelo ID
            var campoPesquisa = document.getElementById('campo-pesquisa');

            // Define o valor do campo de pesquisa como vazio ao carregar a página
            window.onload = function() {
                campoPesquisa.value = '';
            };
        </script>
        <div class="paginacao-botao">
            <div class="nav-paginator ">
                {{ $paginate->links() }}
            </div>
        </div>
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
</body>
</html>