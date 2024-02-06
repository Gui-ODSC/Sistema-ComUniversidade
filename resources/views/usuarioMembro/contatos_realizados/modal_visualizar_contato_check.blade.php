<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsu41UCVHSx3lQQCM9ZX5RQ5JZcH9pMMzqG4IfcEgL3WpnAHI9eUyRvdgpNY3rJ" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/contatos_realizados/modal_visualizar_contato_check.css') }}">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Contatos Realizados</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-visualizar-contato-check" id="clicar-fora-modal-visualizar-contato-check" onclick="closeModalVisualizarContatoRealizadoCheck()"></div>
        <div class="modal-visualizar-contato-check" id="modal-visualizar-contato-check">
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
                        <h6>Status: <img src="{{ asset('img/usuarioMembro/contatos_realizados/status_check.png') }}" alt="">Contato Realizado</h6>
                    </div>
                </div>
            </div>
            <div class="mensagem-contato-recebido">
                    <div id="abrir-fechar-mensagem">
                        <h6>Mensagem Enviada</h6>
                        <button class="btn btn-primary" id="botao-abrir-mensagem" type="button" data-bs-toggle="collapse" data-bs-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample">
                            <img src="{{ asset('img/usuarioMembro/contatos_recebidos/seta.png') }}" alt="">
                        </button>
                    </div>
                <div class="collapse" id="collapseExample">
                    <div id="texto">
                        Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger. Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger. Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger. Some placeholder content for the collapse component. This panel is hidden by default but revealed when the user activates the relevant trigger.
                    </div>
                </div>
            </div>
            <div class='resposta-realizada'>
                <h6>Resposta (Arnaldo Silveira)</h6>
                <p>Notei seu interesse no meu conhecimento e estou sem dúvida interessado em sua demanda..
                <br><br><br>Independentemente do conteúdo apresentado acima, o sistema entende que o contato incial já foi realizado entre as partes interessadas, portanto qualquer próxima forma de contato deve seguir por meio de outro sistema de contato (email, telefone ....)</p>
            </div>
            <div class="botoes-oferta-respondido">
                <div>
                    <span onclick="closeModalVisualizarContatoRealizadoCheck()" id="botao-fechar-contato-respondido"><button>Fechar</button></span>
                </div>
            </div>
        </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js" integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+" crossorigin="anonymous"></script>
</body>
</html>