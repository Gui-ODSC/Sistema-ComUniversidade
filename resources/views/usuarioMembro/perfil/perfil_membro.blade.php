<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/perfil/perfil_membro.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <title>Perfil</title>
</head>
<body> 
    @include('menu')
    <main class="perfil" id="conteudo">
            <a href="{{ route('perfil_edit_index', $usuario->id_usuario) }}"><button type="submit">Editar</button></a>
            @if( session()->has('perfil-update'))
                <div class="alert alert-success" style="text-align: center">
                    <p>{{session('perfil-update')}}</p>
                </div>
            @endif
            <div id="container">
                <img src="{{ asset('img/foto_usuario_perfil/perfil_foto.jpeg') }}" alt="foto perfil" id="imagem" style="cursor: auto">
                {{-- <input type="file" id="arquivo" accept=".jpg, .jpeg, .png" onchange="mostrarImagem()"> --}}
            </div>
            <h1>Perfil</h1>
            <div class="cadastro-container">
                <input type="text" id="nome" name="nome" value="{{ $usuario->nome }}" placeholder="Nome" readonly required style="outline: none">
                <input type="text" id="nascimento" name="nascimento" value="{{ $nascimentoFormat }}" placeholder="Nascimento" readonly required style="outline: none">
                <input type="text" id="sobrenome" name="sobrenome" value="{{ $usuario->sobrenome }}" placeholder="Sobrenome" readonly required style="outline: none">
                <input type="email" id="email" name="email" value="{{ $usuario->email }}" placeholder="Email" readonly required style="outline: none">
                <input type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario }}" placeholder="Email Secundario" readonly required style="outline: none">
                <input type="tel" id="telefone" name="telefone" pattern="[0-9]{10}" value="{{ $usuario->telefone }}" placeholder="Telefone" readonly required style="outline: none">
                <input type="text" id="cidade" name="cidade" value="{{ $cidade->nome }}" placeholder="Cidade" readonly required style="outline: none">
                <input type="text" id="estado" name="estado" value="{{ $estado->nome }}" placeholder="Estado" readonly required style="outline: none">
                <input type="text" id="bairro" name="bairro" value="{{ $bairro->nome }}" placeholder="Bairro" readonly required style="outline: none">
                <input type="number" id="numero" name="numero" value="{{ $endereco->numero }}" placeholder="Número" readonly required style="outline: none">
                <input type="text" id="complemento" name="complemento" value="{{ $endereco->complemento }}" placeholder="Complemento" style="outline: none" readonly>
                <input type="text" id="rua" name="rua" value="{{ $endereco->rua }}" placeholder="Rua" readonly required style="outline: none">
            </div>
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>   
    <script>
        // Aplica a máscara de telefone usando Inputmask
        $(document).ready(function(){
            $('#telefone').inputmask('(99) 99999-9999');
        });
    
        // Aplica a máscara de data usando Inputmask
        $(document).ready(function(){
            $('#nascimento').inputmask('99/99/9999');
        });
    </script>
</body>
</html>