<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/minhas_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/demanda/modal_deletar_demanda.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body> 
    @include('menu')
    <main class="minhas-demandas" id="conteudo">
        @if( session()->has('new_cadastro'))
            <div class="alert alert-success" style="text-align: center">
                <p>{{session('new_cadastro')}}</p>
            </div>
        @endif
        <h1>Minhas Demandas</h1>
        <a href="{{ route('demanda_create_index') }}"><button>Cadastrar Novas Demandas</button></a>
        <table class="table table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de Conhecimento</th>
                    <th scope="col">Data Criação Demanda</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
                <tbody>
                    @php $contador = 1; @endphp 
                    @foreach ($demandas as $demanda)      
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td>{{ $demanda->titulo }}</td>
                            <td>{{ $demanda->areaConhecimento->nome }}</td>
                            <td>{{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</td>
                            <td><a href="{{ route('demanda_edit_index', $demanda->id_demanda) }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                            <td><a onclick="openModalDeletar()"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <td><a href="{{ route('visualizar_matching_demandas_membro') }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
                        </tr>
                        @php $contador++; @endphp
                    @endforeach
                </tbody>
            </table>
            <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>   
        @include('usuarioMembro/demanda/modal_deletar_demandas')
    </main>
</body>
</html>