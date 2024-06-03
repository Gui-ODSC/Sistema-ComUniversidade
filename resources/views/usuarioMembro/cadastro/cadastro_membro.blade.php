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

    <title>Cadastro de membros</title>
</head>
<header>
    {{-- <nav class="navbar">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1"><a href="/">Extensão Universitaria</a></span>
        </div>
    </nav> --}}
</header>
<body>
    <div class="botao-voltar">
        <a title="Voltar" href="{{ route('login_membro_index') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
    </div>
    <div class="cadastro-container">
        <div class="titulo">
            <h1>Cadastro membro externo</h1>
            <h4>Seja bem vindo(a)</h2>
        </div>
        <form method="POST" action="{{ route('cadastro_create') }}" enctype="multipart/form-data">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger" style="margin-top: 1px; font-size: 15px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            @if ($error)
                                <p style="margin-bottom: 5px">{{ $error }}</p>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
            <div style="display: flex; margin: 5px 10px;">
                <div style="display: flex; flex-direction: column; position: relative;">
                    <div class="img-foto-perfil" onclick="openFileSelector()">
                        <img id="current-image" style="display: none;">
                        <p id="image-placeholder"><img src="{{asset('img/icones/perfil_claro.png')}}" alt=""><br>Adicionar uma imagem</p>
                        <input type="file" id="image-input" name="foto" style="position: absolute; height: 10px; opacity: 0; object-fit: cover;" accept="image/*" onchange="previewImage(event)" maxlength="255">
                    </div>
                    <button id="remove-image" onclick="removeImage()" style="display: none; position: absolute; top: 0px; right: 10px; color: black; border: 1px solid black; border-radius: 5px; width: 30px; font-size: 10px">X</button>
                </div>
                <div style="display: flex; flex-wrap: wrap; margin-left: 5px;">
                    {{-- NOME --}}
                    <div class="caixa-input" style="width: 100%;">
                        @error('nome')
                            <input title="{{ $message }}" class="alert-danger" autocompĺete="off"  type="text" id="nome" name="nome" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" value="{{old('nome')}}" maxlength="60" required>
                            <label for="nome" style="color: black">
                                <span>Nome *</span>
                            </label>
                        @else
                            <input type="text" id="nome" name="nome" autocompĺete="off" value="{{old('nome')}}" maxlength="60" required>
                            <label for="nome">
                                <span>Nome *</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 70%;">
                        {{-- SOBRENOME --}}
                        @error('sobrenome')
                            <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="sobrenome" name="sobrenome" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" value="{{old('sobrenome')}}"  maxlength="100" required>
                            <label for="sobrenome">
                                <span>Sobrenome *</span>
                            </label>
                        @else
                            <input type="text" id="sobrenome" name="sobrenome" autocompĺete="off" value="{{old('sobrenome')}}" maxlength="100" required>
                            <label for="sobrenome">
                                <span>Sobrenome *</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 30%; padding-left: 3px; margin-bottom: 4px">
                        {{-- NASCIMENTO --}}
                        @error('nascimento')
                            <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="nascimento" name="nascimento" value="{{old('nascimento')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <label for="nascimento">
                                <span>Data Nascimento *</span>
                            </label>
                        @else
                            <input type="text" id="nascimento" name="nascimento" autocompĺete="off" value="{{old('nascimento')}}" required>
                            <label for="nascimento">
                                <span>Data Nascimento *</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input">
                        {{-- EMAIL --}}
                        @error('email')
                            <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="email" id="email" name="email" value="{{old('email')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black"  maxlength="255" required>
                            <label for="email">
                                <span>Email *</span>
                            </label>
                        @else
                            <input type="email" id="email" name="email" autocompĺete="off" value="{{old('email')}}"  maxlength="255" required>
                            <label for="email">
                                <span>Email *</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input" style="margin-bottom: 0">
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
                </div>
            </div>
            <div style="margin: 3px 10px; display: flex; flex-wrap: wrap">
                <div class="caixa-input" style="width: 20%; margin-bottom: 6px">
                        {{-- TELEFONE --}}
                    @error('telefone')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="telefone" name="telefone" value="{{old('telefone')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="telefone">
                            <span>Telefone *</span>
                        </label>
                    @else
                        <input type="text" id="telefone" name="telefone" autocompĺete="off" value="{{old('telefone')}}" required>
                        <label for="telefone">
                            <span>Telefone *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%; padding-left: 3px">
                    {{-- PASSWORD --}}
                    @error('password')
                        <div style="position: relative;">
                            <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="password" id="password" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required oninput="toggleEye()" maxlength="100" style="padding-right: 75px;" value="{{old('password')}}">
                            <label for="password">
                                <span>Senha *</span>
                            </label>
                            <!-- Ícone informativo -->
                            <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; top: 50%; left: 95%; transform: translateY(-50%); cursor: pointer;">
                                <img src="{{ asset('img/cadastro_usuarios/icone_info_senha.png') }}" alt="Ícone informativo" style="width: 20px;">
                            </span>
                            <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 89%; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                        </div>
                    @else
                        <div style="position: relative;">
                            <input type="password" id="password" name="password" autocompĺete="off" required oninput="toggleEye()" maxlength="100" style="padding-right: 75px;" value="{{old('password')}}">
                            <label for="password">
                                <span>Senha *</span>
                            </label>
                            <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 89%; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                            <!-- Ícone informativo -->
                            <span class="info-icon" onclick="showPasswordRules()" style="position: absolute; top: 50%; left: 95%; transform: translateY(-50%); cursor: pointer;">
                                <img src="{{ asset('img/cadastro_usuarios/icone_info_senha.png') }}" alt="Ícone informativo" style="width: 20px;">
                            </span>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%; padding-left: 3px;">
                    {{-- CEP --}}
                    @error('cep')
                        <input title="{{ $message }}" class="cidade alert-danger" id="cep" autocompĺete="off" type="text" name="cep" value="{{old('cep')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                        <label for="cep">
                            <span>CEP *</span>
                        </label>
                    @else
                        <input type="text" name="cep" id="cep" autocompĺete="off" value="{{old('cep')}}" required> 
                        <label for="cep">
                            <span>CEP *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input readonly" style="width: 40%; margin-bottom: 6px; opacity: 0.7;">
                    {{-- RUA --}}
                    @error('logradouro')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="logradouro" name="logradouro" value="{{old('logradouro')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required readonly>
                        <label for="logradouro">
                            <span>Rua</span>
                        </label>
                    @else
                        <input type="text" id="logradouro" name="logradouro" autocompĺete="off" value="{{old('logradouro')}}" required readonly>
                        <label for="logradouro">
                            <span>Rua</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%; padding-left: 3px;">
                    {{-- NUMERO --}}
                    @error('numero')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="number" id="numero" name="numero" value="{{old('numero')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required  maxlength="20">
                        <label for="numero">
                            <span>Número (somente números) *</span>
                        </label>
                    @else
                        <input type="number" id="numero" name="numero" autocompĺete="off" value="{{old('numero')}}" required  maxlength="20">
                        <label for="numero">
                            <span>Número (somente números) *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%; padding-left: 3px;">
                    {{-- COMPLEMENTO --}}
                    @error('complemento')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="complemento" name="complemento" value="{{old('complemento')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" maxlength="255">
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    @else
                        <input type="text" id="complemento" name="complemento" autocompĺete="off" value="{{old('complemento')}}" maxlength="255">
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input readonly" style="width: 50%; margin-bottom: 6px; padding-right: 3px; opacity: 0.7;">
                    {{-- ESTADO --}}
                    @error('estado')
                        <input title="{{ $message }}" type="text" id="estado" class="estado alert-danger" autocompĺete="off" name="estado" value="{{old('estado')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required readonly>
                        <label for="estado">
                            <span>Estado</span>
                        </label>
                    @else
                        <input class="estado" type="text" id="estado" name="estado" autocompĺete="off" value="{{old('estado')}}" readonly required>
                        <label for="estado">
                            <span>Estado</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input readonly" style="width: 50%; padding-right: 3px; opacity: 0.7;">
                    {{-- BAIRRO --}}
                    @error('bairro')
                        <input title="{{ $message }}" type="text" id="bairro" class="bairro alert-danger" autocompĺete="off" name="bairro" value="{{old('bairro')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required  readonly>
                        <label for="bairro">
                            <span>Bairro</span>
                        </label>
                    @else
                        <input type="text" id="bairro" class="bairro" name="bairro" autocompĺete="off" value="{{old('bairro')}}" readonly required>
                        <label for="bairro">
                            <span>Bairro</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input readonly" style="width: 40%; padding-right: 3px; opacity: 0.7;">
                    {{-- CIDADE --}}
                    @error('cidade')
                        <input title="{{ $message }}" type="text" id="cidade" class="cidade alert-danger" autocompĺete="off" name="cidade" value="{{old('cidade')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required readonly">
                        <label for="cidade">
                            <span>Cidade</span>
                        </label>
                    @else
                        <input type="text" id="cidade" class="cidade" name="cidade" autocompĺete="off" value="{{old('cidade')}}" required readonly>
                        <label for="cidade">
                            <span>Cidade</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 20%;">
                    {{-- TIPO PESSOA --}}
                    @error('tipo_pessoa')
                        <select title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="tipo_pessoa" name="tipo_pessoa" value="{{old('tipo_pessoa')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <option value="" selected disabled></option>
                            <option value="FISICA" {{ "FISICA" === old('tipo_pessoa') ? 'selected' : '' }}>Física</option>
                            <option value="JURIDICA" {{ "JURIDICA" === old('tipo_pessoa') ? 'selected' : '' }}>Jurídica</option>
                        </select>
                        <label for="tipo_pessoa">
                            <span>Tipo Pessoa *</span>
                        </label>
                    @else
                        <select name="tipo_pessoa" id="tipo_pessoa" autocompĺete="off" value="{{old('tipo_pessoa')}}" required>
                            <option value="" selected disabled></option>
                            <option value="FISICA" {{ "FISICA" === old('tipo_pessoa') ? 'selected' : '' }}>Física</option>
                            <option value="JURIDICA" {{ "JURIDICA" === old('tipo_pessoa') ? 'selected' : '' }}>Jurídica</option>
                        </select>
                        <label for="tipo_pessoa">
                            <span>Tipo Pessoa *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 40%; padding-left: 3px">
                    {{-- INSTITUICAO --}}
                    @error('instituicao')
                        <input title="{{ $message }}" class="alert-danger" autocompĺete="off" type="text" id="instituicao" name="instituicao" value="{{old('instituicao')}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" maxlength="100">
                        <label for="instituicao">
                            <span>Instituição</span>
                        </label>
                    @else
                        <input type="text" id="instituicao" name="instituicao" autocompĺete="off" value="{{old('instituicao')}}" maxlength="100">
                        <label for="instituicao">
                            <span>Instituição</span>
                        </label>
                    @enderror
                </div>
            </div>
                <button class="botao-envio-form" type="submit">Cadastrar</button>
                <div style="justify-content: end; display: flex">
                    <h6>* Campos Obrigatórios</h6>
                </div>
            </div>
        <form>
    </div>
    <script src="{{ asset('js/usuarioMembro/login_membro/mensagem_erro.js') }}"></script>
    <script src="{{ asset('js/usuarioMembro/cadastro/cep.js') }}"></script>
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

        // Aplica a máscara de Cep usando o InputMask
        $('#cep').on('input', function() {
            if ($(this).val().trim().length > 0) {
                $(this).inputmask('99999-999'); 
            }
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

        function previewImage(event) {
            const input = event.target;
            const currentImage = document.getElementById('current-image');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const removeButton = document.getElementById('remove-image');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                    currentImage.style.display = 'inline-block';
                    imagePlaceholder.style.display = 'none'; // Oculta a mensagem "Adicionar uma imagem"
                    removeButton.style.display = 'block'; // Mostra o botão de remoção
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                // Se nenhum arquivo foi selecionado, redefina a imagem para a imagem padrão
                currentImage.src = "{{ asset('img/icones/perfil_claro.png') }}";
                currentImage.style.display = 'inline-block';
                imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
                removeButton.style.display = 'none'; // Oculta o botão de remoção
            }
        }

        // Função para abrir o seletor de arquivo quando a imagem é clicada
        function openFileSelector() {
            document.getElementById('image-input').click();
        }

        // Função para remover a imagem
        function removeImage() {
            const currentImage = document.getElementById('current-image');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const removeButton = document.getElementById('remove-image');
            const imageInput = document.getElementById('image-input');

            currentImage.style.display = 'none';
            currentImage.src = '';
            imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
            removeButton.style.display = 'none'; // Oculta o botão de remoção
            imageInput.value = ''; // Limpa o valor do input de arquivo
        }

        /* permitir somente numeros */

        document.getElementById('numero').addEventListener('input', function(event) {
            this.value = this.value.replace(/[^\d]/g, '');
        });

        /* INFORMATIVO SENHA */
        function showPasswordRules() {
            // Caixa de diálogo das regras da senha
            var passwordRules = document.createElement("div");
            passwordRules.innerHTML = `
                <div id="password-rules" style="position: absolute; top: 310px; right: 215px; background-color: #4D6D7F; color: #FFF; border: 1px solid #FFF; padding: 10px; border-radius: 10px;">
                    <button onclick="closePasswordRules()" style="position: absolute; top: 5px; color: #FFF; right: 7px; cursor: pointer; background: transparent; border: none; outline: none;">Fechar</button>
                    <p>Regras de criação de senha:</p>
                    <ul>
                        <li>Deve conter pelo menos 8 caracteres</li>
                        <li>Deve conter pelo menos uma letra maiúscula</li>
                        <li>Deve conter pelo menos uma letra minúscula</li>
                        <li>Deve conter pelo menos um número</li>
                    </ul>
                </div>
            `;

            // Adiciona a caixa de diálogo ao corpo do documento
            document.body.appendChild(passwordRules);

            // Remove a caixa de diálogo após 5 segundos
            setTimeout(function() {
                passwordRules.remove();
            }, 5000);
        }

        function closePasswordRules() {
            // Remove a caixa de diálogo das regras da senha
            var passwordRules = document.getElementById('password-rules');
            passwordRules.remove();
        }

    </script>
</body>
</html>


