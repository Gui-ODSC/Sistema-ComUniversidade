<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/minhas_ofertas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/oferta/modal_deletar_oferta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/oferta/modal_ajuda_tipo_oferta.js') }}"></script>
    <title>Minhas Ofertas</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="minhas-ofertas" id="conteudo">
        <div class="titulo">
            <h1>Minhas Ofertas</h1>
        </div>
        @if( session()->has('msg-oferta'))
            <div class="alert alert-success" style="text-align: center; margin-top: 30px">
                <p>{{session('msg-oferta')}}</p>
            </div>
        @endif
        <div style="display: flex; justify-content: space-between; margin-top: 20px">
            <div class="paginacao-botao">
                <div class="nav-paginator ">
                    {{ $ofertas->links() }}
                </div>
            </div>
            <a href="{{ route('oferta_create_index') }}"><button class="botao-cadastrar">Cadastrar novas ofertas</button></a>
        </div>
        <table class="table table-rounded p-5 table-personalizacao">
            <thead>
                <tr>
                    <th scope="col"></th>
                    <th scope="col">Título</th>
                    <th scope="col">Área de conhecimento</th>
                    <th scope="col">Tipo oferta <button onclick="openModalAjudaTipoOferta({{$usuarioProfessor}})" style="background: none; border: none; color: #FFF">(?)</button></th>
                    <x-usuario-professor.oferta.modal-ajuda-tipo-oferta :id-usuario="$usuarioProfessor"/>
                    <th scope="col">Data criação</th>
                    <th scope="col">Editar</th>
                    <th scope="col">Deletar</th>
                    <th scope="col">Ver</th>
                </tr>
            </thead>
                <tbody>
                    @php  $contador = 1; @endphp 
                    @if (count($ofertas) < 1)
                        <tr>
                            <td colspan="8"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px; max-width:100vw">-- Cadastre uma nova Oferta --</p></td>
                        </tr>
                    @else
                    @foreach ($ofertas as $oferta)    
                        <tr>
                            <th scope="row">{{$contador}}</th>
                            <td><p class="titulo-tabela" title="{{ $oferta->titulo }}">{{ $oferta->titulo }}</p></td>
                            <td><p class="area-conhecimento-tabela" title="{{ $oferta->areaConhecimento->nome }}">{{ $oferta->areaConhecimento->nome }}</p></td>
                            @if ($oferta->tipo === 'ACAO')
                                <td>Ação</td>
                            @elseif (($oferta->tipo === 'CONHECIMENTO'))
                                <td>Conhecimento</td>
                            @endif
                            <td>{{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</td>
                            @if ($oferta->tipo === 'ACAO')
                                <td><a href="{{ route('oferta_edit_index_acao', $oferta->id_oferta) }}"><img id="icones_oferta" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                            @elseif ($oferta->tipo === 'CONHECIMENTO')
                                <td><a href="{{ route('oferta_edit_index_conhecimento', $oferta->id_oferta) }}"><img id="icones_oferta" src="{{ asset('img/usuarioMembro/minhas_demandas/editar.png') }}" alt="tres pontos para mais informação"></a></td>
                            @endif
                            <td><a onclick="openModalDeletar({{$oferta->id_oferta}})"><img id="icones_oferta" src="{{ asset('img/usuarioMembro/minhas_demandas/delete.png') }}" alt="tres pontos para mais informação"></a></td>
                            <x-usuario-professor.oferta.modal-deletar-oferta :id-oferta="$oferta->id_oferta" />
                            <td><a href="{{ route('oferta_matching_index', $oferta->id_oferta) }}"><img id="icones_oferta" src="{{ asset('img/usuarioMembro/minhas_demandas/ver.png') }}" alt="tres pontos para mais informação"></a></td>
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