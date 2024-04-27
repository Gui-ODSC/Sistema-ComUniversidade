<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/contato_recebido/modal_visualizar_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/modal_interessado_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/modal_nao_interessado_contato_recebido.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/validacao_mensagem_resposta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_descricao_demanda.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-visualizar" id="modal-visualizar-{{$idContato}}">
        <div class="dados-oferta">
            <div class="dados-usuario-professor">
                <div class="informacao-professor">
                    <div id="foto-nome">
                        <img src="{{ asset('img/usuarioMembro/contatos/perfil.png') }}" alt="">
                        <h2>{{$usuarioEmissor->nome}}</h2>
                    </div>
                    <div id="dados-professor">
                        <hr>
                        <h6>Cargo: {{(ucwords(strtolower($usuarioEmissor->tipo)))}}(a)</h6>
                        <h6>Instituição: </h6>
                    </div>
                </div>
                <div class="info-criador-interessado">
                    <h6>Criador(a) da Necessidade: {{$usuarioReceptor->nome}}</h6>
                    <h6>Interessado(a) na Necessidade: {{$usuarioEmissor->nome}}</h6>
                </div>
                <div class="informacao-email">
                    <h4>Contatos Email</h4>
                    <h6>{{$usuarioEmissor->email}}</h6>
                    <h6>{{$usuarioEmissor->email_secundario ?? '' }}</h6>
                </div>
            </div>
            <div class="informacao-oferta">
                <h5 id="dados-demanda">Dados da necessidade: </h5>
                <div id="titulo-data-oferta">
                    <h2>Título da necessidade: {{$demanda->titulo}}</h2>
                    <h6 id="data">Necessidade Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h6>
                </div>
                <div style="display: flex; height: 50px; align-items: center">
                    <div class="dados-oferta-descricao">
                        <a onclick="openModalDescricao({{$demanda->id_demanda}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                        <x-usuario-membro.contatos-recebidos.modal-descricao-demanda :id-demanda="$demanda->id_demanda"/>
                    </div>
                    <div id="dados-informacao-oferta">
                        <h6>Público Alvo: {{$demanda->publicoAlvo->nome}}</h6>
                        <h6>Duração: {{(ucwords(strtolower($demanda->duracao)))}}</h6>
                        <h6>Nº Pessoas Impactadas: Aprox. {{$demanda->pessoas_afetadas}}</h6>
                        <h6>Área de Conhecimento: {{$demanda->areaConhecimento->nome}}</h6>
                        @if ($respostaMensagem != null)
                            @if ($respostaMensagem->tipo_mensagem === 'INTERESSADO')
                                <h6 title="Interessado">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_check.png') }}" alt="">Interessado(a)</h6>
                            @elseif ($respostaMensagem->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                <h6 title="Sem Disponibilidade">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_sem_disponibilidade.png') }}" alt="">Sem Disponibilidade</h6>
                            @elseif ($respostaMensagem->tipo_mensagem === 'RESPONDIDA')
                                <h6 title="Mensage Respondida">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_respondida.png') }}" alt="">Contato Respondido</h6>
                            @endif
                        @else    
                            <h6 title="Mensagem Recebida">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_recebido.png') }}" alt="">Contato Recebido</h6>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="descricao-oferta">
            <h6 style="color: #FFF">Mensagem Recebida ({{$usuarioEmissor->nome}})</h6>
            <div class="mensagem-recebida">
                <p style="text-align: justify">{{$contatoMensagem->mensagem}}</p>
            </div>
        </div>
        {{-- SE TIVER RESPOSTA --}}
        @if ($respostaMensagem != null)
            <div class='resposta-contato-recebido'>
                <h6>Resposta:</h6>
                <div class="resposta-mensagem-recebida">
                    <p style="text-align: justify">{{$respostaMensagem->mensagem}}</p>
                    <hr>
                    <p style="text-align: justify">Independentemente do conteúdo apresentado acima, o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por meio de outro meio de contato (email, telefone ....)</p>
                </div>
            </div>
            <div class="botoes-oferta" style="display: flex; justify-content: end;">
                <div>
                    <span class="botao-fechar-modal" onclick="closeModalVisualizarContatoRecebido({{$idContato}})" id="botao-fechar-modal"><button>Fechar</button></span>
                </div>
            </div>
        @else
            <div class='resposta-contato-recebido'>
                <form id="form-contato-{{$idContato}}" action="{{ route('contato_recebido_store', [$idContato]) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idContato}})">
                    @csrf
                        <h6>Responder:</h6>
                        <textarea name="resposta-contato" id="mensagem-contato-{{$idContato}}"  placeholder="Existe alguém interessado em sua necessidade, responda aqui (*Obrigatório)" oninput="habilitarBotoes({{$idContato}})"></textarea>
                    </div>
                    <div class="botoes-oferta">
                        <div>
                            <button class="botao-interessado" id="botao-interessado-{{$idContato}}" type="submit" disabled>
                                Interessado
                            </button>
                            <button class="botao-sem-disponibilidade" id="botao-sem-disponibilidade-{{$idContato}}" name="tipo_mensagem" value="SEM_DISPONIBILIDADE" type="submit" disabled>
                                Sem Disponibilidade
                            </button>
                        </div>
                </form>
                    <div>
                        <span class="botao-fechar-modal" onclick="closeModalVisualizarContatoRecebido({{$idContato}})" id="botao-fechar-modal"><button>Fechar</button></span>
                    </div>
                </div>
            </div>
        @endif
    {{-- Modal Interesse --}}
    <div class="clicar-fora-confirmar-interesse" id="clicar-fora-confirmar-interesse-{{$idContato}}">
        <div class="modal-confirmar-interesse" id="modal-confirmar-interesse-{{$idContato}}">
            <div class="secao-confirma-interesse">
                <div class="texto-modal-confirma-interesse">
                    <h4>Confirme o envio da mensagem com a informação demostrando "<span id="font-verde">INTERESSE</span>" no contato!</h4>
                </div>
                <div class="botoes-modal-confirma-interesse">
                    <a id="botao-confirma-envio-interesse-{{$idContato}}">
                        <button>
                            Confirmar
                        </button>
                    </a>
                    <button onclick="closeModalConfirmaInteresse({{$idContato}})">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
    {{-- Modal Sem disponibilidade --}}
    <div class="clicar-fora-confirmar-sem-disponibilidade" id="clicar-fora-confirmar-sem-disponibilidade-{{$idContato}}">
        <div class="modal-confirmar-sem-disponibilidade" id="modal-confirmar-sem-disponibilidade-{{$idContato}}">
            <div class="secao-confirma-sem-disponibilidade">
                <div class="texto-modal-confirma-sem-disponibilidade">
                    <h4>Confirme o envio da mensagem com a informação demostrando <br>"<span id="font-vermelha">Sem Disponibilidade</span>" no contato!</h4>
                </div>
                <div class="botoes-modal-confirma-sem-disponibilidade">
                    <a id="botao-confirma-envio-sem-disponibilidade-{{$idContato}}">
                        <button>
                            Confirmar
                        </button>
                    </a>
                    <button onclick="closeModalConfirmaSemDisponibilidade({{$idContato}})">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>