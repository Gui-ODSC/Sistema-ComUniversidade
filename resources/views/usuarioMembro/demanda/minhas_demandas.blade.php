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
    @include('usuarioMembro.menu')
    <main class="minhas-demandas" id="conteudo">
        <div class="titulo">
            <h1>Minhas Necessidades</h1>
        </div>
        @if( session()->has('msg-demanda'))
            <div class="alert alert-success" style="text-align: center; margin-top: 20px">
                <p>{{session('msg-demanda')}}</p>
            </div>
        @endif
        <div style="display: flex; justify-content: space-between; margin-top: 20px">
            <div class="paginacao-botao">
                <div class="nav-paginator ">
                    {{ $demandas->links() }}
                </div>
            </div>
            <a href="{{ route('demanda_create_index') }}"><button class="botao-cadastrar">Cadastrar Novas Necessidades</button></a>
        </div>
        <table class="table table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de conhecimento</th>
                    <th scope="col">Data criação</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
                <tbody>
                    @php  $contador = 1; @endphp 
                    @if (count($demandas) < 1)
                        <tr>
                            <td colspan="7"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px; max-width:100vws">-- Cadastre uma nova necessidade --</p></td>
                        </tr>
                    @else
                    @foreach ($demandas as $demanda)    
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td><p class="titulo-tabela" title="{{ $demanda->titulo }}">{{ $demanda->titulo }}</p></td>
                            <td><p class="area-conhecimento-tabela" title="{{ $demanda->areaConhecimento->nome }}">{{ $demanda->areaConhecimento->nome }}</p></td>
                            <td>{{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</td>
                            <td><a href="{{ route('demanda_edit_index', $demanda->id_demanda) }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                            <td><a onclick="openModalDeletar({{$demanda->id_demanda}})"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-membro.demanda.modal-deletar-demanda :id-demanda="$demanda->id_demanda" />
                            <td><a href="{{ route('demanda_matching_index', $demanda->id_demanda) }}"><img id="icones_demanda" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
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