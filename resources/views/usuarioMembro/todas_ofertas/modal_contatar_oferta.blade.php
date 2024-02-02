<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/todas_ofertas/modal_contatar_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/todas_ofertas/mensagem_contatar_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-contatar" id="clicar-fora-modal-contatar" onclick="closeModalContatarOferta()"></div>
        <div class="modal-contatar" id="modal-contatar">
            <div class="dados-oferta-contatar">
                <div class="dados-usuario-professor-contatar">
                    <div class="informacao-professor-contatar">
                        <h2>Arnaldo Silveira</h2>
                        <hr>
                        <h6>Cargo: Professor</h6>
                        <h6>Instituição: UFSC</h6>
                        <h6>Tipo Oferta: Ação</h6>
                    </div>
                    <div class="informacao-email-contatar">
                        <h4>Contatos Email</h4>
                        <h6>arnaldo_sil@gmail.com</h6>
                        <h6>arnaldo_sil@gmail.com</h6>
                    </div>
                </div>
                <div class="informacao-oferta-contatar">
                    <h2>Título: Projeto de MySQL no Ensino Médio</h2>
                    <h6>Público Alvo: Alunos Ensino Médio</h6>
                    <h6 id="data-contatar">Ofertado em: 22/12/2023</h6>
                    <h6>Duração: Anos</h6>
                    <h6>Nº Pessoas Impactadas: Aprox. 200</h6>
                    <h6>Área de Conhecimento: Educação</h6>
                </div>
            </div>
            <div class="mensagem-contato">
                <form id="form-contato" action="{{ route('todas_ofertas_membro') }}" onsubmit="return validarEnviarFormulario()">
                    <h6>Descricao Oferta:</h6>
                    <textarea name="mensagem-contato" id="mensagem-contato" cols="122" rows="5" placeholder="Contate o ofertante através dessa caixa de mensagem (*Obrigatório)"></textarea>
                </div>
                <div class="botoes-oferta-contatar">
                    <div>
                        <button type="submit">Enviar</button>
                    </div>
                    <div>
                        <span onclick="closeModalContatarOferta()" id="botao-fechar-modal-contatar"><button type="button">Voltar</button></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <!-- MODAL SUCESSO -->
    <div class="modal-sucesso-contatar" id="modal-sucesso">
        <div class="modal-conteudo-sucesso-contatar">
            <span class="fechar-modal-sucesso-contatar" onclick="fecharModalSucesso()">&times;</span>
            <h5 id="titulo-sucesso">Mensagem enviada com sucesso!</h5>
            <div id="mensagem-sucesso">
                <p>Visualize esta mensagem através do menu, na seção <strong>"CONTATOS REALIZADOS"</strong>.</p>
            </div>
        </div>
    </div>
    <!-- MODAL SUCESSO -->
</body>
</html>