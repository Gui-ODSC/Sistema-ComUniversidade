<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/cadastrar_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    @include('menu')
    <main class="cadastrar_demandas" id="conteudo">
        <h1>Novas Demandas</h1>
        <form action="{{ route('sucesso_cadastro_demanda') }}">
            <input type="text" name="titulo_demanda" placeholder="Titulo" required>
            <input type="text" name="publico_demanda" placeholder="Publico Alvo da Ação" required>
            <textarea type="text" name="texto_livre" placeholder="Texto Livre" required></textarea>
            <input type="text" name="pessoas_impactadas" placeholder="Aprox. Pessoas Impactadas" required>
            <input type="text" name="tipo_acao" placeholder="Tipo de Ação" required>
            <input type="text" name="prioridade" placeholder="Prioridade" required>
            <input type="text" name="area_conhecimento" placeholder="Área de Conhecimento" required>
            <input type="text" name="duracao" placeholder="Duracao" required>
            <input type="text" name="setor_instituicao" placeholder="Setor/Instituição" required>
            <button>Cadastrar</button>
        </form>
    </main>
</body>
</html>