<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/contatos_efetuados_membro/demanda_atendida.css') }}">
    <script src="{{ asset('js/menu_navegacao.js') }}"></script>
    <script src="{{ asset('js/contato_efetuado_membro/modal.js') }}"></script>
    <title>Minhas Demandas</title>
</head>
<body>
    <h1>Teste</h1>
    <p>Lorem ipsum, dolor sit amet consectetur adipisicing elit. Necessitatibus, mollitia aperiam dolorem ratione ducimus quis nobis voluptatum accusamus velit, debitis nisi voluptas, rem sint eum a adipisci enim aut culpa?Lorem ipsum dolor, sit amet consectetur adipisicing elit. Tenetur, distinctio itaque! Architecto excepturi incidunt quia eum illo nobis accusamus voluptatum tempore cumque repellendus officiis dignissimos quidem, ducimus temporibus nisi fugit. Lorem ipsum dolor sit amet, consectetur adipisicing elit. Molestiae sit illo harum eligendi soluta modi praesentium hic blanditiis, voluptates quo? Distinctio aliquam eius laudantium officiis reiciendis voluptatibus hic error deserunt.</p>
    
    <!-- Botão com três pontinhos -->
    <span class="more-info-button" onclick="openModal()">...</span>

    <!-- Modal -->
    <div class="overlay" id="overlay" onclick="closeModal()"></div>
    <div class="caixa-modal" id="caixa-modal">
    <!-- Conteúdo do modal -->
    <p>Informações detalhadas aqui.</p>
    <!-- Botão para fechar o modal -->
    <span onclick="closeModal()">Fechar [X]</span>
    </div>

</body>
</html>