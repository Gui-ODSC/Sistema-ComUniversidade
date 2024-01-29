<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/cadastrar_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Editar Demanda</title>
</head>
<body>
    @include('menu')
    <main class="cadastrar_demandas" id="conteudo">
        <h1>Editar Demanda</h1>
        <form action="{{ route('sucesso_edicao_demanda') }}">
            <input type="text" name="titulo_demanda" value="Titulo" required>
            <input type="text" name="publico_demanda" value="Publico Alvo da Ação" required>
            <textarea type="text" name="texto_livre" value="Texto Livre" required></textarea>
            <input type="text" name="pessoas_impactadas" value="Aprox. Pessoas Impactadas" required>
            <input type="text" name="tipo_acao" value="Tipo de Ação" required>
            <input type="text" name="prioridade" value="Prioridade" required>
            <input type="text" name="area_conhecimento" value="Área de Conhecimento" required>
            <input type="text" name="duracao" value="Duracao" required>
            <input type="text" name="setor_instituicao" value="Setor/Instituição" required>
            <button>Editar</button>
        </form>
    </main>
</body>
</html>