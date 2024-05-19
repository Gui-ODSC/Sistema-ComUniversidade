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
            <div class="dados-necessidade">
                <div style="flex-wrap: wrap">
                    <p style="font-size: 13px; color: #FFF; margin-bottom: 0">Dados necessidade</p>
                </div>
                <div class="cabecalho-titulo-data">
                    <h5 id="id-titulo" title="{{$demanda->titulo}}">{{$demanda->titulo}}</h5>
                    <h5 id="id-data">Data da necessidade: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h5>
                </div>
                <div class="caixa-textarea" style="margin-top: 0">
                    <div class="div-descricao">
                        {{$demanda->descricao}}
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
                        @if ($usuarioReceptor->tipo === 'MEMBRO')
                            <input type="text" readonly value="Membro Externo">
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
                            Email Secundário
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
                                    <p style="text-align: justify; font-size: 14px">Independentemente do conteúdo apresentado acima, o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por outro meio de contato (email, telefone ....)</p>
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
                            <textarea readonly style="background: #FFF; color: black; height: 100%;">{{$contatoMensagem->mensagem}}</textarea>
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
    </div>
</body>
</html>








{{-- <div class="dados-oferta-contato-respondido">
    <div class="dados-usuario-professor-contato-respondido">
        <div class="informacao-professor-contato-respondido">
            <div id="foto-nome-contato-respondido">
                <img src="{{ asset('img/usuarioMembro/contatos/perfil.png') }}" alt="">
                <h2>{{$usuarioReceptor->nome}}</h2>
            </div>
            <div id="dados-professor-contato-respondido">
                <hr>
                <h6>Cargo: {{ucwords(strtolower($usuarioReceptor->tipo))}}(a)</h6>
                @if ($usuarioReceptor->instituicao)
                    <h6>Instituição: {{$usuarioReceptor->instituicao}}</h6>
                @else 
                    <h6>Intituição: Não cadastrada</h6>
                @endif
                <h6>Tipo: Necessidade</h6>
            </div>
        </div>
        <div class="info-criador-interessado-contato-respondido">
            <h6>Criador(a) da Necessidade: {{$usuarioReceptor->nome}}</h6>
            <h6>Interessado(a) na Necessidades: {{$usuarioEmissor->nome}}</h6>
        </div>
        <div class="informacao-email-contato-respondido">
            <h4>Contatos Email</h4>
            <h6>{{$usuarioReceptor->email}}</h6>
            <h6>{{$usuarioReceptor->email_secundario ?? '' }}</h6>
        </div>
    </div>
    <div class="informacao-oferta-contato-respondido">
        <h5>Dados Necessidade:</h5>
        <div id="titulo-data-oferta-contato-respondido">
            <h2>Título: {{$demanda->titulo}}</h2>
            <h6 id="data">Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h6>
        </div>
        <div style="display: flex; height: 50px; align-items: center">
            <div class="dados-oferta-descricao">
                <a onclick="openModalDescricao({{$demanda->id_demanda}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                <x-usuario-professor.contatos-realizados.modal-descricao-demanda :id-demanda="$demanda->id_demanda"/>
            </div>
            <div id="dados-informacao-oferta-contato-respondido">
                <h6>Público Alvo: {{$demanda->publicoAlvo->nome}}</h6>
                <h6>Área de Conhecimento: {{$demanda->areaConhecimento->nome}}</h6>
                <h6>Pessoas Atingidas: {{$demanda->pessoas_afetadas}}</h6>
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
 --}}



