<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/configuracao_membro/sobre_nos.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('menu')
    <main class="sobre-nos" id="conteudo">
        <h1>Sobre Nós</h1>
        <hr>
        <div class="sessao">
            <h4>Qual o objetivo deste Sistema</h1>
            <p>É com o intuito de facilitar a interação entre a sociedade e universidade por meio de ações de extensão e propiciar a criação de soluções que estejam de fato alinhadas com as demandas de diversos setores da sociedade, que objetiva-se desenvolver um sistema web que permita que a inserção de demandas por parte desses setores, assim como a oferta de conhecimento especializados por parte da universidade.</p>
        </div>
        <hr>
        <div class="sessao">
            <h4>Justificativa</h1>
            <p>Tendo visto, a diminuição dos prazos e em contrapartida o aumento da preocupação das Universidades, em atender as diretrizes da Extensão Universitária mantendo os PPCs atualizados, sem que os projetos e ações extensivas, sejam realizados de qualquer forma, meramente para cumprir o mínimo percentual exigido pelas resoluções. A criação deste sistema, busca apoiar as IES, auxiliando-as no estabelecimento de relações mais próximas, entre universidade e sociedade, de modo que os projetos de extensão propostos pelas Instituições de Ensino possam apresentar relevância, não apenas para os currículos de curso, mas também para o atendimento das necessidades expressas por aqueles que estão fora dos muros da Universidade, proporcionando oportunidades efetivas de se produzir o verdadeiro conceito do fazer extensionista, o qual pode de fato modificar a realidade dos indivíduos pertencentes à sociedade.</p>
        </div>
        <hr>
        <div class="sessao">
            <h4>A importância da Extensão Universitária</h1>
            <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium amet, consequuntur explicabo ipsa sapiente optio dolorem molestiae, cupiditate corrupti suscipit sit voluptatibus laboriosam quod, vel consequatur porro quis vero nostrum.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium amet, consequuntur explicabo ipsa sapiente optio dolorem molestiae, cupiditate corrupti suscipit sit voluptatibus laboriosam quod, vel consequatur porro quis vero nostrum.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium amet, consequuntur explicabo ipsa sapiente optio dolorem molestiae, cupiditate corrupti suscipit sit voluptatibus laboriosam quod, vel consequatur porro quis vero nostrum.Lorem ipsum, dolor sit amet consectetur adipisicing elit. Laudantium amet, consequuntur explicabo ipsa sapiente optio dolorem molestiae, cupiditate corrupti suscipit sit voluptatibus laboriosam quod, vel consequatur porro quis vero nostrum.</p>
        </div>
    </main>
</body>
</html>