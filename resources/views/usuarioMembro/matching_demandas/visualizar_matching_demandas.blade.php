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
    <title>Matching Demanda</title>
</head>
<body> 
    @include('menu')
    <main class="matchings" id="conteudo">
        <div class="container-info-demanda">
            <div class="header-demanda">
                <h4>Dados demanda:</h4>
                <h4>Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h4>
            </div>
            <h2>{{$demanda->titulo}}</h2>
            <hr>
            <div class="dados-detalhados-demanda">
                <h5>Tipo: Demanda</h5>
                <h5>Área Conhecimento: {{$demanda->areaConhecimento->nome}}</h5>
                <h5>Pessoas Afetadas: Aprox. {{$demanda->pessoas_afetadas}}</h5>
                <h5>Público Alvo: {{$demanda->publicoAlvo->nome}}</h5>
                <h5>Duração: {{ucwords(strtolower($demanda->duracao))}}</h5>
                <h5>Nivel Prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</h5>
                <h5>Instituição: {{$demanda->instituicao_setor ?? '' }}</h5>
            </div>
        </div>
        <h1>Ofertas encontradas para esta demanda</h1>
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
                    <th scope="col">Tipo Oferta</th>
                    <th scope="col">Data Oferta</th>
                    <th scope="col">Status</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
            <tbody>
                @php  $contador = 1; @endphp 
                @if (count($ofertasEncontradas) < 1)
                    <tr>
                        <td colspan="8"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px">-- Nenhum Matching Encontrado para esta demanda --</p></td>
                    </tr>
                @else
                    @foreach ($ofertasEncontradas as $matching)  
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td>{{$matching->titulo}}</td>
                            <td>{{$matching->areaConhecimento->nome}}</td>
                            <td>{{ucwords(strtolower($matching->tipo))}}</td>
                            <td>{{ \Carbon\Carbon::parse($matching->created_at)->format('d/m/Y') }}</td>
                            <td><img id="icones_status" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/olho_desmarcado.png') }}" alt="tres pontos para mais informação"></td>
                            <td><a onclick="openModalDeletar({{$matching->id_oferta}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-membro.modal-deletar-matching :id-matching="$matching->id_oferta" :id-demanda="$demanda->id_demanda" />
                            <td><a onclick="openModalVisualizarOferta({{$matching->id_oferta}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/pesquisa_contatos.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-membro.modal-visualizar-oferta :id-matching="$matching->id_oferta" :id-demanda="$demanda->id_demanda" />
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