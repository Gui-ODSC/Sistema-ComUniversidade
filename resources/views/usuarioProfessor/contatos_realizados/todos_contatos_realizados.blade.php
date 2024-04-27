<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/contatos_realizados/todos_contatos_realizados.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/usuarioProfessor/contatos_realizados/modal_visualizar_contato_realizado.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="todos-contatos" id="conteudo">
        <div class="titulo">
            <h1>Contatos Realizados</h1>
        </div>
        <div class="secao-contatos">
            @if (count($contatosRealizados) < 1)
                <div class="contato" id="oferta-requisitada" style="text-align: center; justify-content: center; display: flex; flex-direction: column;">
                        <h5 colspan="8" style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px;">-- Nenhum Contato Realizado até o Momento --</h5>
                        <p style="opacity: 0.6; margin-top: 5px;">Crie Ofertas e comece a encontrar soluções</p>
                </div>
            @else
            @foreach ($contatosRealizados as $contato)
                <div class="contato" id="oferta-requisitada">
                    <div class="info-esquerda">
                        <div id="img-contato">
                            <img src="{{ asset('img/usuarioMembro/contatos/perfil.png') }}" alt="foto perfil" id="imagem">
                        </div>
                        <div id="info-usuario-contato">
                            <h4>{{$contato['usuarioReceptor']->nome}}</h4>
                            <h5>Usuário: {{ucwords(strtolower($contato['usuarioReceptor']->tipo))}}</h5>
                        </div>
                    </div>
                    <div class="info-direita">
                        <div class="barra-titulo">
                            <div id="barra-separadora">
                                <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                            </div>
                            <div id="info-contato-realizado">
                                <h4>Interesse em Necessidade</h4>
                                <h5>Data Contato: {{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</h5>
                            </div>
                        </div>
                        <div id="icones-contato">
                            @if ($contato['respostaMensagem'] != null)
                                @if ($contato['respostaMensagem']->tipo_mensagem === 'INTERESSADO')
                                    <img title="Interessado(a)" id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos/status_check.png') }}" alt="">
                                @elseif ($contato['respostaMensagem']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                    <img title="Sem Disponibilidade" id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos/status_sem_disponibilidade.png') }}" alt="">
                                @endif
                            @else
                                <img title="Mensagem Enviada" id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos/status_realizado.png') }}" alt="">
                            @endif
                            <a onclick="openModalVisualizarContatoRealizado({{$contato['dados']->id_contato}})"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos/visualizar_contato.png') }}" alt="icone mais info"></a>
                            <x-usuario-professor.contatos-realizados.modal-visualizar-contato-realizado :id-contato="$contato['dados']->id_contato"/>
                        </div>
                    </div>
                </div>
            @endforeach 
        @endif
        <div class="paginacao-botao">
            <div class="nav-paginator ">
                {{ $paginate->links() }}
            </div>
        </div>
    </main>
</body>
</html>