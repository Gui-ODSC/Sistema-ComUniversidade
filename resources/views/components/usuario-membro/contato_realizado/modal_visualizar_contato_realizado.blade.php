<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/contato_realizado/modal_visualizar_contato_realizado.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/contatos_realizados/modal_descricao_oferta.js') }}"></script>
    <link rel="stylesheet" href="">
    <title>Contatos Realizados</title>
</head>
<body>
    <div class="clicar-fora-modal-visualizar-contato-realizado" id="clicar-fora-modal-visualizar-contato-realizado-{{$idContato}}" onclick="closeModalVisualizarContatoRealizado({{$idContato}})"></div>
        <div class="modal-visualizar-contato-realizado" id="modal-visualizar-contato-realizado-{{$idContato}}">
            <div class="dados-necessidade">
                <div style="flex-wrap: wrap">
                    <p style="font-size: 13px; color: #FFF; margin-bottom: 0">Dados oferta</p>
                </div>
                <div class="cabecalho-titulo-data">
                    <h5 id="id-titulo" title="{{$oferta->titulo}}">{{$oferta->titulo}}</h5>
                    <h5 id="id-data">Data da oferta: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h5>
                </div>
                <div class="caixa-textarea" style="margin-top: 0">
                    <div class="div-descricao">
                        {{$oferta->descricao}}
                    </div>
                </div>
                <div style="height: 20px;">
                    <hr>
                </div>
                <div class="texto-dados-interessado">
                    <p>
                        Dados do usuário contatado(a)
                    </p>
                </div>
                <div class="dados-usuario-emissor">
                    <div class="caixa-input" style="width: 69%">
                        <label>
                            Nome do contatado(a)
                        </label>
                        <input type="text" readonly value="{{$usuarioReceptor->nome}}">
                    </div>
                    <div class="caixa-input" style="width: 30%">
                        <label>
                            Tipo de perfil
                        </label>
                        @if ($usuarioReceptor->tipo === 'PROFESSOR')
                            <input type="text" readonly value="Servidor(a)">
                        @elseif ($usuarioReceptor->tipo === 'ALUNO')
                            <input type="text" readonly value="Estudante">
                        @endif
                    </div>
                    <div class="caixa-input-space" style="width: 100%">
                        <label>
                            Instituição do contatado(a)
                        </label>
                        @if ($usuarioReceptor->instituicao != null)
                            <input type="text" readonly value="{{$usuarioReceptor->instituicao}}">
                        @else 
                            <input type="text" readonly value="Não registrada">
                        @endif
                    </div>
                    <div class="caixa-input-space" style="width: 49%">
                        <label>
                            Email
                        </label>
                        <input type="text" readonly value="{{$usuarioReceptor->email}}">
                    </div>
                    <div class="caixa-input-space" style="width: 50%">
                        <label>
                            Email secundário
                        </label>
                        @if ($usuarioReceptor->email_secundario != null)
                            <input type="text" readonly value="{{$usuarioReceptor->email_secundario}}">
                        @else    
                            <input type="text" readonly value="">
                        @endif
                    </div>
                </div>
                @if ($respostaMensagem != null)
                    <div class="caixa-textarea-space" style="width: 100%;">
                        <label style="background-color: #FFF; color: black">
                            Sua mensagem
                        </label>
                        <textarea readonly style="background-color: #FFF; color: black; border: 2px solid black">{{$contatoMensagem->mensagem}}</textarea>
                    </div>
                    <div class="resposta-contato-recebido">
                        <div class="caixa-textarea-space" style="width: 100%; display: flex; flex-direction: column;">
                            <label style="background-color: #FFF; color: black">
                                Resposta de {{$usuarioReceptor->nome}}
                            </label>
                            <div class="div-resposta-contato-recebido" readonly>
                                <div style="height: 0px; padding: 5px">
                                    <p style="text-align: justify">{{$respostaMensagem->mensagem}}</p>
                                    <hr>
                                    <p style="text-align: justify; font-size: 14px">Atenção: o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por outro meio de comunicação (email, telefone ....)</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="secao-botoes">
                        <div class="botao-fechar">
                            <button onclick="closeModalVisualizarContatoRealizado({{$idContato}})">Fechar</button>
                        </div>
                    </div>
                @else
                    <div class="resposta-contato-recebido">
                        <div class="caixa-textarea-space" style="width: 100%; display: flex; flex-direction: column;">
                            <label style="background-color: #FFF; color: black">
                                Sua mensagem
                            </label>
                            <textarea readonly style="background: #FFF; color: black; height: 100%; border: 2px solid black">{{$contatoMensagem->mensagem}}</textarea>
                        </div>
                    </div>
                    <div class="secao-botoes">
                        <div class="botao-fechar">
                            <button onclick="closeModalVisualizarContatoRealizado({{$idContato}})">Fechar</button>
                        </div>
                    </div>
                @endif
            </div>    
        </div>
    </body>
</html>