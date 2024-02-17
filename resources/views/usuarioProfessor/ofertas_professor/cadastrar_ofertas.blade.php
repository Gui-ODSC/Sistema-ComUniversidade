<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/ofertas_membro/cadastrar_ofertas.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <title>Cadastrar Ofertas</title>
</head>
<body>
    @include('menu')
    <main class="cadastrar_ofertas" id="conteudo">
        <h1>Novas Ofertas</h1>
        <form action="{{ route('sucesso_cadastro_oferta') }}">
            <input type="text" name="titulo_oferta" placeholder="Titulo" required>
            <input type="text" name="publico_oferta" placeholder="Publico Alvo da Ação" required>
            <textarea type="text" name="ideia_oferta" placeholder="Ideia de Oferta" required></textarea>
            <input type="text" name="area_conhecimento" placeholder="Área de Conhecimento" required>
            <input type="text" name="tipo_acao" placeholder="Tipo de Ação" required><br>
            <button>Cadastrar</button>
        </form>
    </main>
</body>
</html>