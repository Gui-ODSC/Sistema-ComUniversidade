<!-- Menu do Sistema -->
<header class="barra-navegacao">
    <a href="#" class="btn-abrir" onclick="abrirMenu()">&#9776; Menu</a>
    <h1>Sistema ComUniversidade</h1>
    @if(Auth::user()->foto)
        <a title="Perfil" href="{{ route('perfil_index') }}"><img id="img-personalizada" src="{{ Storage::disk('s3-public')->url(Auth::user()->foto) }}" alt="imagem de perfil do usuario"></a>
    @else
        <a title="Perfil" href="{{ route('perfil_index') }}"><img src="{{ asset('img/icones/perfil.png') }}" alt="imagem de perfil do usuario"></a>
    @endif
</header>
<nav class="menu-navegacao" id="menu_navegacao" style="z-index: 5;">
    <a href="" onclick="fecharMenu()">&times; Fechar</a>
    <a href="{{ route('demanda_index') }}"><i><img src="{{ asset('img/menu/demanda.png') }}" id="icones-menu" alt="icone de demanda"></i>Minhas Necessidades</a>
    <a href="{{ route('list_todas_ofertas') }}"><i><img src="{{ asset('img/menu/setas.png') }}" id="icones-menu" alt="icone de oferta/demanda"></i>Todas as Ofertas</a>
    <a href="{{ route('list_contatos_realizados') }}"><i><img src="{{ asset('img/menu/contato_realizado.png') }}" id="icones-menu" alt="icone de contato"></i>Contatos Realizados</a>
    <a href="{{ route('list_contatos_recebidos') }}"><i><img src="{{ asset('img/menu/contato_recebido.png') }}" id="icones-menu" alt="icone de contato"></i>Contatos Recebidos</a>
    <a href="{{ route('configuracoes') }}"><i><img src="{{ asset('img/menu/configuracoes.png') }}" id="icones-menu" alt="icone de contato"></i>Configurações</a>
    <a href="{{ route('logout_membro_index') }}"><i><img src="{{ asset('img/menu/sair.png') }}" id="icones-menu" alt="icone de contato"></i>Sair</a>
</nav>