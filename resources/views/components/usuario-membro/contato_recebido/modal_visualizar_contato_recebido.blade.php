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
    <div class="clicar-fora-modal-visualizar-recebido" id="clicar-fora-modal-visualizar-recebido-{{$idContato}}" onclick="closeModalVisualizarContatoRecebido({{$idContato}})"></div>
    <div class="modal-visualizar" id="modal-visualizar-{{$idContato}}">
        <div class="dados-oferta">
            <div style="flex-wrap: wrap">
                <p style="font-size: 13px; color: #FFF; margin-bottom: 2px">Dados necessidade</p>
            </div>
            <div class="cabecalho-titulo-data">
                <h5 id="id-titulo" title="{{$demanda->titulo}}">{{$demanda->titulo}}</h5>
                <h5 id="id-data">Data necessidade: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h5>
            </div>
            <div class="caixa-textarea">
                <div class="div-descricao">
                    {{$demanda->descricao}}
                </div>
            </div>
            <div style="height: 20px;">
                <hr>
            </div>
            <div class="texto-dados-interessado">
                <p>
                    Dados usuário contatante
                </p>
            </div>
            <div class="dados-usuario-emissor">
                <div class="caixa-input" style="width: 69%">
                    <label>
                        Contatante
                    </label>
                    <input type="text" readonly value="{{$usuarioEmissor->nome}}">
                </div>
                <div class="caixa-input" style="width: 30%">
                    <label>
                        Tipo de perfil
                    </label>
                    @if ($usuarioEmissor->tipo === 'PROFESSOR')
                        <input type="text" readonly value="Servidor(a)">
                    @elseif ($usuarioEmissor->tipo === 'ALUNO')
                        <input type="text" readonly value="Estudante">
                    @endif
                </div>
                <div class="caixa-input-space" style="width: 100%">
                    <label>
                        Instituição do contatante
                    </label>
                    @if ($usuarioEmissor->instituicao != null)
                        <input type="text" readonly value="{{$usuarioEmissor->instituicao}}">
                    @else 
                        <input type="text" readonly value="Não registrada">
                    @endif
                </div>
                <div class="caixa-input-space" style="width: 49%">
                    <label>
                        Email
                    </label>
                    <input type="text" readonly value="{{$usuarioEmissor->email}}">
                </div>
                <div class="caixa-input-space" style="width: 50%">
                    <label>
                        Email secundário
                    </label>
                    @if ($usuarioEmissor->email_secundario != null)
                        <input type="text" readonly value="{{$usuarioEmissor->email_secundario}}">
                    @else    
                        <input type="text" readonly value="">
                    @endif
                </div>
                <div class="caixa-textarea-space" style="width: 100%;">
                    <label style="background-color: #FFF; color: black;">
                        Mensagem de {{$usuarioEmissor->nome}}
                    </label>
                    <textarea readonly style="background-color: #FFF; color: black; border: 2px solid black">{{$contatoMensagem->mensagem}}</textarea>
                </div>
            </div>
            @if ($respostaMensagem != null)
                <div class="resposta-contato-recebido">
                    <div class="caixa-textarea-space" style="width: 100%; display: flex; flex-direction: column;">
                        <label style="background-color: #FFF; color: black;">
                            Sua resposta
                        </label>
                        <div class="div-resposta-contato-recebido" readonly style="border: 2px solid black">
                            <div style="height: auto; padding: 5px">
                                <p style="text-align: justify;  white-space: pre-wrap;"">{{$respostaMensagem->mensagem}}</p>
                                <hr>
                                <p style="text-align: justify; font-size: 14px">Atenção: o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por outro meio de comunicação (email, telefone ....)</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="secao-botoes">
                    <div class="botao-fechar">
                        <button onclick="closeModalVisualizarContatoRecebido({{$idContato}})">Fechar</button>
                    </div>
                </div>
            @else
                <form id="form-contato-{{$idContato}}" action="{{ route('contato_recebido_store', [$idContato]) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idContato}})">
                    @csrf
                    <div class="resposta-contato-recebido">
                        <div class="caixa-textarea-space" style="width: 100%; display: flex; flex-direction: column;">
                            <label style="background-color: #FFF; color: black">
                                Escreva sua resposta
                            </label>
                            <textarea name="resposta-contato" id="mensagem-contato-{{$idContato}}"  placeholder="Existe alguém interessado em sua necessidade, responda aqui (*Obrigatório)" oninput="habilitarBotoes({{$idContato}})" style="flex: 1; background-color: #FFF; color: black; border: 2px solid black"></textarea>
                        </div>
                    </div>
                    <div class="texto-status-botao">
                        <p style="margin-bottom: 2px">Defina o status da sua resposta/envio</p>
                    </div>
                    <div class="secao-botoes">
                        <div class="botao-fechar">
                            <button type="button" onclick="closeModalVisualizarContatoRecebido({{$idContato}})">Fechar</button>
                        </div>
                        <div class="botoes-resposta">
                            <div>
                                
                                <button class="botao-interessado" id="botao-interessado-{{$idContato}}" name="tipo_mensagem" type="submit" disabled>
                                    Interesse
                                </button>
                                <button class="botao-sem-disponibilidade" id="botao-sem-disponibilidade-{{$idContato}}" name="tipo_mensagem" type="submit" disabled>
                                    Sem disponibilidade
                                </button>
                            </div>
                        </div>
                    </div>
                </form>
            @endif
            {{-- Modal Interesse --}}
            <div class="clicar-fora-confirmar-interesse" id="clicar-fora-confirmar-interesse-{{$idContato}}">
                <div class="modal-confirmar-interesse" id="modal-confirmar-interesse-{{$idContato}}">
                    <div class="secao-confirma-interesse">
                        <div class="texto-modal-confirma-interesse">
                            <h4>Você está prestes a enviar a mensagem com a informação demonstrando <span id="font-verde">INTERESSE</span> no contato. Confirma o envio da mensagem?</h4>
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
                            <h4>Você está prestes a enviar a mensagem com a informação demonstrando <span id="font-vermelha">Sem Disponibilidade</span> no contato. Confirma o envio da mensagem?</h4>
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
        </div>
    </div>
</body>
</html>