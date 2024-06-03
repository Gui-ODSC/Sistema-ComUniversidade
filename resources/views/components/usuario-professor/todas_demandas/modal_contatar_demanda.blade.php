<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_contatar_demanda.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/todas_demandas/modal_sucesso_demanda.css') }}">
    <script src="{{ asset('js/usuarioProfessor/todas_demandas/mensagem_contatar_demanda.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-contatar" id="clicar-fora-modal-contatar-{{$idDemanda}}" onclick="closeModalContatarOferta({{$idDemanda}})"></div>
        <div class="modal-contatar" id="modal-contatar-{{$idDemanda}}">
            <div class="dados-oferta-contatar">
                <div class="dados-usuario-professor-contatar">
                    <div class="informacao-professor-contatar">
                        <h2>{{$usuarioMembro->nome}}</h2>
                        <hr>
                        @if ($usuarioMembro->tipo === 'MEMBRO')
                            <h6>Tipo de usuário: Membro externo</h6>
                        @elseif ($usuarioMembro->tipo === 'ALUNO')
                            <h6>Tipo de usuário: Estudante</h6>
                        @endif
                        @if ($usuarioMembro->instituicao)
                            <h6>Instituição: {{$usuarioMembro->instituicao}}</h6>
                        @else 
                            <h6>Instituição: Não cadastrada</h6>
                        @endif
                    </div>
                    <div class="informacao-email-contatar">
                        <h4>Contatos Email</h4>
                        <h6>{{$usuarioMembro->email}}</h6>
                        <h6>{{$usuarioMembro->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta-contatar">
                    <div class="informacao-oferta-contatar">
                        <div class="titulo-oferta-contatar">
                            <h2>{{$demanda->titulo}}</h2>
                        </div>
                        <div class="informacao-oferta-coluna-contatar">
                            <div>
                                <h6>Tipo: Necessidade</h6>
                                <h6>Pessoas atingidas: Aprox. {{$demanda->pessoas_afetadas}}</h6>
                                <h6>Duração: {{ucwords(strtolower($demanda->duracao))}}</h6>
                            </div>
                            <div>
                                <h6>Área conhecimento: {{$demanda->areaConhecimento->nome}}</h6>
                                <h6>Público alvo: {{$demanda->publicoAlvo->nome}}</h6>
                                <h6>Nivel prioridade: {{ucwords(strtolower($demanda->nivel_prioridade))}}</h6>
                            </div>
                            <div>
                                <h6 id="data-contatar">Criada em: {{ \Carbon\Carbon::parse($demanda->created_at)->format('d/m/Y') }}</h6>
                                <h6>Instituição: {{$demanda->instituicao_setor ?? 'Não cadastrada' }}</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <form id="form-contato-{{$idDemanda}}" action="{{ route('contato_direto_store_professor', $idDemanda) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idDemanda}})">
                @csrf
                <div class="mensagem-contato">
                    <h6>Escreva sua mensagem:</h6>
                    <textarea name="mensagem-contato" id="mensagem-contato-{{$idDemanda}}" cols="119" rows="5" maxlength="900" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
                </div>
                <div class="botoes-oferta-contatar">
                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                    <div>
                        <span onclick="closeModalContatarOferta({{$idDemanda}})" id="botao-fechar-modal-contatar"><button type="button">Voltar</button></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- MODAL -->
    <!-- MODAL SUCESSO -->
    <div class="modal-sucesso-contatar" id="modal-sucesso-{{$idDemanda}}">
        <div class="sucesso-content">
            <div class="modal-conteudo-sucesso-contatar">
                <span class="fechar-modal-sucesso-contatar" onclick="fecharModalSucesso({{$idDemanda}})"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}"/></span>
                <h5 class="titulo-sucesso" id="titulo-sucesso-{{$idDemanda}}">Mensagem enviada com sucesso!</h5>
                <div id="mensagem-sucesso">
                    <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>