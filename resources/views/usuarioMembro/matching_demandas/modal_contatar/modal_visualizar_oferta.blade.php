<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/matching_demandas/modal_contatar/modal_visualizar_oferta.css') }}">
    <script src="{{ asset('js/usuarioMembro/matching_demandas/modal_contatar_oferta.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <!-- MODAL -->
    <div class="clicar-fora-modal-visualizar" id="clicar-fora-modal-visualizar" onclick="closeModalVisualizarOferta()"></div>
        <div class="modal-visualizar" id="modal-visualizar">
            <div class="dados-oferta">
                <div class="dados-usuario-professor">
                    <div class="informacao-professor">
                        <h2>Arnaldo Silveira</h2>
                        <hr>
                        <h6>Cargo: Professor</h6>
                        <h6>Instituição: UFSC</h6>
                        <h6>Tipo Oferta: Ação</h6>
                    </div>
                    <div class="informacao-email">
                        <h4>Contatos Email</h4>
                        <h6>arnaldo_sil@gmail.com</h6>
                        <h6>arnaldo_sil@gmail.com</h6>
                    </div>
                </div>
                <div class="informacao-oferta">
                    <h2>Título: Projeto de MySQL no Ensino Médio</h2>
                    <h6>Público Alvo: Alunos Ensino Médio</h6>
                    <h6 id="data">Ofertado em: 22/12/2023</h6>
                    <h6>Duração: Anos</h6>
                    <h6>Nº Pessoas Impactadas: Aprox. 200</h6>
                    <h6>Área de Conhecimento: Educação</h6>
                </div>
            </div>
            <div class="descricao-oferta">
                <h6>Descricao Oferta:</h6>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit. Ipsam est nisi quidem tenetur nesciunt autem corporis velit necessitatibus sapiente sed cupiditate pariatur animi laboriosam repellendus, dicta molestias ad officiis. Dicta.Lorem ipsum dolor sit amet consectetur adipisicing elit.</p>
            </div>
            <div class="botoes-oferta">
                <div>
                    <a onclick="openModalContatarOferta()"><button>Contatar<img id="icone-telefone" src="{{ asset('img/usuarioMembro/visualizar_matching_demandas/modal_contatar/telefone_contato.png') }}" alt=""></button></a>
                </div>
                <div>
                    <span onclick="closeModalVisualizarOferta()" id="botao-fechar-modal"><button>Fechar</button></span>
                </div>
            </div>
        </div>
    </div>
    <!-- MODAL -->
    <!-- MODAL CONTATAR -->
    @include('usuarioMembro/matching_demandas/modal_contatar/modal_contatar_oferta')
    <!-- MODAL CONTATAR -->
</body>
</html>