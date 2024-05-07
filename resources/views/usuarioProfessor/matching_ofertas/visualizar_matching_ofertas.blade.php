<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/matching_ofertas/visualizar_matching_oferta.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_visualizar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_descricao_demanda.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/matching_ofertas/modal_interessados_oferta.js') }}"></script>
    <title>Matching Demanda</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="matchings" id="conteudo">
        <div class="container-info-demanda">
            <div class="header-demanda">
                @if ($oferta->tipo === 'ACAO') 
                    <h4>Dados Oferta Ação:</h4>
                @elseif ($oferta->tipo === 'CONHECIMENTO')
                    <h4>Dados Oferta Conhecimento:</h4>
                @endif
                <h4>Criada em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h4>
            </div>
            <div class="titulo-descricao">
                <div>
                    <h2>{{$oferta->titulo}}</h2>
                </div>
                <div style="display: flex">
                    <div style="display: flex; align-items: center; flex-direction: column; margin-right: 20px;">
                        <a onclick="openModalDescricao({{$oferta->id_oferta}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                        <p style="margin: 0">Descrição</p>
                        <x-usuario-professor.matching-acao.modal-descricao-oferta :id-oferta="$oferta->id_oferta"/>
                    </div>
                    @if ($oferta->tipo === 'ACAO')
                        <div style="display: flex; align-items: center; flex-direction: column; margin-right: 20px;">
                            <a onclick="openModalUsuariosInteressados({{$oferta->id_oferta}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/interessados.png') }}" alt="tres pontos para mais informação"></a>
                            <p style="margin: 0">Interessados</p>
                            <x-usuario-professor.matching-acao.modal-interessados-oferta :id-oferta="$oferta->id_oferta"/>
                        </div>
                    @endif
                </div>
            </div>
            <hr>
            @if ($oferta->tipo === 'ACAO') 
                <div class="dados-detalhados-demanda">
                    <div>
                        <h5>Tipo: {{$ofertaAcao->tipoAcao->nome}}</h5>
                        <h5>Regime {{ucwords(strtolower($ofertaAcao->regime))}}</h5>
                        <h5>Duração: {{ucwords(strtolower($ofertaAcao->duracao))}}</h5>
                        <h5>Status Registro: {{ucwords(strtolower($ofertaAcao->status_registro))}}</h5>
                    </div>
                    <div>
                        <h5>Área Conhecimento: {{$oferta->areaConhecimento->nome}}</h5>
                        <h5>Público Alvo: {{$ofertaAcao->publicoAlvo->nome}}</h5>
                        <h5>Tipo Ação: {{ucwords(strtolower($ofertaAcao->tipoAcao->nome))}}</h5>
                        @if ($ofertaAcao->data_limite)
                            <h5>Data Limite: {{ \Carbon\Carbon::parse($ofertaAcao->data_limite)->format('d/m/Y') }}</h5>
                        @else
                            <h5>Data Limite: Indefinida</h5>
                        @endif
                    </div>
                </div>
            @elseif ($oferta->tipo === 'CONHECIMENTO')
                <div class="dados-detalhados-demanda">
                    <div>
                        <h5>Área Conhecimento: {{$oferta->areaConhecimento->nome}}</h5>
                        @if ($oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO')
                            <h5>Tempo de Atuação: Menos de 1 Ano</h5>
                        @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                            <h5>Tempo de Atuação: Mais de 1 Ano</h5>
                        @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                            <h5>Tempo de Atuação: Mais de 3 Anos</h5>
                        @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                            <h5>Tempo de Atuação: Mais de 5 Anos</h5>
                        @endif
                        <h5>Link Lattes: {{$ofertaConhecimento->link_lattes}}</h5>
                        <h5>Link Linkedin: {{$ofertaConhecimento->link_linkedin}}</h5>
                    </div>
                </div>
            @endif
        </div>
        <h1>Demandas encontradas para esta oferta</h1>
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
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Nº de Pessoas Impactadas</th>
                    <th scope="col">Data criação</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                @php  $contador = 1; @endphp 
                @if (count($demandasEncontradas) < 1)
                    <tr>
                        <td colspan="8"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px">-- Nenhum Matching Encontrado para esta Oferta --</p></td>
                    </tr>
                @else
                    @foreach ($demandasEncontradas as $key => $matching)  
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td>{{$matching['demanda']->titulo}}</td>
                            <td>{{$matching['demanda']->areaConhecimento->nome}}</td>
                            <td>{{($matching['demanda']->pessoas_afetadas)}}</td>
                            <td>{{ \Carbon\Carbon::parse($matching['demanda']->created_at)->format('d/m/Y') }}</td>
                            @if ($matching['status'] == 'nao_visualizado')
                                <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                            @elseif ($matching['status'] == 'visualizado')
                                <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_marcado.png') }}" alt="tres pontos para mais informação"></td>
                            @endif
                            <td><a onclick="openModalDeletar({{$matching['demanda']->id_demanda}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-professor.matching-acao.modal-deletar-matching :id-matching="$matching['demanda']->id_demanda" :id-oferta="$oferta->id_oferta" />
                            <td><a onclick="openModalVisualizarOferta({{$matching['demanda']->id_demanda}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-professor.matching-acao.modal-visualizar-demanda :id-matching="$matching['demanda']->id_demanda" :id-oferta="$oferta->id_oferta" />
                        </tr>
                        @php $contador++; @endphp
                    @endforeach
                @endif
            </tbody>
        </table>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
    </main>
</body>
</html>