<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/todos_contatos_recebidos.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_visualizar_contato_recebido.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>
<body> 
    @include('usuarioMembro.menu')
    <main class="todos-contatos" id="conteudo">
        <div class="titulo">
            <h1>Contatos Recebidos</h1>
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
                        <th scope="col">Título da necessidade</th>
                        <th scope="col">Nome do contato</th>
                        <th scope="col">Tipo de contato</th>
                        <th scope="col">Data do contato</th>
                        <th scope="col">Status</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @php  $contador = 1; @endphp 
                    @if (count($contatosRecebidos) < 1)
                        <tr>
                            <td colspan="7"><p style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px; max-width:100vw">-- Nenhum Contato Recebido --</p></td>
                        </tr>
                    @else
                        @foreach ($contatosRecebidos as $contato)    
                            <tr>
                                <th scope="row">{{$contador}}</th>
                                <td><p class="titulo-tabela" title="{{ $contato['demanda']->titulo }}">{{ $contato['demanda']->titulo }}</p></td>
                                <td><p class="nome-tabela" title="{{ $contato['usuarioEmissor']->nome }}">{{ $contato['usuarioEmissor']->nome }}</p></td>
                                @if ($contato['usuarioEmissor']->tipo === 'ALUNO') 
                                    <td>Estudante</td>
                                @elseif ($contato['usuarioEmissor']->tipo === 'PROFESSOR')
                                    <td>Servidor(a)</td>
                                @endif
                                <td>{{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</td>
                                @if ($contato['respostaEnviada'] != null)
                                    @if ($contato['respostaEnviada']->tipo_mensagem === 'INTERESSADO')
                                        <td><p title="Interessado(a)" class="status-interessado">Interessado(a)</p></td>
                                    @elseif ($contato['respostaEnviada']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                        <td><p class="status-sem-disponibilidade" title="Sem disponibilidade">Sem disponibilidade</p></td>
                                    @elseif ($contato['respostaEnviada']->tipo_mensagem === 'RESPONDIDA')
                                        <td><p title="respondido" class="status-respondido">Respondido</p></td>
                                    @endif
                                @else
                                    <td><p title="Mensagem Recebida" class="status-recebido">Mensagem Recebida</p></td>
                                @endif
                                <td title="Ver"><a onclick="openModalVisualizarContatoRecebido({{$contato['dados']->id_contato}})"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos/visualizar_contato.png') }}" alt="icone mais info"></a></td>
                                <x-usuario-membro.contatos-recebidos.modal-visualizar-contato-recebido :id-contato="$contato['dados']->id_contato"/>
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
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>  
    </main>
</body>
</html>