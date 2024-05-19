<!-- Menu do Sistema -->
<header class="barra-navegacao">
    <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Abrir</a>
    <h1>Extensao Universitaria</h1>
    @if(Auth::user()->foto)
        <a href="{{ route('perfil_index_professor') }}"><img id="img-personalizada" src="{{ url('storage/' . Auth::user()->foto) }}" alt="imagem de perfil do usuario"></a>
    @else
        <a href="{{ route('perfil_index_professor') }}"><img src="{{ asset('img/icones/perfil.png') }}" alt="imagem de perfil do usuario"></a>
    @endif
</header>
<nav class="menu-navegacao" id="menu_navegacao" style="z-index: 5;">
    <a href="" onclick="fecharMenu()">&times; Fechar</a>
    <a href="{{ route('oferta_index') }}"><i><img src="{{ asset('img/menu/oferta.png') }}" id="icones-menu" alt="icone de demanda"></i>Minhas Ofertas</a>
    <a href="{{ route('lista_todas_demandas') }}"><i><img src="{{ asset('img/menu/setas.png') }}" id="icones-menu" alt="icone de oferta/demanda"></i>Todas as Necessidades</a>
    <a href="{{ route('lista_contatos_realizados_professor') }}"><i><img src="{{ asset('img/menu/contato_realizado.png') }}" id="icones-menu" alt="icone de contato"></i>Contatos Realizados</a>
    <a href="{{ route('lista_contatos_recebidos_professor') }}"><i><img src="{{ asset('img/menu/contato_recebido.png') }}" id="icones-menu" alt="icone de contato"></i>Contatos Recebidos</a>
    <a href="{{ route('configuracoes_professor') }}"><i><img src="{{ asset('img/menu/configuracoes.png') }}" id="icones-menu" alt="icone de contato"></i>Configurações</a>
    <a href="{{ route('logout_professor_index') }}"><i><img src="{{ asset('img/menu/sair.png') }}" id="icones-menu" alt="icone de contato"></i>Sair</a>
</nav>