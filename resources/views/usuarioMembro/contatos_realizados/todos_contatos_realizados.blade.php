<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_realizados/todos_contatos_realizados.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_realizados/modal_visualizar_contato_realizado.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main class="todos-contatos" id="conteudo">
        <div class="titulo">
            <h1>Contatos Realizados</h1>
        </div>
        <div class="secao-contatos">
            @if( session()->has('msg-contato-respondido'))
                <div class="alert alert-success" style="text-align: center">
                    <p>{{session('msg-contato-respondido')}}</p>
                </div>
            @endif
            <table class="table table-rounded p-5 table-personalizacao">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col">Título da oferta</th>
                        <th scope="col">Tipo da oferta</th>
                        <th scope="col">Nome de contato</th>
                        <th scope="col">Tipo de contato</th>
                        <th scope="col">Data do contato</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @php  $contador = 1; @endphp 
                    @if (count($contatosRealizados) < 1)
                        <tr>
                            <td colspan="8"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px; max-width:100vw">-- Nenhum contato realizado --</p></td>
                        </tr>
                    @else
                        @foreach ($contatosRealizados as $contato)    
                            <tr>
                                <th scope="row">{{$contador}}</th>
                                <td><p title="{{ $contato['oferta']->titulo }}">{{ $contato['oferta']->titulo }}</p></td>
                                @if ($contato['oferta']->tipo === 'ACAO')
                                    <td>Ação</td>
                                @elseif (($contato['oferta']->tipo === 'CONHECIMENTO'))
                                    <td>Conhecimento</td>
                                @endif
                                <td>{{ $contato['usuarioReceptor']->nome }}</td>
                                @if ($contato['usuarioReceptor']->tipo === 'ALUNO') 
                                    <td>Estudante</td>
                                @elseif ($contato['usuarioReceptor']->tipo === 'PROFESSOR')
                                    <td>Servidor(a)</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</td>
                                @if ($contato['respostaMensagem'] != null)
                                    @if ($contato['respostaMensagem']->tipo_mensagem === 'INTERESSADO')
                                        <td><p title="Interessado(a)" class="status-interessado">Interessado(a)</p></td>
                                    @elseif ($contato['respostaMensagem']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                        <td><p title="Sem disponibilidade" class="status-sem-disponibilidade">Sem disponibilidade</p></td>
                                    @elseif ($contato['respostaMensagem']->tipo_mensagem === 'RESPONDIDA')
                                        <td><p title="respondido" class="status-respondido">Respondido</p></td>
                                    @endif
                                @else
                                    <td><p title="Mensagem Enviada" class="status-realizado">Mensagem Enviada</p></td>
                                @endif
                                <td title="Ver"><a onclick="openModalVisualizarContatoRealizado({{$contato['dados']->id_contato}})"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos/visualizar_contato.png') }}" alt="icone mais info"></a></td>
                                <x-usuario-membro.contatos-realizados.modal-visualizar-contato-realizado :id-contato="$contato['dados']->id_contato"/>
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
        </div>
    </main>
</body>
</html>