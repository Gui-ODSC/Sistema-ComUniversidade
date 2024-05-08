<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/contato_recebido/modal_visualizar_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/contatos_recebidos/modal_interessado_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/contatos_recebidos/modal_nao_interessado_contato_recebido.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/contatos_recebidos/modal_contato_respondido.css') }}">
    <script src="{{ asset('js/usuarioProfessor/contatos_recebidos/validacao_mensagem_resposta.js') }}"></script>
    <script src="{{ asset('js/usuarioProfessor/contatos_recebidos/modal_descricao_demanda.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-visualizar" id="modal-visualizar-{{$idContato}}">
        <div class="dados-oferta">
            <div class="informacao-oferta">
                <h5 id="dados-demanda">Dados da Oferta: </h5>
                <div id="titulo-data-oferta">
                    <h2>Título da Oferta: {{$oferta->titulo}}</h2>
                    <h6 id="data">Oferta Realizada em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h6>
                </div>
                <div style="display: flex; height: 50px; align-items: center">
                    <div class="dados-oferta-descricao">
                        <a onclick="openModalDescricao({{$oferta->id_oferta}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                        <x-usuario-professor.contatos-recebidos.modal-descricao-oferta :id-oferta="$oferta->id_oferta"/>
                    </div>
                    <div id="dados-informacao-oferta">
                        @if ($oferta->tipo == 'ACAO')
                            <h6>Público Alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</h6>
                            <h6>Status da Oferta: {{ucwords(strtolower($oferta->ofertaAcao->status_registro))}}</h6>
                            <h6>Tipo Ação: {{ucwords(strtolower($oferta->ofertaAcao->tipoAcao->nome))}}</h6>
                        @endif
                        @if ($oferta->tipo == 'CONHECIMENTO')
                            <h6>Currículo Lattes: <a href="https:\\{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></h6>
                            <h6>Currículo Linkedin: <a href="https:\\{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></h6>
                        @endif
                        @if ($oferta->tipo == 'ACAO')
                            <h6>Duração: {{ucwords(strtolower($oferta->ofertaAcao->duracao))}}</h6>
                            <h6>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</h6>
                            @if ($oferta->ofertaAcao->data_limite)
                                <h6>Data Limite: {{ \Carbon\Carbon::parse($oferta->ofertaAcao->data_limite)->format('d/m/Y') }}</h6>
                            @else
                                <h6>Data Limite: Indefinida</h6>
                            @endif
                        @endif
                        @if ($oferta->tipo == 'CONHECIMENTO')
                            @if ($oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO')
                                <h6>Tempo de Atuação: Menos de 1 Ano</h6>
                            @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                                <h6>Tempo de Atuação: Mais de 1 Ano</h6>
                            @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                                <h6>Tempo de Atuação: Mais de 3 Anos</h6>
                            @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                                <h6>Tempo de Atuação: Mais de 5 Anos</h6>
                            @endif
                        @endif
                        <h6>Área de Conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
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
            <div class="dados-usuario-professor">
                <div class="informacao-professor">
                    <div id="foto-nome">
                        <img src="{{ asset('img/usuarioMembro/contatos/perfil.png') }}" alt="">
                        <h2>{{$usuarioEmissor->nome}}</h2>
                    </div>
                    <div id="dados-professor">
                        <hr>
                        <h6>Cargo: {{(ucwords(strtolower($usuarioEmissor->tipo)))}}</h6>
                        @if ($usuarioEmissor->instituicao)
                            <h6>Instituição: {{$usuarioEmissor->instituicao}}</h6>
                        @else 
                            <h6>Intituição: Não cadastrada</h6>
                        @endif
                        @if ($oferta->tipo === 'ACAO')
                            <h6>Tipo Oferta: Ação</h6>
                        @elseif ($oferta->tipo === 'CONHECIMENTO')
                            <h6>Tipo Oferta: Conhecimento</h6>
                        @endif
                    </div>
                </div>
                <div class="info-criador-interessado">
                    <h6>Criador(a) da Oferta: {{$usuarioReceptor->nome}}</h6>
                    <h6>Interessado(a) na Oferta: {{$usuarioEmissor->nome}}</h6>
                </div>
                <div class="informacao-email">
                    <h4>Contatos Email</h4>
                    <h6>{{$usuarioEmissor->email}}</h6>
                    <h6>{{$usuarioEmissor->email_secundario ?? '' }}</h6>
                </div>
            </div>
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
        @elseif ($respostaMensagem == null && $oferta->tipo == 'CONHECIMENTO')
            <div class='resposta-contato-recebido'>
                <form id="form-contato-{{$idContato}}" action="{{ route('contato_recebido_store_professor', [$idContato]) }}" method="POST" onsubmit="return validarEnviarFormularioConhecimento({{$idContato}})">
                    @csrf
                        <h6>Responder:</h6>
                        <textarea name="resposta-contato" id="mensagem-contato-{{$idContato}}"  placeholder="Existe alguém interessado em sua demanda, responda aqui (*Obrigatório)" oninput="habilitarBotoesConhecimento({{$idContato}})"></textarea>
                    </div>
                    <div class="botoes-oferta">
                        <div>
                            <button class="botao-interessado" id="botao-interessado-{{$idContato}}" name="tipo_mensagem" type="submit" disabled>
                                Interessado
                            </button>
                            <button class="botao-sem-disponibilidade" id="botao-sem-disponibilidade-{{$idContato}}" name="tipo_mensagem" type="submit" disabled>
                                Sem Disponibilidade
                            </button>
                        </div>
                </form>
                    <div>
                        <span class="botao-fechar-modal" onclick="closeModalVisualizarContatoRecebido({{$idContato}})" id="botao-fechar-modal"><button>Fechar</button></span>
                    </div>
                </div>
            </div>
        @elseif($respostaMensagem == null && $oferta->tipo == 'ACAO')
            <div class='resposta-contato-recebido'>
                <form id="form-contato-{{$idContato}}" action="{{ route('contato_recebido_store_professor', [$idContato]) }}" method="POST" onsubmit="return validarEnviarFormularioAcao({{$idContato}})">
                    @csrf
                        <h6>Responder:</h6>
                        <textarea name="resposta-contato" id="mensagem-contato-{{$idContato}}"  placeholder="Existe alguém interessado em sua demanda, responda aqui (*Obrigatório)" oninput="habilitarBotoesAcao({{$idContato}})"></textarea>
                    </div>
                    <div class="botoes-oferta">
                        <div>
                            <button class="botao-respondido" id="botao-contato-respondido-{{$idContato}}" name="tipo_mensagem" type="submit" disabled style="width: 120px">
                                Responder
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
    {{-- Modal Contato Respondido --}}
    <div class="clicar-fora-confirmar-contato-respondido" id="clicar-fora-confirmar-contato-respondido-{{$idContato}}">
        <div class="modal-confirmar-contato-respondido" id="modal-confirmar-contato-respondido-{{$idContato}}">
            <div class="secao-confirma-respondido">
                <div class="texto-modal-confirma-respondido">
                    <h4>Confirme o envio da mensagem com a informação de "<span id="font-azul">Resposta</span>" para o contato!</h4>
                </div>
                <div class="botoes-modal-confirma-respondido">
                    <a id="botao-confirma-envio-resposta-{{$idContato}}">
                        <button>
                            Confirmar
                        </button>
                    </a>
                    <button onclick="closeModalConfirmaContatoRespondido({{$idContato}})">Cancelar</button>
                </div>
            </div>
        </div>
    </div>
</body>
</html>