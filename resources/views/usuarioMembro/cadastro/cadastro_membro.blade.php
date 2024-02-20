<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/cadastro/cadastro_membro.css') }}">
    <link rel="stylesheet" href="{{ asset('js/usuarioMembro/cadastro/digita_completa/opcoes.js')}}">

    
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>


    <title>Cadastro de Membros</title>
</head>
<header>
    <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav>
</header>
<body>
    <div class="cadastro-container">
        <form method="POST" action="{{ route('cadastro_create') }}">
            @csrf
            <h1>Cadastro Membro</h1>
            <h4>Seja bem vindo(a)</h2>
            @if($errors->has('dados'))
                <div class="msg-erro" id="error-message-email">
                    @foreach ($errors->get('dados') as $dado)
                        <p style="display: flex width: 651px">{{ $dado }}</p>
                        <br>
                    @endforeach
                </div>
                <script src="{{ asset('js/usuarioMembro/login_membro/mensagem_erro.js') }}"></script>
            @endif

            {{-- NOME --}}
            @error('nome')
                <input title="{{ $message }}" class="alert-danger" type="text" id="nome" name="nome" value="Guilherme" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Nome *" required>
            @else
                <input type="text" id="nome" name="nome" value="Guilherme" placeholder="Nome *" required>
            @enderror

            {{-- NASCIMENTO --}}
            @error('nascimento')
                <input title="{{ $message }}" class="alert-danger" type="text" id="nascimento" name="nascimento" value="15/03/2003" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Ex: 01/01/2023 *" required>
            @else
                <input type="text" id="nascimento" name="nascimento" value="15/03/2003" placeholder="Ex: 01/01/2023 *" required>
            @enderror

            {{-- SOBRENOME --}}
            @error('sobrenome')
                <input title="{{ $message }}" class="alert-danger" type="text" id="sobrenome" name="sobrenome" value="Oliveira" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Sobrenome *" required>
            @else
                <input type="text" id="sobrenome" name="sobrenome" value="Oliveira" placeholder="Sobrenome *" required>
            @enderror

            {{-- EMAIL --}}
            @error('email')
                <input title="{{ $message }}" class="alert-danger" type="text" id="email" name="email" value="gui@gmail.com" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Email *" required>
            @else
                <input type="email" id="email" name="email" value="gui@gmail.com" placeholder="Email *" required>
            @enderror

            {{-- EMAIL_SECUNDARIO --}}
            @error('email_secundario')
                <input title="{{ $message }}" class="alert-danger" type="email" id="email_secundario" name="email_secundario" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Email Secundario">
            @else
                <input type="email" id="email_secundario" name="email_secundario" placeholder="Email Secundario">
            @enderror

            {{-- PASSWORD --}}
            @error('password')
                <input title="{{ $message }}" class="alert-danger" type="password" id="password" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Senha *" required>
            @else
                <input type="password" id="password" name="password" value="ddddd" placeholder="Senha *" required>
            @enderror

            {{-- TELEFONE --}}
            @error('telefone')
                <input title="{{ $message }}" class="alert-danger" type="text" id="telefone" name="telefone" value="(11) 94363-4828" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Ex: (99) 9999-9999 *" required>
            @else
                <input type="text" id="telefone" name="telefone" value="(11) 94363-4828" placeholder="Ex: (99) 9999-9999 *" required>
            @enderror
            
            {{-- CIDADE --}}
            @error('cidade')
                <select title="{{ $message }}" id="cidade" name="id_cidade" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                    <option value="" disabled selected hidden>Selecione a cidade *</option>
                    @foreach ($cidades as $cidade)
                        <option selected value="{{ $cidade->id_cidade }}">{{ $cidade->nome }}</option>
                    @endforeach
                </select>
            @else
                <select id="cidade" name="id_cidade" required>
                    <option value="" disabled selected hidden>Selecione a cidade *</option>
                    @foreach ($cidades as $cidade)
                        <option selected value="{{ $cidade->id_cidade }}">{{ $cidade->nome }}</option>
                    @endforeach
                </select>
            @enderror

            {{-- RUA --}}
            @error('rua')
                <input title="{{ $message }}" class="alert-danger" type="text" id="rua" name="rua" value="ffff" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Rua *" required>
            @else
                <input type="text" id="rua" name="rua" value="ffff" placeholder="Rua *" required>
            @enderror

            {{-- NUMERO --}}
            @error('numero')
                <input title="{{ $message }}" class="alert-danger" type="number" id="numero" name="numero" value="2222" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Numero *" required>
            @else
                <input type="number" id="numero" name="numero" value="2222" placeholder="Numero *" required>
            @enderror

            {{-- COMPLEMENTO --}}
            @error('complemento')
                <input title="{{ $message }}" class="alert-danger" type="text" id="complemento" name="complemento" style="border: 1px solid red; background-color:rgb(235, 201, 206)" placeholder="Complemento">
            @else
                <input type="text" id="complemento" name="complemento" placeholder="Complemento">
            @enderror

            {{-- ESTADO --}}
            @error('estado')
                <select title="{{ $message }}" id="estado" name="id_estado" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                    <option value="" disabled selected hidden>Selecione o estado *</option>
                    @foreach ($estados as $estado)
                        <option selected value="{{ $estado->id_estado }}">{{ $estado->nome }}</option>
                    @endforeach
                </select>
            @else
                <select  id="estado" name="id_estado" required>
                    <option value="" disabled selected hidden>Selecione o estado *</option>
                    @foreach ($estados as $estado)
                        <option selected value="{{ $estado->id_estado }}">{{ $estado->nome }}</option>
                    @endforeach
                </select>
            @enderror

            {{-- BAIRRO --}}
            @error('bairro')
                <select title="{{ $message }}" id="bairro" name="id_bairro" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                    <option value="" disabled selected hidden>Selecione o bairro *</option>
                    @foreach ($bairros as $bairro)
                        <option selected value="{{ $bairro->id_bairro }}">{{ $bairro->nome }}</option>
                    @endforeach
                </select>
            @else
                <select id="bairro" name="id_bairro" required>
                    <option value="" disabled selected hidden>Selecione o bairro *</option>
                    @foreach ($bairros as $bairro)
                        <option selected value="{{ $bairro->id_bairro }}">{{ $bairro->nome }}</option>
                    @endforeach
                </select>
            @enderror

            {{-- FOTO --}}
            @error('foto')
                <label title="{{ $message }}" for="foto" class="custom-file-upload" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
                    <input type="file" id="foto" name="foto" style="display:none">
                    Adicionar Foto Perfil
                </label>
            @else
                <label for="foto" class="custom-file-upload">
                    <input type="file" id="foto" name="foto" style="display:none">
                    Adicionar Foto Perfil
                </label>
            @enderror
            <div class="aviso-campo-obrigatorio">
                <p>* Campos obrigatórios</p>
            </div>
            <button type="submit">Cadastrar</button>
        <form>
    </div>
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


