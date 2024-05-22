<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/configuracao/ajuda_sistema.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    <title>Configurações</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main class="ajuda-sistema" id="conteudo">
        <h1>Ajuda do Sistema</h1>
        <div class="sessao">
            <h4>Como o Sistema está estruturado?</h4>
            <p>Este sistema foi desenvolvido para conectar os usuários de maneira eficaz e precisa, promovendo uma rede de colaboração eficiente, onde os usuários podem resolver problemas e oferecer suporte uns aos outros. A estrutura do sistema é dividida em várias seções, conforme descrito a seguir:<br>
            Ao entrar no sistema, a primeira seção visível será "Todas as Ofertas Disponíveis", onde você pode visualizar todas as ofertas cadastradas por outros usuários, e fazer contatos com os mesmos de acordo com seus interesses e objetivos. Além disso, também existe uma seção de Contatos, destinada a troca de mensagens, onde você usuário pode ver todos os seus contato Realizados e as respectivas respostar recebidas para cada contato.
            </p>
        </div>
        <hr>
        <div class="sessao">
            <h4>Como posso realizar um contato?</h4>
            <p>Os contatos do sistema sempre estão relacionados a uma oferta. Portanto, para que você, usuário, consiga fazer um contato, basta você acessar a seção de "Todas as Ofertas", onde estão listadas as ofertas cadastradas pelos professores das universidades. Ao acessar uma essa seção, você poderá selecionar a oferta que melhor atende às seus interesses, escrever sua mensagem e depois enviar. Após isso, seus contatos estarão disponíveis na seção de "Contatos Realizados". Lá, você verá o status do seu contato, que inicialmente será "Contato Enviado", e assim que for respondido, será atualizado. 
            Uma explicação mais detalhada de cada status referente a um contato está disponível no card abaixo.</p>
        </div>
        <hr>
        <div class="sessao">
            <h4>Como funciona os status dos contatos?</h4>
            <p>Os status presentes para os contatos, sejam eles Recebidos ou Realizados, funcionam da mesma forma e servem para facilitar a visualização de você usuário. Os status apresentados pelo sistema são:<br></p>
            <div style="line-height: 30px">
                <p>
                    <span style="color: black; background-color: yellow">"Contato Enviado"</span> (Cor Amarela), indica que o contato foi enviado e que aguarda resposta da pessoa que foi contatada.<br>
                    <span style="color: #FFF; background-color: blue">"Contato Respondido"</span> (Cor Azul), indica que o contato foi respondido por um professor(a) de uma determinada universidade.<br>
                </p>
            </div>
        </div>
        <hr>
        <div class="sessao">
            <h4>Posso trocar mensagens de maneira ilimitadas sobre uma mesma oferta ?</h4>
            <p>Não, o intuito do sistema é conectar usuários que possuem necessidade e ofertas condizentes, para que problemas possam ser resolvidos de maneira rápida e eficiente. Dito isso, nosso objetivo é apenas gerar um primeiro contato entre as partes de modo que elas consigam se interconectar e posteriormente, por meio de outras formas de contato, elas venha a desenvolver propriamente suas soluções. Por isso, nós permitimos que os usuários façam apenas uma troca de mensagens para cada contato criado. Ou seja cada vez que algumas dos usuários inicia o contato o outro que recebe tem o direito de resposta, e então o contato é finalizado não havendo possibilidade de uma terceira mensagem. Apesar disso, é possível fazer quantos contatos quiser, desde que seja sobre ofertas diferentes.</p>
        </div>
        <hr>
        <div class="sessao">
            <h4>Caso eu exclua uma oferta da lista de Ofertas, é possível recuperar?</h4>
            <p>Não, o sistema não possui uma seção destinada a listagem das ofertas excluidas, portanto caso uma oferta seja excluida, ela não poderá ser recuperada. Mas para evitar exclusões acidentais o sistema foi estruturado com avisos de confirmação para todas as ações de excluir, desse modo, caso você clique sem querer no botão de excluir, será necessário realizar a confirmação de SIM ou NÃO antes que a ação seja executada. Evitando problemas de exclusão.</p>
        </div>
    </main>
</body>
</html>