<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- JS -->
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/filtros_ofertas.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/todas_ofertas/modal_ajuda_tipo_oferta.js') }}"></script>
    <!-- CloudFlare -->
    <link rel='stylesheet' href='//cdnjs.cloudflare.com/ajax/libs/font-awesome/4.2.0/css/font-awesome.min.css' type='text/css'>
    {{-- SELECTPICKER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.8/dist/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.6/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    <!-- Bootstrap -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js" integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    <!-- CSS -->
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/todas_ofertas/todas_ofertas_estudante.css') }}">
    <title>Todas as Ofertas</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main class="todas-ofertas" id="conteudo">
        <div class="titulo">
            <h1>Todas as Ofertas Disponíveis</h1>
        </div>
        <div class="caixa-pesquisa-oferta" style="justify-content: space-between">
            <div class="botao-limpar">
                <a href="{{route('lista_todas_ofertas_estudante')}}"><button id="limparFiltro">Limpar Filtros</button></a>
            </div>
            <form action="{{ route('lista_todas_ofertas_estudante') }}" method="GET">
                @csrf
                <div class="input-group">
                    <input type="text" name="pesquisa_titulo" class="form-control" placeholder="Pesquisar título..." value="{{ $pesquisaTitulo ? $pesquisaTitulo: '' }}"">
                    <button type="submit" class="btn btn-outline-secondary" id="pesquisaTitulo">
                        <i class="bi bi-search"><img src="{{asset('img/usuarioMembro/todas_ofertas/lupa_pesquisa.png')}}" alt=""></i> <!-- Ícone de busca (exemplo: usando Bootstrap Icons) -->
                    </button>
                </div>
            </form>
        </div>
        <hr>
        <div class="secao-filtros">
            <div class="filtros">
                <form action="{{ route('lista_todas_ofertas_estudante') }}" method="GET">
                    @csrf
                    <div style="display: flex; width: 100%;">
                        <select class="selectpicker mg"data-live-search="true" name="area_conhecimento">
                            <option value="" selected disabled>Área conhecimento</option>
                            @foreach ($listAreaConhecimento as $areaConhecimento)
                                <option value="{{ $areaConhecimento->id_area_conhecimento }}" {{ $areaConhecimentoSelecionada == $areaConhecimento->id_area_conhecimento ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                            @endforeach
                        </select>
                        <select class="selectpicker mg"data-live-search="true" name="publico_alvo">
                            <option value="" selected disabled>Publico alvo</option>
                            @foreach ($listPublicoAlvo as $publicoAlvo)
                                <option value="{{ $publicoAlvo->id_publico_alvo }}" {{ $publicoAlvoSelecionado == $publicoAlvo->id_publico_alvo ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                            @endforeach
                        </select>
                        <div>
                            <select class="filtro-select-normal" name="status_registro" style="width: 154px">
                                <option selected disabled>Status registro</option>
                                <option value="NAO_REGISTRADA" {{ $statusRegistroSelecionado == 'NAO_REGISTRADA' ? 'selected' : '' }}>Não Registrada</option>
                                <option value="REGISTRADA" {{ $statusRegistroSelecionado == 'REGISTRADA' ? 'selected' : '' }}>Registrada</option>
                            </select>
                        </div>
                        <select class="filtro-select-normal" name="regime" style="width: 150px">
                            <option selected disabled>Modalidade</option>
                            <option value="PRESENCIAL" {{ $regimeSelecionado == 'PRESENCIAL' ? 'selected' : '' }}>Presencial</option>
                            <option value="ONLINE" {{ $regimeSelecionado == 'ONLINE' ? 'selected' : '' }}>Online</option>
                        </select>
                    </div>
                        <div id="botao-buscar">
                            <button type="submit">Buscar</button>
                        </div>
                    </div>
                </form>
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
                    <th scope="col">Área de conhecimento</th>
                    <th scope="col">Tipo de oferta <button onclick="openModalAjudaTipoOferta({{$usuarioEstudante}})" style="background: none; border: none; color: #FFF">(?)</button></th>
                    <x-usuario-estudante.todas-ofertas.modal-ajuda-tipo-oferta :id-usuario="$usuarioEstudante"/>
                    <th scope="col">Data da oferta</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Contato</th>
                </tr>
            </thead>
            <tbody>
                @php  $contador = 1; @endphp 
                @if (count($ofertas) < 1)
                    <tr>
                        <td colspan="8"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px; max-width: 100vw">-- Nenhuma Oferta Disponível no Momento --</p></td>
                    </tr>
                @else
                    @foreach ($ofertas as $key => $oferta)
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td><p title="{{$oferta['oferta']->titulo}}">{{$oferta['oferta']->titulo}}</p></td>
                            <td>{{$oferta['oferta']->areaConhecimento->nome}}</td>
                            @if ($oferta['oferta']->tipo === 'ACAO')
                                <td>Ação</td>
                            @elseif ($oferta['oferta']->tipo === 'CONHECIMENTO')
                                <td>Conhecimento</td>
                            @endif
                            <td>{{ \Carbon\Carbon::parse($oferta['oferta']->created_at)->format('d/m/Y') }}</td>
                            @if ($oferta['status'] == 'nao_visualizado')
                                <td><p class="status-nao-visualizado" title="Não Visualizado">Não Visualizado</p>{{-- <img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"> --}}</td>
                            @elseif ($oferta['status'] == 'visualizado')
                                <td><p class="status-visualizado" title="Visualizado">Visualizado</p>{{-- <img id="icones_status" src="{{ asset('img/usuarioMembro/todas_ofertas/olho_marcado.png') }}" alt="tres pontos para mais informação"> --}}</td>
                            @endif
                            <td title="Deletar"><a onclick="openModalDeletar({{$oferta['oferta']->id_oferta}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-estudante.todas-ofertas.modal-deletar-oferta :id-oferta="$oferta['oferta']->id_oferta" />
                            <td title="Contatar"><a onclick="openModalVisualizarOferta({{$oferta['oferta']->id_oferta}})" ><img id="icones_demanda" src="{{ asset('img/usuarioMembro/todas_ofertas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-estudante.todas-ofertas.modal-visualizar-oferta :id-oferta="$oferta['oferta']->id_oferta" />
                        </tr>
                        @php $contador++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <div class="paginacao-botao">
            <div class="nav-paginator ">
                {{ $paginate->links() }}
            </div>
        </div>
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
</body>
</html>