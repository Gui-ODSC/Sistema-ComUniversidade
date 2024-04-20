<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/contato_realizado/modal_visualizar_contato_realizado.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/contatos_realizados/modal_descricao_oferta.js') }}"></script>
    <link rel="stylesheet" href="">
    <title>Contatos Realizados</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-visualizar-contato-realizado" id="clicar-fora-modal-visualizar-contato-realizado-{{$idContato}}" onclick="closeModalVisualizarContatoRealizado({{$idContato}})"></div>
        <div class="modal-visualizar-contato-realizado" id="modal-visualizar-contato-realizado-{{$idContato}}">
            <div class="dados-oferta-contato-respondido">
                <div class="dados-usuario-professor-contato-respondido">
                    <div class="informacao-professor-contato-respondido">
                        <div id="foto-nome-contato-respondido">
                            <img src="{{ asset('img/usuarioMembro/contatos/perfil.png') }}" alt="">
                            <h2>{{$usuarioReceptor->nome}}</h2>
                        </div>
                        <div id="dados-professor-contato-respondido">
                            <hr>
                            <h6>Cargo: {{ucwords(strtolower($usuarioReceptor->tipo))}}(a)</h6>
                            <h6>Instituição: {{-- adicionar --}}</h6>
                            <h6>Tipo: Demanda</h6>
                        </div>
                    </div>
                    <div class="info-criador-interessado-contato-respondido">
                        <h6>Criador(a) da Demanda: {{$usuarioReceptor->nome}}</h6>
                        <h6>Interessado(a) na Demandas: {{$usuarioEmissor->nome}}</h6>
                    </div>
                    <div class="informacao-email-contato-respondido">
                        <h4>Contatos Email</h4>
                        <h6>{{$usuarioReceptor->email}}</h6>
                        <h6>{{$usuarioReceptor->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta-contato-respondido">
                    <h5>Dados Demanda:</h5>
                    <div id="titulo-data-oferta-contato-respondido">
                        <h2>Título: {{$demanda->titulo}}</h2>
                        <h6 id="data">Demandada em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h6>
                    </div>
                    <div style="display: flex; height: 50px; align-items: center">
                        <div class="dados-oferta-descricao">
                            <a onclick="openModalDescricao({{$demanda->id_demanda}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                            <x-usuario-professor.contatos-realizados.modal-descricao-demanda :id-demanda="$demanda->id_demanda"/>
                        </div>
                        <div id="dados-informacao-oferta-contato-respondido">
                            <h6>Público Alvo: {{$demanda->publicoAlvo->nome}}</h6>
                            <h6>Área de Conhecimento: {{$demanda->areaConhecimento->nome}}</h6>
                            <h6>Pessoas Afetadas: {{$demanda->pessoas_afetadas}}</h6>
                            <h6>Duração: {{ucwords(strtolower($demanda->duracao))}}</h6>
                            <h6>Nível Prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</h6>
                            @if ($respostaMensagem != null)
                                @if ($respostaMensagem->tipo_mensagem === 'INTERESSADO')
                                    <h6 title="Interessado(a)">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_check.png') }}" alt="">Interessado(a)</h6>
                                @elseif ($respostaMensagem->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                    <h6 title="Sem Disponibilidade">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_sem_disponibilidade.png') }}" alt="">Sem Disponibilidade</h6>
                                @endif
                            @else
                                <h6 title="Mensagem Enviada">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_realizado.png') }}" alt="">Contato Realizado</h6>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div>
            {{-- SE TIVER RESPOSTA --}}
            @if ($respostaMensagem != null)
            {{-- NESSE TRECHO O PROBLEMA --}}
                <div class="mensagem-contato-recebido-check">
                    <a id="botao-abrir-mensagem-check" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample-{{$idContato}}">
                        <div id="abrir-fechar-mensagem-check">
                            <h6>Mensagem Enviada por Você</h6>
                            <img src="{{ asset('img/usuarioMembro/contatos/seta_branca.png') }}" alt="">
                        </div>
                    </a>
                    <div class="collapse" id="collapseExample-{{$idContato}}">
                        <div id="texto-check">
                            - {{$contatoMensagem->mensagem}}
                        </div>
                    </div>
                </div>
                <div class='resposta-realizada-check'>
                    <h6>Resposta ({{$usuarioReceptor->nome}})</h6>
                    <div class="resposta-mensagem">
                        <p>{{$respostaMensagem->mensagem}}
                        <hr>
                        Independentemente do conteúdo apresentado acima, o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por meio de outro sistema de contato (email, telefone ....)</p>
                    </div>
                </div>
            {{-- FIM PROBLEMA --}}
            @else
                <div class='resposta-realizada'>
                    <h6>Mensagem Enviada ({{$usuarioEmissor->nome}})</h6>
                    <div class="resposta-mensagem">
                        <p>{{$contatoMensagem->mensagem}}</p>
                    </div>
                </div>
            @endif
            <div class="botoes-oferta-respondido">
                <div>
                    <span onclick="closeModalVisualizarContatoRealizado({{$idContato}})" id="botao-fechar-contato-respondido"><button>Fechar</button></span>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>