<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_realizados/modal_visualizar_contato_realizado.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-visualizar-contato-realizado" id="clicar-fora-modal-visualizar-contato-realizado" onclick="closeModalVisualizarContatoRealizado()"></div>
        <div class="modal-visualizar-contato-realizado" id="modal-visualizar-contato-realizado">
            <div class="dados-oferta-contato-respondido">
                <div class="dados-usuario-professor-contato-respondido">
                    <div class="informacao-professor-contato-respondido">
                        <div id="foto-nome-contato-respondido">
                            <img src="{{ asset('img/usuarioMembro/contatos_recebidos/perfil.png') }}" alt="">
                            <h2>Contatos Realizados</h2>
                        </div>
                        <div id="dados-professor-contato-respondido">
                            <hr>
                            <h6>Cargo: Professor</h6>
                            <h6>Instituição: UFSC</h6>
                            <h6>Tipo Oferta: Ação</h6>
                        </div>
                    </div>
                    <div class="info-criador-interessado-contato-respondido">
                        <h6>Criador(a) da Demanda: Guilhemre Oliveira</h6>
                        <h6>Interessado(a) na Demanda: Arnaldo Silveira</h6>
                    </div>
                    <div class="informacao-email-contato-respondido">
                        <h4>Contatos Email</h4>
                        <h6>arnaldo_sil@gmail.com</h6>
                        <h6>arnaldo_sil@gmail.com</h6>
                    </div>
                </div>
                <div class="informacao-oferta-contato-respondido">
                    <h5>Dados Demanda:</h5>
                    <div id="titulo-data-oferta-contato-respondido">
                        <h2>Título: Projeto de MySQL no Ensino Médio</h2>
                        <h6 id="data">Ofertado em: 22/12/2023</h6>
                    </div>
                    <div id="dados-informacao-oferta-contato-respondido">
                        <h6>Público Alvo: Alunos Ensino Médio</h6>
                        <h6>Duração: Anos</h6>
                        <h6>Nº Pessoas Impactadas: Aprox. 200</h6>
                        <h6>Área de Conhecimento: Educação</h6>
                        <h6>Status: <img src="{{ asset('img/usuarioMembro/contatos_realizados/status_realizado.png') }}" alt="">Contato Realizado</h6>
                    </div>
                </div>
            </div>
            <div class='resposta-realizada'>
                <h6>Mensagem Enviada (Guilherme Oliveira)</h6>
                <p>Sou membro da sociedade estou interessado nesta oferta de conhecimento...</p>
            </div>
            <div class="botoes-oferta-respondido">
                <div>
                    <span onclick="closeModalVisualizarContatoRealizado()" id="botao-fechar-contato-respondido"><button>Fechar</button></span>
                </div>
            </div>
        </div>
</body>
</html>