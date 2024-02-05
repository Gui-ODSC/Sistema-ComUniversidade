<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_recebidos/modal_visualizar_contato_recebido.css') }}">
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/validacao_mensagem_resposta.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_interessado_contato_recebido.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/contatos_recebidos/modal_nao_interessado_contato_recebido.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Recebidos</title>
</head>
<body>
    <!-- MODAL -->
    <div class="modal-visualizar" id="modal-visualizar">
        <div class="dados-oferta">
            <div class="dados-usuario-professor">
                <div class="informacao-professor">
                    <div id="foto-nome">
                        <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="">
                        <h2>Arnaldo Silveira</h2>
                    </div>
                    <div id="dados-professor">
                        <hr>
                        <h6>Cargo: Professor</h6>
                        <h6>Instituição: UFSC</h6>
                        <h6>Tipo Oferta: Ação</h6>
                    </div>
                </div>
                <div class="info-criador-interessado">
                    <h6>Criador(a) da Demanda: Guilhemre Oliveira</h6>
                    <h6>Interessado(a) na Demanda: Arnaldo Silveira</h6>
                </div>
                <div class="informacao-email">
                    <h4>Contatos Email</h4>
                    <h6>arnaldo_sil@gmail.com</h6>
                    <h6>arnaldo_sil@gmail.com</h6>
                </div>
            </div>
            <div class="informacao-oferta">
                <h5 id="dados-demanda">Dados Demanda:</h5>
                <div id="titulo-data-oferta">
                    <h2>Título: Projeto de MySQL no Ensino Médio</h2>
                    <h6 id="data">Ofertado em: 22/12/2023</h6>
                </div>
                <div id="dados-informacao-oferta">
                    <h6>Público Alvo: Alunos Ensino Médio</h6>
                    <h6>Duração: Anos</h6>
                    <h6>Nº Pessoas Impactadas: Aprox. 200</h6>
                    <h6>Área de Conhecimento: Educação</h6>
                    <h6>Status: <img src="{{ asset('img/usuarioMembro/contatos_recebidos/status_recebido.png') }}" alt="">Contato Recebido</h6>
                </div>
            </div>
        </div>
        <div class="descricao-oferta">
            <h6>Mensagem Recebida (Arnaldo Silveira)</h6>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
        </div>
        <div class='resposta-contato-recebido'>
            <form id="form-contato" onsubmit="return validarEnviarFormulario()">
                <h6>Responder:</h6>
                <textarea name="mensagem-contato" id="mensagem-contato" cols="134" rows="5" placeholder="Existe alguém interessado em sua demanda, responda aqui (*Obrigatório)" oninput="habilitarBotoes()"></textarea>
            </div>
            <div class="botoes-oferta">
                <div>
                    <a onclick="openModalConfirmaInteresse()">
                        <button type="button" id="botao-interessado" disabled>Interessado</button>
                    </a>
                    <a onclick="openModalConfirmaDesinteresse()">
                        <button type="button" id="botao-nao-interessado" disabled>Não Interessado</button>
                    </a>
                </div>
            </form>
                <div>
                    <span onclick="closeModalVisualizarContatoRecebido()" id="botao-fechar-modal"><button>Fechar</button></span>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <!-- MODAL CONFIRMAR INTERESSE -->
    @include('usuarioMembro/contatos_recebidos/modal_interessado_contato_recebido')
    <!-- MODAL CONFIRMAR INTERESSE -->

    <!-- MODAL CONFIRMAR DESINTERESSE -->
    @include('usuarioMembro/contatos_recebidos/modal_nao_interessado_contato_recebido')
    <!-- MODAL CONFIRMAR DESINTERESSE -->
</body>
</html>