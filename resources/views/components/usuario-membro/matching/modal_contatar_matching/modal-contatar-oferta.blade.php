<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_contatar/modal_contatar_oferta.css') }}">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioMembro/matching/modal_contatar/modal_sucesso_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/matching_demandas/mensagem_contatar_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-contatar" id="clicar-fora-modal-contatar-{{$idMatching}}" onclick="closeModalContatarOferta({{$idMatching}})"></div>
        <div class="modal-contatar" id="modal-contatar-{{$idMatching}}">
            <div class="dados-oferta-contatar">
                <div class="dados-usuario-professor-contatar">
                    <div class="informacao-professor-contatar">
                        <h2>{{$professor->nome}}</h2>
                        <hr>
                        <h6>Cargo: Professor</h6>
                        <h6>Instituição: </h6>
                        <h6>Tipo Oferta: {{ucwords(strtolower($oferta->tipo))}}</h6>
                    </div>
                    <div class="informacao-email-contatar">
                        <h4>Contatos Email</h4>
                        <h6>{{$professor->email}}</h6>
                        <h6>{{$professor->email_secundario ?? '' }}</h6>
                    </div>
                </div>
                <div class="informacao-oferta-coluna">
                    <div>
                        @if ($oferta->tipo == 'ACAO')
                            <h6>Público Alvo: {{$oferta->ofertaAcao->publicoAlvo->nome}}</h6>
                            <h6>Status da Oferta: {{ucwords(strtolower($oferta->ofertaAcao->status_registro))}}</h6>
                        @endif
                        @if ($oferta->tipo == 'CONHECIMENTO')
                            <h6>Currículo Lattes: <a href="{{$oferta->ofertaConhecimento->link_lattes}}">{{$oferta->ofertaConhecimento->link_lattes}}</a></h6>
                            <h6>Currículo Linkedin: <a href="{{$oferta->ofertaConhecimento->link_linkedin}}">{{$oferta->ofertaConhecimento->link_linkedin}}</a></h6>
                        @endif
                        <h6>Área de Conhecimento: {{$oferta->areaConhecimento->nome}}</h6>
                    </div>
                    <div>
                        <h6 id="data">Ofertado em: 22/12/2023</h6>
                        @if ($oferta->tipo == 'ACAO')
                            <h6>Duração: Anos</h6>
                            <h6>Regime: {{ucwords(strtolower($oferta->ofertaAcao->regime))}}</h6>
                        @endif
                        @if ($oferta->tipo == 'CONHECIMENTO')
                            <h6>Tempo de Atuação: {{$oferta->ofertaConhecimento->tempo_atuacao}}</h6>
                        @endif
                    </div>
                </div>
            </div>
            <form id="form-contato-{{$idMatching}}" action="{{ route('contato_store', [$idDemanda, $idMatching]) }}" method="POST" onsubmit="return validarEnviarFormulario({{$idMatching}})">
                @csrf
                <div class="mensagem-contato">
                    <h6>Descricao Oferta:</h6>
                    <textarea name="mensagem-contato" id="mensagem-contato-{{$idMatching}}" cols="119" rows="5" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
                </div>
                <div class="botoes-oferta-contatar">
                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                    <div>
                        <span onclick="closeModalContatarOferta({{$idMatching}})" id="botao-fechar-modal-contatar"><button type="button">Voltar</button></span>
                    </div>
                </div>
            </form>
        </div>
    </div>
    <!-- MODAL -->
    <!-- MODAL SUCESSO -->
    <div class="modal-sucesso-contatar" id="modal-sucesso-{{$idMatching}}">
        <div class="modal-conteudo-sucesso-contatar">
            <span class="fechar-modal-sucesso-contatar" onclick="fecharModalSucesso({{$idMatching}})">&times;</span>
            <h5 class="titulo-sucesso" id="titulo-sucesso-{{$idMatching}}">Mensagem enviada com sucesso!</h5>
            <div id="mensagem-sucesso">
                <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
            </div>
        </div>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>