<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/home.css')}}">
    <title>Comuniversidade</title>
</head>
<body>
    <header>
        <nav>
            <div class="nav-data">
                <div class="nav-left">
                    <img src="{{asset('img/home/logo-ufsc.png')}}">
                    <h4>Comuniversidade</h4>
                </div>
                <div class="nav-right">
                    <h4><a href="#home">Home</a></h4>
                    <h4><a href="#perfis">Perfis</a></h4>
                    <h4><a href="#beneficios">Benefícios</a></h4>
                    <h4 id="botao-acesso"><a href="{{route('selecao_perfil')}}">Acessar</a></h4>
                </div>
            </div>
        </nav>
    </header>
    <main>
        <div class="secao" id="home" style="padding-top: 110px">
            <h1>Sistema Comuniversidade</h1>
            <span>
                <p>Acreditando no poder transformador da extensão universitária para promover o desenvolvimento comunitário e enriquecer a educação superior. O sistema <strong>Comuniversidade</strong> foi desenvolvido com o intuito de conectar as comunidades locais com as universidades através de uma plataforma de ofertas e demandas, facilitando a colaboração e o intercâmbio de conhecimentos e recursos.</p>
            </span>
            <div class="ilustracao">
                <div>
                    <img src="{{asset('img/home/universidade_comunidade/comunidade.png')}}" alt="">
                    <span>
                        <p>Comunidade</p>
                    </span>
                </div>
                <div>
                    <img src="{{asset('img/home/universidade_comunidade/seta_esquerda.png')}}" alt="">
                    <img src="{{asset('img/home/universidade_comunidade/seta_direita.png')}}" alt="">
                </div>
                <div>
                    <img src="{{asset('img/home/universidade_comunidade/universidade.png')}}" alt="">
                    <span>
                        <p>Universidade</p>
                    </span>
                </div>
            </div>
            <span>
                <p>
                    O sistema oferece uma interface amigável e intuitiva que permite tanto às comunidades quanto às universidades identificarem oportunidades de parceria de forma rápida e eficiente. Com o <strong>Comuniversidade</strong>, cada usuário pode criar um perfil personalizado que se adapta às suas necessidades e interesses específicos. O sistema pode ser usado por três tipos de perfil.
                </p>
            </span>
        </div>
        <hr>
        <div class="secao" id="perfis">
            <h1>Tipos de Perfis</h1>
            <span>
                <p>A segmentação de perfis permite uma experiência personalizada para cada tipo de usuário, facilitando a identificação e a conexão entre as partes interessadas. Seja você uma comunidade em busca de soluções práticas ou uma universidade em busca de oportunidades de engajamento social, o <strong>Comuniversidade</strong> oferece as ferramentas necessárias para transformar ideias em ações concretas e impactar positivamente o mundo ao seu redor.</p>
            </span>
            <div class="prints-sistema">
                <div class="tela-print">
                    <img src="{{asset('img/home/telas_usuario/tela_estudante.png')}}" alt="">
                    <span>
                        <h4>Estudantes</h4>
                        <p>Estudantes universitários podem criar um perfil que enfatiza seus interesses acadêmicos facilitando sua participação em ações de extensão. </p>
                    </span>
                </div>
                <div class="tela-print">
                    <img src="{{asset('img/home/telas_usuario/tela_professor.png')}}" alt="">
                    <span>
                        <h4>Servidores (Professores e TAES)</h4>
                        <p>Professores, pesquisadores universitários e técnicos podem criar um perfil que destaca suas competências, áreas de pesquisa e ações de extensão. </p>
                    </span>
                </div>
                <div class="tela-print">
                    <img src="{{asset('img/home/telas_usuario/tela_membro_externo.png')}}" alt="">
                    <span>
                        <h4>Membros Externos</h4>
                        <p>As organizações, empresas e indivíduos da comunidade podem criar um perfil detalhado que descreve suas necessidades, objetivos e áreas de interesse.</p>
                    </span>
                </div>
            </div>
        </div>
        <hr>
        <div class="secao-footer" id="beneficios">
            <h1>Benefícios</h1>
            <span>
                <p>
                    Alguns benefícios da utilização deste sistema.
                </p>
            </span>
            <div class="beneficios">
                <div class="beneficios-universidade">
                    <div>
                        <h2>Benefícios para a Universidade</h2>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/home/beneficios-universidade/conhecimento.png')}}" alt="">
                        <span>
                            <p>Aplicação Prática do Conhecimento</p>
                        </span>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/home/beneficios-universidade/inovacao.png')}}" alt="">
                        <span>
                            <p>Pesquisa e Inovação</p>
                        </span>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/home/beneficios-universidade/social.png')}}" alt="">
                        <span>
                            <p>Responsabilidade Social</p>
                        </span>
                    </div>
                </div>
                <div class="beneficios-comunidade">
                    <div>
                        <h2>Benefícios para a Comunidade</h2>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/home/beneficios-comunidade/conhecimento.png')}}" alt="">
                        <span>
                            <p>Acesso ao Conhecimento</p>
                        </span>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/home/beneficios-comunidade/solidariedade.png')}}" alt="">
                        <span>
                            <p>Cooperação e Solidariedade</p>
                        </span>
                    </div>
                    <div class="item">
                        <img src="{{asset('img/home/beneficios-comunidade/apoio.png')}}" alt="">
                        <span>
                            <p>Apoio em projetos locais</p>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <footer>
            <div class="footer">
                <div class="dados-curso">
                    <h5>© 2024 UFSC, Araranguá</h5>
                    <h6>Tecnologia da Informação e Comunicação</h6>
                    <h6>Guilherme Oliveira de Sá Cabrera</h6>
                </div>
            </div>
        </footer>
    </main>
    <script>
        document.querySelectorAll('a[href^="#"]').forEach(anchor => {
            anchor.addEventListener('click', function(e) {
                e.preventDefault();

                document.querySelector(this.getAttribute('href')).scrollIntoView({
                    behavior: 'smooth'
                });
            });
        });
    </script>
</body>
</html> 