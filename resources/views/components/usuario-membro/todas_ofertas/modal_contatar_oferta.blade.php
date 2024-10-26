<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/todas_ofertas/modal_contatar_oferta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/todas_ofertas/modal_sucesso_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/mensagem_contatar_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-contatar" id="clicar-fora-modal-contatar-{{$idOferta}}" onclick="closeModalContatarOferta({{$idOferta}})"></div>
        <div class="modal-contatar" id="modal-contatar-{{$idOferta}}">
            <div class="dados-oferta-contatar">
                <div class="dados-usuario-professor-contatar">
                    <div class="informacao-professor-contatar">
                        <h2>{{$professor->nome}}</h2>
                        <hr>
                        @if ($professor->tipo === 'PROFESSOR')
                            <h6>Tipo de usuário: Servidor(a)</h6>
                        @endif
                        @if ($professor->instituicao != null)
                            <h6>Instituição: {{$professor->instituicao}}</h6>
                        @else
                            <h6>Instituição: Não cadastrada</h6>
                        @endif
                    </div>
                    <div class="informacao-email-contatar">
                        <h4>Contatos Email</h4>
                        <h6>{{$professor->email}}</h6>
                        <h6>{{$professor->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta-contatar">
                    <div class="titulo-oferta-contatar">
                        <h2>{{$oferta->titulo}}</h2>
                    </div>
                    <div class="informacao-oferta-coluna-contatar">
                        <div>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Público alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</h6>
                                @if ($oferta->ofertaAcao->status_registro === 'REGISTRADA')
                                    <h6>Status da oferta: Registrada</h6>
                                @elseif ($oferta->ofertaAcao->status_registro === 'NAO_REGISTRADA')
                                    <h6>Status da oferta: Não registrada</h6>
                                @endif
                            @endif
                            @if ($oferta->tipo == 'CONHECIMENTO')
                                @if ($oferta->ofertaConhecimento->link_lattes != null)
                                    <h6 class="truncar-texto">Currículo lattes: <a href="{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></h6>
                                @else
                                    <h6 class="truncar-texto">Currículo lattes: Link não adicionado</h6>
                                @endif
                                @if ($oferta->ofertaConhecimento->link_linkedin != null)
                                    <h6 class="truncar-texto">Currículo linkedin: <a href="{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></h6>
                                @else
                                    <h6 class="truncar-texto">Currículo linkedin: Link não adicionado</h6>
                                @endif
                            @endif
                            <h6>Área de conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
                        </div>
                        <div>
                            <h6 id="data">Ofertado em: {{ \Carbon\Carbon::parse($oferta->created_at)->format('d/m/Y') }}</h6>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Duração: {{ucwords(strtolower($oferta->ofertaAcao->duracao))}}</h6>
                                <h6>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</h6>
                            @endif
                            @if ($oferta->tipo == 'CONHECIMENTO')
                                @if ($oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO')
                                    <h6>Tempo de experiência: Menos de 1 Ano</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO')
                                    <h6>Tempo de experiência: Mais de 1 Ano</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS')
                                    <h6>Tempo de experiência: Mais de 3 Anos</h6>
                                @elseif ($oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS')
                                    <h6>Tempo de experiência: Mais de 5 Anos</h6>
                                @endif
                            @endif
                        </div>
                        <div>
                            @if ($oferta->tipo == 'ACAO')
                                <h6>Tipo ação: {{$oferta->ofertaAcao->tipoAcao->nome}}</h6>
                                @if ($oferta->ofertaAcao->data_limite)
                                    <h6><strong>Data limite: {{ \Carbon\Carbon::parse($oferta->ofertaAcao->data_limite)->format('d/m/Y') }}</strong></h6>
                                @else
                                    <h6><strong>Data limite: Indefinida</strong></h6>
                                @endif
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <form id="form-contato-{{$idOferta}}" action="{{ route('contato_direto_store', $idOferta) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idOferta}})">
                @csrf
                <div class="mensagem-contato">
                    <h6>Escreva sua mensagem:</h6>
                    <textarea name="mensagem-contato" id="mensagem-contato-{{$idOferta}}" cols="122" rows="5" maxlength="900" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
                </div>
                <div class="botoes-oferta-contatar">
                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                    <div>
                        <span onclick="closeModalContatarOferta({{$idOferta}})" id="botao-fechar-modal-contatar"><button type="button">Voltar</button></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- MODAL -->
    <!-- MODAL SUCESSO -->
    <div class="modal-sucesso-contatar" id="modal-sucesso-{{$idOferta}}">
        <div class="sucesso-content">
            <div class="modal-conteudo-sucesso-contatar">
                <span class="fechar-modal-sucesso-contatar" onclick="fecharModalSucesso({{$idOferta}})"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}"/></span>
                <h5 class="titulo-sucesso" id="titulo-sucesso-{{$idOferta}}">Mensagem enviada com sucesso!</h5>
                <div id="mensagem-sucesso">
                    <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>