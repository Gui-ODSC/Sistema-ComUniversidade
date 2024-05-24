<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/matching_demandas/visualizar_matching_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_descricao_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_ajuda_tipo_oferta.js') }}"></script>
    <title>Matching Demanda</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main class="matchings" id="conteudo">
        <div class="container-info-demanda">
            <div class="header-demanda">
                <h4>Dados da necessidade:</h4>
                <h4>Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h4>
            </div>
            <div class="titulo-descricao">
                <div class="titulo">
                    <h2>{{$demanda->titulo}}</h2>
                </div>
                <div style="display: flex; align-items: center; flex-direction: column;">
                    <a onclick="openModalDescricao({{$demanda->id_demanda}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                    <p style="margin: 0">Descrição</p>
                    <x-usuario-membro.matching.modal-descricao-demanda :id-demanda="$demanda->id_demanda"/>
                </div>
            </div>
            <hr id="linha-separadora" style="display: none">
            <div class="dados-detalhados-demanda" id="dados-detalhados-demanda" style="display: none;">
               {{--  <div style="display: block; width: 100%;">
                    <p style="margin-bottom: 0;">Dados necessidade</p>
                </div> --}}
                <div class="dados">
                    <h5>Tipo: Necessidade</h5>
                    <h5>Pessoas atingidas: aprox. {{$demanda->pessoas_afetadas}}</h5>
                    <h5>Duração: {{ucwords(strtolower($demanda->duracao))}}</h5>
                    <h5>Instituição: {{$demanda->instituicao_setor ?? 'Não cadastrada' }}</h5>
                </div>
                <div class="dados" style="margin-left: 20px">
                    <h5>Área conhecimento: {{$demanda->areaConhecimento->nome}}</h5>
                    <h5>Público alvo: {{$demanda->publicoAlvo->nome}}</h5>
                    @if ($demanda->nivel_prioridade === 'BAIXO')
                        <h5>Nivel prioridade: Baixo</h5>
                    @elseif ($demanda->nivel_prioridade === 'MEDIO')
                        <h5>Nivel prioridade: Médio</h5>
                    @else
                        <h5>Nivel prioridade: Alto</h5>
                    @endif
                </div>
            </div>
            <div style="display: flex; justify-content: center; width: 100%;">
                <hr>
                <button class="botao-ver-mais" onclick="toggleDadosDetalhados()">Ver Mais</button>
                <hr>
            </div>
        </div>
        <h1>Ofertas encontradas para esta necessidade</h1>
        @if( session()->has('msg-matching'))
            <div class="alert alert-success" style="text-align: center">
                <p>{{session('msg-matching')}}</p>
            </div>
        @endif
        <table class="table table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de conhecimento</th>
                    <th scope="col">Tipo oferta <button onclick="openModalAjudaTipoOferta({{$demanda->id_demanda}})" style="background: none; border: none; color: #FFF">(?)</button></th>
                    <x-usuario-membro.matching.modal-ajuda-tipo-oferta :id-demanda="$demanda->id_demanda"/>
                    <th scope="col">Data oferta</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                @php  $contador = 1; @endphp 
                @if (count($ofertasEncontradas) < 1)
                    <tr>
                        <td colspan="8"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px; max-width:100vw">-- Nenhuma oferta encontrada para esta necessidade --</p></td>
                    </tr>
                @else
                    @foreach ($ofertasEncontradas as $key => $matching)  
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td><p title="{{$matching['oferta']->titulo}}">{{$matching['oferta']->titulo}}</p></td>
                            <td>{{$matching['oferta']->areaConhecimento->nome}}</td>
                            @if ($matching['oferta']->tipo === 'ACAO')
                                <td>Ação</td>
                            @elseif ($matching['oferta']->tipo === 'CONHECIMENTO')
                                <td>Conhecimento</td>
                            @endif
                            <td>{{ \Carbon\Carbon::parse($matching['oferta']->created_at)->format('d/m/Y') }}</td>
                            @if ($matching['status'] == 'nao_visualizado')
                                <td><p class="status-nao-visualizado" title="Não Visualizado">Não visualizado</p>{{-- <img title="nao" id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"> --}}</td>
                            @elseif ($matching['status'] == 'visualizado')
                                <td><p class="status-visualizado" title="Visualizado">Visualizado</p>{{-- <img title="nao" id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_marcado.png') }}" alt="tres pontos para mais informação" > --}}</td>
                            @endif
                            <td title="Deletar"><a onclick="openModalDeletar({{$matching['oferta']->id_oferta}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-membro.matching.modal-deletar-matching :id-matching="$matching['oferta']->id_oferta" :id-demanda="$demanda->id_demanda" />
                            <td title="Ver"><a onclick="openModalVisualizarOferta({{$matching['oferta']->id_oferta}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-membro.matching.modal-visualizar-oferta :id-matching="$matching['oferta']->id_oferta" :id-demanda="$demanda->id_demanda" />
                        </tr>
                        @php $contador++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
        <script>
            function toggleDadosDetalhados() {
                var dadosDetalhados = document.getElementById("dados-detalhados-demanda");
                var linhaSeparadora = document.getElementById("linha-separadora");
                var botao = document.querySelector("button");
                if (dadosDetalhados.style.display === "none") {
                    dadosDetalhados.style.display = "flex";
                    botao.textContent = "Ver Menos";
                    linhaSeparadora.style.display = "block";
                } else {
                    dadosDetalhados.style.display = "none";
                    linhaSeparadora.style.display = "none";
                    botao.textContent = "Ver Mais";
                }
            }
        </script>
    </main>
</body>
</html>