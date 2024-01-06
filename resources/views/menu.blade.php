<!-- Menu do Sistema -->

<header class="barra-navegacao">
    <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Abrir</a>
    <h1>Extensao Universitaria</h1>
    <a href="{{ route('perfil') }}"><img src="{{ asset('img/icones/perfil.png') }}" alt="imagem de perfil do usuario"></a>
</header>
<nav class="menu-navegacao" id="menu_navegacao">
    <a href="#" onclick="fecharMenu()">&times; Fechar</a>
    <a href="{{ route('minhas_ofertas') }}">Minhas Ofertas</a>
    <a href="{{ route('minhas_demandas') }}">Minhas Demandas</a>
    <a href="{{ route('demandas_ofertas') }}">Ofertas/Demandas</a>
    <a href="{{ route('todos_contatos') }}">Contatos</a>
    <a href="{{ route('configuracoes') }}">Configurações</a>
    <a href="{{ route('perfil') }}">Perfil</a>
    <a href="{{ route('sair') }}">Sair</a>
</nav>