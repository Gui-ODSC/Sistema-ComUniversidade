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
<body style="background-color: #376985"> 
    @include('menu')
    <main class="todos-contatos" id="conteudo">
        <h1>Contatos Realizados</h1>
        <div class="secao-contatos">
            @if (count($contatosRealizados) < 1)
                <div class="contato" id="oferta-requisitada" style="text-align: center; justify-content: center; display: flex; flex-direction: column;">
                        <h5 colspan="8" style="opacity: 0.6; margin-top: 5px; margin-bottom: 0px;">-- Nenhum Contato Realizado até o Momento --</h5>
                        <p style="opacity: 0.6; margin-top: 5px;">Crie demandas e comece a encontrar soluções</p>
                </div>
            @else
            @foreach ($contatosRealizados as $contato)
                <div class="contato" id="oferta-requisitada">
                    <div class="info-esquerda">
                        <div id="img-contato">
                            <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="foto perfil" id="imagem">
                        </div>
                        <div id="info-usuario-contato">
                            <h4>{{$contato['usuarioReceptor']->nome}}</h4>
                            <h5>status: Professor(a)</h5>
                        </div>
                    </div>
                    <div class="info-direita">
                        <div class="barra-titulo">
                            <div id="barra-separadora">
                                <img src="{{ asset('img/icones/barra_vertical.png') }}" alt="barra separadora" id="imagem">
                            </div>
                            <div id="info-contato-realizado">
                                @if ($contato['oferta']->tipo === 'CONHECIMENTO')
                                    <h4>Interesse em Conhecimento</h4>
                                @else
                                    <h4>Interesse em Ação</h4>
                                @endif
                                <h5>Data Contato: {{ \Carbon\Carbon::parse($contato['dados']->created_at)->format('d/m/Y') }}</h5>
                            </div>
                        </div>
                        <div id="icones-contato">
                            @if ($contato['respostaMensagem'] != null)
                                @if ($contato['respostaMensagem']->tipo_mensagem === 'INTERESSADO')
                                    <img id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos_realizados/status_check.png') }}" alt="">
                                @elseif ($contato['respostaMensagem']->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                    <img id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos_realizados/status_sem_disponibilidade.png') }}" alt="">
                                @elseif ($contato['respostaMensagem']->tipo_mensagem === 'RESPONDIDA')
                                    <img id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos_realizados/status_respondida.png') }}" alt="">
                                @endif
                            @else
                                <img id="imagem-contato-status" src="{{ asset('img/usuarioMembro/contatos_realizados/status_realizado.png') }}" alt="">
                            @endif
                            <x-usuario-membro.contatos-realizados.modal-visualizar-contato :id-contato="$contato['dados']->id_contato"/>
                            <a onclick="openModalVisualizarContatoRealizado({{$contato['dados']->id_contato}})"><img id="icone-visualizar-contato" src="{{ asset('img/usuarioMembro/contatos_realizados/visualizar_contato.png') }}" alt="icone mais info"></a>
                        </div>
                    </div>
                </div>
            @endforeach 
        @endif
    </main>
</body>
</html>