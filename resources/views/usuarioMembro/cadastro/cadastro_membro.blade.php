<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/cadastro/cadastro_membro.css') }}">

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    {{-- Autocomplete.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
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
    <div class="botao-voltar">
        <a title="Voltar" href="{{ route('login_membro_index') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
    </div>
    <div class="cadastro-container">
        <div class="titulo">
            <h1>Cadastro Membro</h1>
            <h4>Seja bem vindo(a)</h2>
        </div>
        <form method="POST" action="{{ route('cadastro_create') }}">
            @csrf
            @if($errors->has('dados'))
                <div class="msg-erro" id="error-message-email" style="margin-top: 30px">
                    @foreach ($errors->get('dados') as $dado)
                        <p style="display: block; align-items: center; width: 100%;">{{ $dado }}</p>
                        <br>
                    @endforeach
                </div>
            @endif
            <div class="section-form">
                {{-- NOME --}}
                <div class="caixa-input" style="width: 40%;">
                    @error('nome')
                        <input title="{{ $message }}" class="alert-danger" type="text" id="nome" name="nome" autocomplete="off"  style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="nome">
                            <span>Nome</span>
                        </label>
                    @else
                        <input type="text" id="nome" name="nome" autocomplete="off" required>
                        <label for="nome">
                            <span>Nome</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 578px; margin-left: 3px">
                    {{-- SOBRENOME --}}
                    @error('sobrenome')
                        <input title="{{ $message }}" class="alert-danger" type="text" id="sobrenome" name="sobrenome" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="sobrenome">
                            <span>Sobrenome</span>
                        </label>
                    @else
                        <input type="text" id="sobrenome" name="sobrenome" autocomplete="off" required>
                        <label for="sobrenome">
                            <span>Sobrenome</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 20%;">
                    {{-- NASCIMENTO --}}
                    @error('nascimento')
                        <input title="{{ $message }}" class="alert-danger" type="text" id="nascimento" name="nascimento" autocomplete="off" required>
                        <label for="nascimento">
                            <span>Data Nascimento</span>
                        </label>
                    @else
                        <input type="text" id="nascimento" name="nascimento" autocomplete="off" required>
                        <label for="nascimento">
                            <span>Data Nascimento</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 773px; margin-left: 3px">
                    {{-- EMAIL --}}
                    @error('email')
                        <input title="{{ $message }}" class="alert-danger" type="email" id="email" name="email" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="email">
                            <span>Email</span>
                        </label>
                    @else
                        <input type="email" id="email" name="email" autocomplete="off" required>
                        <label for="email">
                            <span>Email</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 70%;">
                    {{-- EMAIL_SECUNDARIO --}}
                    @error('email_secundario')
                        <input title="{{ $message }}" class="alert-danger" type="email" id="email_secundario" name="email_secundario" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
                        <label for="email_secundario">
                            <span>Email Secundário</span>
                        </label>
                    @else
                        <input type="email" id="email_secundario" name="email_secundario" autocomplete="off">
                        <label for="email_secundario">
                            <span>Email Secundário</span>
                        </label>
                    @enderror
                </div>

                <div class="caixa-input" style="width: 288px; margin-left: 3px">
                     {{-- TELEFONE --}}
                    @error('telefone')
                        <input title="{{ $message }}" class="alert-danger" type="text" id="telefone" name="telefone" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="telefone">
                            <span>Telefone</span>
                        </label>
                    @else
                        <input type="text" id="telefone" name="telefone" autocomplete="off" required>
                        <label for="telefone">
                            <span>Telefone</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%;">
                    {{-- PASSWORD --}}
                    @error('password')
                        <input title="{{ $message }}" class="alert-danger" type="password" id="password" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="password">
                            <span>Senha</span>
                        </label>
                    @else
                        <input type="password" id="password" name="password" required>
                        <label for="password">
                            <span>Senha</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 482px; margin-left: 3px;">
                    {{-- CIDADE --}}
                    @error('cidade')
                        <div class="autoComplete_wrapper">  
                            <input title="{{ $message }}" class="cidade alert-danger" type="text" name="nome_cidade" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <label for="nome_cidade">
                                <span>Cidade</span>
                            </label>
                        </div>
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteCidade" name="nome_cidade" autocomplete="off" required>
                            <label for="nome_cidade">
                                <span>Cidade</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 40%;">
                    {{-- RUA --}}
                    @error('rua')
                        <input title="{{ $message }}" class="alert-danger" type="text" id="rua" name="rua" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="rua">
                            <span>Rua</span>
                        </label>
                    @else
                        <input type="text" id="rua" name="rua" autocomplete="off" required>
                        <label for="rua">
                            <span>Rua</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%; margin-left: 3px;">
                    {{-- NUMERO --}}
                    @error('numero')
                        <input title="{{ $message }}" class="alert-danger" type="number" id="numero" name="numero" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                        <label for="numero">
                            <span>Número</span>
                        </label>
                    @else
                        <input type="number" id="numero" name="numero" autocomplete="off" required>
                        <label for="numero">
                            <span>Número</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 285px; margin-left: 3px;">
                    {{-- COMPLEMENTO --}}
                    @error('complemento')
                        <input title="{{ $message }}" class="alert-danger" type="text" id="complemento" name="complemento" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    @else
                        <input type="text" id="complemento" name="complemento" autocomplete="off">
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%;">
                    {{-- ESTADO --}}
                    @error('estado')
                        <div class="autoComplete_wrapper">  
                            <input title="{{ $message }}" type="text" id="autoCompleteEstado" class="estado alert-danger" name="nome_estado" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <label for="nome_estado">
                                <span>Estado</span>
                            </label>
                        </div>    
                    @else
                        <div class="autoComplete_wrapper">  
                            <input class="estado" type="text" id="autoCompleteEstado" name="nome_estado" autocomplete="off" required>
                            <label for="nome_estado">
                                <span>Estado</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%; margin-left: 3px;">
                    {{-- BAIRRO --}}
                    @error('bairro')
                        <div class="autoComplete_wrapper">  
                            <input title="{{ $message }}" type="text" id="autoCompleteBairro" class="bairro alert-danger" name="nome_bairro" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <label for="nome_bairro">
                                <span>Bairro</span>
                            </label>
                        </div>    
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteBairro" class="bairro" name="nome_bairro" autocomplete="off" required>
                            <label for="nome_bairro">
                                <span>Bairro</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 285px; margin-left: 3px;">
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
                </div>
                <button type="submit">Cadastrar</button>
            </div>
        <form>
    </div>
    <script src="{{ asset('js/usuarioMembro/login_membro/mensagem_erro.js') }}"></script>
    <script>
        // Aplica a máscara de telefone usando Inputmask
        $('#telefone').on('input', function() {
            if ($(this).val().trim().length > 0) {
                $(this).inputmask('(99) 99999-9999');
            }
        });
    
        // Aplica a máscara de data usando Inputmask
        $('#nascimento').on('input', function() {
            if ($(this).val().trim().length > 0) {
                $(this).inputmask('99/99/9999');
            }
        });
        
        // Variável PHP contendo os bairros
        const bairros = {!! json_encode($bairros) !!};

        // Variável PHP contendo os bairros
        const cidades = {!! json_encode($cidades) !!};

        // Variável PHP contendo os bairros
        const estados = {!! json_encode($estados) !!};

        function inicializarAutoComplete(data, selector, onSelectionCallback) {
            const autoCompleteJS = new autoComplete({
                data: {
                    src: data,
                    key: ["nome"],
                },
                name: "autoComplete",
                selector: selector,
                threshold: 0,
                debounce: 300,
                searchEngine: "strict",
                highlight: true,
                maxResults: 5,
                onSelection: onSelectionCallback,
            });

            const autoCompleteInput = document.querySelector(selector);
            autoCompleteInput.addEventListener('focusout', function() {
                const inputText = this.value;

                const encontrado = data.find(item => item.nome === inputText);

                if (!encontrado) {
                    this.value = '';
                }
            });
        }
        // Inicializar o autocomplete para as cidades
        inicializarAutoComplete(cidades, "#autoCompleteCidade", feedback => {
            const cidade = feedback.selection.value;
            const autoCompleteInput = document.getElementById('autoCompleteCidade');
            autoCompleteInput.value = cidade.nome;
        });

        // Inicializar o autocomplete para os bairros
        inicializarAutoComplete(bairros, "#autoCompleteBairro", feedback => {
            const bairro = feedback.selection.value;
            const autoCompleteInput = document.getElementById('autoCompleteBairro');
            autoCompleteInput.value = bairro.nome;
        });


        // Inicializar o autocomplete para os estados
        inicializarAutoComplete(estados, "#autoCompleteEstado", feedback => {
            const estado = feedback.selection.value;
            const autoCompleteInput = document.getElementById('autoCompleteEstado');
            autoCompleteInput.value = estado.nome;
        });

    </script>
</body>
</html>


