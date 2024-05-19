<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioEstudante/contato_realizado/modal_visualizar_contato_realizado.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/usuarioEstudante/contatos_realizados/modal_descricao_oferta.js') }}"></script>
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
                            <input type="text" readonly value="Professor">
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
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
    </body>
</html>






























{{-- 
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
                            @if ($usuarioReceptor->instituicao)
                                <h6>Instituição: {{$usuarioReceptor->instituicao}}</h6>
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
                    <div class="info-criador-interessado-contato-respondido">
                        <h6>Criador(a) da Oferta: {{$usuarioReceptor->nome}}</h6>
                        <h6>Interessado(a) na Oferta: {{$usuarioEmissor->nome}}</h6>
                    </div>
                    <div class="informacao-email-contato-respondido">
                        <h4>Contatos Email</h4>
                        <h6>{{$usuarioReceptor->email}}</h6>
                        <h6>{{$usuarioReceptor->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta-contato-respondido">
                    <h5>Dados Oferta:</h5>
                    <div id="titulo-data-oferta-contato-respondido">
                        <h2>Título: {{$oferta->titulo}}</h2>
                        <h6 id="data">Ofertado em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h6>
                    </div>
                    <div style="display: flex; height: 50px; align-items: center">
                        <div class="dados-oferta-descricao">
                            <a onclick="openModalDescricao({{$oferta->id_oferta}})"><img src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/descricao.png') }}" alt="tres pontos para mais informação"></a>
                            <x-usuario-estudante.contatos-realizados.modal-descricao-oferta :id-oferta="$oferta->id_oferta"/>
                        </div>
                        <div id="dados-informacao-oferta-contato-respondido">
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
                                    <h6>Tempo de experiência:: Menos de 1 Ano</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                                    <h6>Tempo de experiência:: Mais de 1 Ano</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                                    <h6>Tempo de experiência:: Mais de 3 Anos</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                                    <h6>Tempo de experiência:: Mais de 5 Anos</h6>
                                @endif
                            @endif
                            <h6>Área de Conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
                            @if ($respostaMensagem != null)
                                @if ($respostaMensagem->tipo_mensagem === 'INTERESSADO')
                                    <h6 title="Interessado(a)">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_check.png') }}" alt="">Interessado(a)</h6>
                                @elseif ($respostaMensagem->tipo_mensagem === 'SEM_DISPONIBILIDADE')
                                    <h6 title="Sem Disponibilidade">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_sem_disponibilidade.png') }}" alt="">Sem Disponibilidade</h6>
                                @elseif ($respostaMensagem->tipo_mensagem === 'RESPONDIDA')
                                    <h6 title="Contato Respondido">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_respondida.png') }}" alt="">Contato Respondido</h6>
                                @endif
                            @else
                                <h6 title="Mensagem Enviada">Status: <img src="{{ asset('img/usuarioMembro/contatos/status_realizado.png') }}" alt="">Contato Realizado</h6>
                            @endif
                        </div>
                    </div>
                    
                </div>
            </div> --}}
            {{-- SE TIVER RESPOSTA --}}
            {{-- @if ($respostaMensagem != null)
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
</html> --}}