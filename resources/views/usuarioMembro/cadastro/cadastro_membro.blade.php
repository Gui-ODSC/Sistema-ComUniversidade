<!DOCTYPE html>
<html lang="pt-br">
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
        <form method="POST" action="{{ route('cadastro_create') }}" enctype="multipart/form-data">
            @csrf
            @if($errors->has('dados'))
                <div class="msg-erro" id="error-message-email" style="margin-top: 30px">
                    @foreach ($errors->get('dados') as $dado)
                        <p style="display: block; align-items: center; width: 100%;">{{ $dado }}</p>
                        <br>
                    @endforeach
                </div>
            @endif
            <div style="width: 100%; display: flex; justify-content: center;">
                <div class="caixa-input" style="width: 50%;">
                    <div>
                        <label for="foto">Selecione uma imagem:</label>
                        <input type="file" id="foto" name="foto" onchange="previewImage(event)">
                    </div>
        
                    <div id="image-container">
                        <!-- Verifica se a imagem está presente antes de exibi-la -->
                        @if(isset($errors) && $errors->has('foto'))
                            <span class="alert-danger">Erro: {{ $errors->first('foto') }}</span>
                        @else
                            <img id="image-preview" src="#" alt="Imagem selecionada" style="display: none;">
                        @endif
                    </div>
                </div>
            </div>
            <div class="section-form">
                {{-- NOME --}}
                <div class="caixa-input" style="width: 40%;">
                    @error('nome')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off"  type="text" id="nome" name="nome" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" value="{{old('nome')}}" required>
                        <label for="nome">
                            <span>Nome</span>
                        </label>
                    @else
                        <input type="text" id="nome" name="nome" autocompĺete="off" value="{{old('nome')}}" required>
                        <label for="nome">
                            <span>Nome</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 578px; margin-left: 3px">
                    {{-- SOBRENOME --}}
                    @error('sobrenome')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="sobrenome" name="sobrenome" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" value="{{old('sobrenome')}}" required>
                        <label for="sobrenome">
                            <span>Sobrenome</span>
                        </label>
                    @else
                        <input type="text" id="sobrenome" name="sobrenome" autocompĺete="off" value="{{old('sobrenome')}}" required>
                        <label for="sobrenome">
                            <span>Sobrenome</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 20%;">
                    {{-- NASCIMENTO --}}
                    @error('nascimento')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="nascimento" name="nascimento" value="{{old('nascimento')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="nascimento">
                            <span>Data Nascimento</span>
                        </label>
                    @else
                        <input type="text" id="nascimento" name="nascimento" autocompĺete="off" value="{{old('nascimento')}}" required>
                        <label for="nascimento">
                            <span>Data Nascimento</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 773px; margin-left: 3px">
                    {{-- EMAIL --}}
                    @error('email')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="email" id="email" name="email" value="{{old('email')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="email">
                            <span>Email</span>
                        </label>
                    @else
                        <input type="email" id="email" name="email" autocompĺete="off" value="{{old('email')}}" required>
                        <label for="email">
                            <span>Email</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 70%;">
                    {{-- EMAIL_SECUNDARIO --}}
                    @error('email_secundario')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="email" id="email_secundario" name="email_secundario" value="{{old('email_secundario')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                        <label for="email_secundario">
                            <span>Email Secundário</span>
                        </label>
                    @else
                        <input type="email" id="email_secundario" name="email_secundario" autocompĺete="off" value="{{old('email_secundario')}}">
                        <label for="email_secundario">
                            <span>Email Secundário</span>
                        </label>
                    @enderror
                </div>

                <div class="caixa-input" style="width: 288px; margin-left: 3px">
                     {{-- TELEFONE --}}
                    @error('telefone')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="telefone" name="telefone" value="{{old('telefone')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="telefone">
                            <span>Telefone</span>
                        </label>
                    @else
                        <input type="text" id="telefone" name="telefone" autocompĺete="off" value="{{old('telefone')}}" required>
                        <label for="telefone">
                            <span>Telefone</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%;">
                    {{-- PASSWORD --}}
                    @error('password')
                        <div style="position: relative;">
                            <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="password" id="password" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required oninput="toggleEye()">
                            <label for="password">
                                <span>Senha</span>
                            </label>
                            <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 440px; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                        </div>
                    @else
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" autocompĺete="off" required oninput="toggleEye()">
                            <label for="password">
                                <span>Senha</span>
                            </label>
                            <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 440px; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 482px; margin-left: 3px;">
                    {{-- CIDADE --}}
                    @error('cidade')
                        <div class="autoComplete_wrapper">  
                            <input title="{{ $message }}" class="cidade alert-danger" autocompĺete="off" type="text" name="nome_cidade" value="{{old('nome_cidade')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <label for="nome_cidade">
                                <span>Cidade</span>
                            </label>
                        </div>
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteCidade" name="nome_cidade" autocompĺete="off" value="{{old('nome_cidade')}}" required>
                            <label for="nome_cidade">
                                <span>Cidade</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 40%;">
                    {{-- RUA --}}
                    @error('rua')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="rua" name="rua" value="{{old('rua')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="rua">
                            <span>Rua</span>
                        </label>
                    @else
                        <input type="text" id="rua" name="rua" autocompĺete="off" value="{{old('rua')}}" required>
                        <label for="rua">
                            <span>Rua</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%; margin-left: 3px;">
                    {{-- NUMERO --}}
                    @error('numero')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="number" id="numero" name="numero" value="{{old('numero')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="numero">
                            <span>Número</span>
                        </label>
                    @else
                        <input type="number" id="numero" name="numero" autocompĺete="off" value="{{old('numero')}}" required>
                        <label for="numero">
                            <span>Número</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 285px; margin-left: 3px;">
                    {{-- COMPLEMENTO --}}
                    @error('complemento')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="complemento" name="complemento" value="{{old('complemento')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    @else
                        <input type="text" id="complemento" name="complemento" autocompĺete="off" value="{{old('complemento')}}">
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%;">
                    {{-- ESTADO --}}
                    @error('estado')
                        <div class="autoComplete_wrapper">  
                            <input title="{{ $message }}" type="text" id="autoCompleteEstado" class="estado alert-danger" autocompĺete="off" name="nome_estado" value="{{old('nome_estado')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <label for="nome_estado">
                                <span>Estado</span>
                            </label>
                        </div>    
                    @else
                        <div class="autoComplete_wrapper">  
                            <input class="estado" type="text" id="autoCompleteEstado" name="nome_estado" autocompĺete="off" value="{{old('nome_estado')}}" required>
                            <label for="nome_estado">
                                <span>Estado</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 481px; margin-left: 3px;">
                    {{-- BAIRRO --}}
                    @error('bairro')
                        <div class="autoComplete_wrapper">  
                            <input title="{{ $message }}" type="text" id="autoCompleteBairro" class="bairro alert-danger" autocompĺete="off" name="nome_bairro" value="{{old('nome_bairro')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <label for="nome_bairro">
                                <span>Bairro</span>
                            </label>
                        </div>    
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteBairro" class="bairro" name="nome_bairro" autocompĺete="off" value="{{old('nome_bairro')}}" required>
                            <label for="nome_bairro">
                                <span>Bairro</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%;">
                    {{-- TIPO PESSOA --}}
                    @error('tipo_pessoa')
                        <select title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="tipo_pessoa" name="tipo_pessoa" value="{{old('tipo_pessoa')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <option value="" selected disabled></option>
                            <option value="FISICA">Física</option>
                            <option value="JURIDICA">Jurídica</option>
                        </select>
                        <label for="tipo_pessoa">
                            <span>Tipo Pessoa</span>
                        </label>
                    @else
                        <select name="tipo_pessoa" id="tipo_pessoa" autocompĺete="off" value="{{old('tipo_pessoa')}}" required>
                            <option value="" selected disabled></option>
                            <option value="FISICA" {{ "FISICA" === old('tipo_pessoa') ? 'selected' : '' }}>Física</option>
                            <option value="JURIDICA" {{ "JURIDICA" === old('tipo_pessoa') ? 'selected' : '' }}>Jurídica</option>
                        </select>
                        <label for="tipo_pessoa">
                            <span>Tipo Pessoa</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 481px; margin-left: 3px">
                    {{-- INSTITUICAO --}}
                    @error('instituicao')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="instituicao" name="instituicao" value="{{old('instituicao')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                        <label for="instituicao">
                            <span>Instituição</span>
                        </label>
                    @else
                        <input type="text" id="instituicao" name="instituicao" autocompĺete="off" value="{{old('instituicao')}}"    >
                        <label for="instituicao">
                            <span>Instituição</span>
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

        /* OLINHO DA SENHA */
        function togglePassword() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");

            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_marcado.png')}}" alt="" style="width: 25px">';
            } else {
                passwordField.type = "password";
                toggleButton.innerHTML = '<img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px">';
            }
        }

        // Verifica se há dados no campo de senha para exibir o ícone do olho
        function toggleEye() {
            var passwordField = document.getElementById("password");
            var toggleButton = document.querySelector(".toggle-password");

            if (passwordField.value !== "") {
                toggleButton.style.display = "inline-block";
            } else {
                toggleButton.style.display = "none";
            }
        }

        /* IMAGEM DE PERFIL */
        function previewImage(event) {
            var input = event.target;
            var imageContainer = document.getElementById('image-container');
            var imagePreview = document.getElementById('image-preview');

            if (input.files && input.files[0]) {
                var reader = new FileReader();

                reader.onload = function(e) {
                    imagePreview.src = e.target.result;
                    imageContainer.style.display = 'block'; // Exibir o contêiner da imagem
                }

                reader.readAsDataURL(input.files[0]);
            } else {
                imagePreview.src = '#';
                imageContainer.style.display = 'none'; // Ocultar o contêiner da imagem se nenhum arquivo for selecionado
            }
        }
    </script>
</body>
</html>


