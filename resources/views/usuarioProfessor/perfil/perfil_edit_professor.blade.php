<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/perfil/perfil_edit_professor.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    {{-- Autocomplete.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <title>Perfil</title>
</head>
<body> 
    @include('usuarioProfessor.menu')
    <main class="perfil" id="conteudo">
            <div class="botao-voltar">
                <a title="Voltar" onclick="goBack()"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
            </div>
            @if($errors->any())
                <div class="alert alert-danger" style="text-align: center; margin-top: 10px">
                    <ul>
                        @foreach ($errors->all() as $error)
                            @if ($error)
                                <p>{{ $error }}</p>
                            @endif
                        @endforeach
                    </ul>
                </div>
            @endif
            <form action="{{ route('perfil_edit_store_professor', $usuario->id_usuario) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="cadastro-container" style="display: flex;">
                    <div class="section-form">
                        <div id="container" style="width: 20%">
                            <input type="hidden" name="foto_atual" value="{{ Auth::user()->foto ?? 'null' }}">
                            @if($usuario->foto)
                                <div style="width: 100%; display: flex; flex-direction: column;">
                                    <div class="img-foto-perfil" style="object-fit: contain;">
                                        <img id="current-image" onclick="openFileSelector()" class="foto-perfil" src="{{ Storage::disk('s3-public')->url(Auth::user()->foto) }}" alt="imagem de perfil do usuario">
                                        <input type="file" id="image-input" name="foto" style="position: absolute; height: 10px; opacity: 0; object-fit: cover;" accept="image/*" onchange="previewImage(event)">
                                        <button type="button" onclick="removeImage()" style="font-size: 10px; position: absolute; margin: 5px; width: 120px; bottom: 5px;">Remover imagem</button>
                                        <p id="add-image-text" style="display: none;">Adicionar imagem</p>
                                    </div>
                                </div>
                            @else
                                <div style="width: 100%; display: flex; flex-direction: column;">
                                    <div class="img-foto-perfil" onclick="openFileSelector()">
                                        <img id="current-image">
                                        <p id="image-placeholder" style="color: #FFF"><img src="{{ asset('img/icones/perfil_claro.png') }}" alt=""><br>Adicionar uma imagem</p> 
                                        <input type="file" id="image-input" name="foto" style="position: absolute; height: 10px; opacity: 0; object-fit: cover;" accept="image/*" onchange="previewImage(event)">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div style="width: 80%; display: flex; flex-wrap: wrap; padding-left: 10px">
                            {{-- NOME --}}
                            <div class="caixa-input" style="width: 50%;">
                                @error('nome')
                                    <input title="{{ $message }}" class="alert-danger" type="text" id="nome" name="nome" autocomplete="off" value="{{ $usuario->nome }}"  style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <label for="nome">
                                        <span>Nome</span>
                                    </label>
                                @else
                                    <input type="text" id="nome" name="nome" autocomplete="off" value="{{ $usuario->nome }}" required>
                                    <label for="nome">
                                        <span>Nome</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="caixa-input" style="width: 50%; padding-left: 3px">
                                {{-- SOBRENOME --}}
                                @error('sobrenome')
                                    <input title="{{ $message }}" class="alert-danger" type="text" id="sobrenome" name="sobrenome" value="{{ $usuario->sobrenome }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <label for="sobrenome">
                                        <span>Sobrenome</span>
                                    </label>
                                @else
                                    <input type="text" id="sobrenome" name="sobrenome" value="{{ $usuario->sobrenome }}" autocomplete="off" required>
                                    <label for="sobrenome">
                                        <span>Sobrenome</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="caixa-input" style="width: 20%;">
                                {{-- NASCIMENTO --}}
                                @error('nascimento')
                                    <input title="{{ $message }}" class="alert-danger" type="text" id="nascimento" name="nascimento" value="{{ $nascimentoFormat }}" autocomplete="off" required>
                                    <label for="nascimento">
                                        <span>Data nascimento</span>
                                    </label>
                                @else
                                    <input type="text" id="nascimento" name="nascimento" autocomplete="off" value="{{ $nascimentoFormat }}" required>
                                    <label for="nascimento">
                                        <span>Data nascimento</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="caixa-input" style="width: 80%; padding-left: 3px">
                                {{-- EMAIL --}}
                                @error('email')
                                    <input title="{{ $message }}" class="alert-danger" type="email" id="email" name="email" autocomplete="off" value="{{ $usuario->email }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <label for="email">
                                        <span>Email</span>
                                    </label>
                                @else
                                    <input type="email" id="email" name="email" autocomplete="off" value="{{ $usuario->email }}" required>
                                    <label for="email">
                                        <span>Email</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="caixa-input" style="width: 70%;">
                                {{-- EMAIL_SECUNDARIO --}}
                                @error('email_secundario')
                                    <input title="{{ $message }}" class="alert-danger" type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario}}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                                    <label for="email_secundario">
                                        <span>Email secundário</span>
                                    </label>
                                @else
                                    <input type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario}}" autocomplete="off">
                                    <label for="email_secundario">
                                        <span>Email secundário</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="caixa-input" style="width: 30%; padding-left: 3px">
                                {{-- TELEFONE --}}
                                @error('telefone')
                                    <input title="{{ $message }}" class="alert-danger" type="text" id="telefone" value="{{ $usuario->telefone }}" name="telefone" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <label for="telefone">
                                        <span>Telefone</span>
                                    </label>
                                @else
                                    <input type="text" id="telefone" name="telefone" autocomplete="off" value="{{ $usuario->telefone }}" required>
                                    <label for="telefone">
                                        <span>Telefone</span>
                                    </label>
                                @enderror
                            </div>
                            <div class="caixa-input" style="width: 50%;">
                                {{-- PASSWORD --}}
                                @error('password')
                                    <div style="position: relative;">
                                        <input title="{{ $message }}" class="alert-danger" type="password" id="password" placeholder="Digite aqui a nova Senha" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                                        <label for="password">
                                            <span>Alterar senha</span>
                                        </label>
                                        <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 93%; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                                    </div>
                                @else
                                    <div style="position: relative;">
                                        <input type="password" id="password" name="password" oninput="toggleEye()">
                                        <label for="password">
                                            <span>Alterar senha</span>
                                        </label>
                                        <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 93%; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                                    </div>
                                @enderror
                            </div>  
                            <div class="caixa-input" style="width: 50%; padding-left: 3px;">
                                {{-- CEP --}}
                                @error('cep')
                                    <input title="{{ $message }}" class="cidade alert-danger" id="cep" autocompĺete="off" type="text" name="cep" value="{{$cepFormat}}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <label for="cep">
                                        <span>CEP *</span>
                                    </label>
                                @else
                                    <input type="text" name="cep" id="cep" autocompĺete="off" value="{{$cepFormat}}" required> 
                                    <label for="cep">
                                        <span>CEP *</span>
                                    </label>
                                @enderror
                            </div>  
                        </div>
                    </div>
                        <div class="caixa-input" style="width: 18.5%;">
                            {{-- NUMERO --}}
                            @error('numero')
                                <input title="{{ $message }}" class="alert-danger" type="number" id="numero" name="numero" value="{{ $usuario->numero }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                <label for="numero">
                                    <span>Número</span>
                                </label>
                            @else
                                <input type="number" id="numero" name="numero" value="{{ $usuario->numero }}" autocomplete="off" required>
                                <label for="numero">
                                    <span>Número</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input readonly" style="width: 40.5%; padding-left: 3px; opacity: 0.8;">
                            {{-- RUA --}}
                            @error('logradouro')
                                <input title="{{ $message }}" class="alert-danger" type="text" id="logradouro" name="logradouro" value="{{ $cep->logradouro }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                                <label for="logradouro">
                                    <span>Rua</span>
                                </label>
                            @else
                                <input type="text" id="logradouro" name="logradouro" autocomplete="off" value="{{ $cep->logradouro }}" readonly>
                                <label for="logradouro">
                                    <span>Rua</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 41%; padding-left: 3px;">
                            {{-- COMPLEMENTO --}}
                            @error('complemento')
                                <input title="{{ $message }}" class="alert-danger" type="text" id="complemento" name="complemento" value="{{ $usuario->complemento }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                                <label for="complemento">
                                    <span>Complemento</span>
                                </label>
                            @else
                                <input type="text" id="complemento" name="complemento" value="{{ $usuario->complemento }}" autocomplete="off">
                                <label for="complemento">
                                    <span>Complemento</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input readonly" style="width: 50%; opacity: 0.8;">
                            {{-- BAIRRO --}}
                            @error('bairro')
                                <input type="text" id="bairro" class="bairro alert-danger" name="bairro" autocomplete="off" value="{{ $cep->bairro }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" readonly>
                                <label for="bairro">
                                    <span>Bairro</span>
                                </label>
                            @else
                                <input type="text" id="bairro" class="bairro" name="bairro" autocomplete="off" value="{{ $cep->bairro }}" readonly>
                                <label for="bairro">
                                    <span>Bairro</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input readonly" style="width: 50%; opacity: 0.8; padding-left: 3px">
                            {{-- CIDADE --}}
                            @error('cidade')
                                <input title="{{ $message }}" id="cidade" class="cidade alert-danger" type="text" name="cidade" autocomplete="off" value="{{ $cidade->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" readonly>
                                <label for="cidade">
                                    <span>Cidade</span>
                                </label>
                            @else
                                <input type="text" id="cidade" name="cidade" autocomplete="off" value="{{ $cidade->nome }}" readonly>
                                <label for="cidade">
                                    <span>Cidade</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input readonly" style="width: 50%; opacity: 0.8;">
                            {{-- ESTADO --}}
                            @error('estado')
                                <input title="{{ $message }}" type="text" id="estado" class="estado alert-danger" name="estado" tabindex="1" autocomplete="off" value="{{ $estado->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" readonly>
                                <label for="estado">
                                    <span>Estado</span>
                                </label>
                            @else
                                <input type="text" id="estado" name="estado" autocomplete="off" value="{{ $estado->nome }}" tabindex="1" readonly>
                                <label for="estado">
                                    <span>Estado</span>
                                </label>
                            @enderror
                        </div>
                        {{-- INSTITUICAO --}}
                        <div class="caixa-input" style="width: 50%; padding-left: 3px">
                            @error('instituicao')
                                <input title="{{ $message }}" class="alert-danger" type="text" id="instituicao" name="instituicao" autocomplete="off" value="{{ $usuario->instituicao }}"  style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                                <label for="instituicao">
                                    <span>Instituição</span>
                                </label>
                            @else
                                <input type="text" id="instituicao" name="instituicao" autocomplete="off" value="{{ $usuario->instituicao }}">
                                <label for="nome">
                                    <span>Instituição</span>
                                </label>
                            @enderror
                        </div>
                    {{-- NUMERO REGISTRO --}}
                    <div class="caixa-input" style="width: 50%;">
                        @error('numero_registro')
                            <input title="{{ $message }}" class="alert-danger" type="number" id="numero_registro" name="numero_registro" autocomplete="off" value="{{ $usuarioProfessor->numero_registro }}"  style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="20">
                            <label for="numero_registro">
                                <span>Número do registro (somente números)</span>
                            </label>
                        @else
                            <input type="number" id="numero_registro" name="numero_registro" autocomplete="off" value="{{ $usuarioProfessor->numero_registro }}" required maxlength="20" >
                            <label for="nome">
                                <span>Número do registro (somente números)</span>
                            </label>
                        @enderror
                    </div>
                    {{-- Link Curriculo --}}
                    <div class="caixa-input" style="width: 50%; padding-left: 3px">
                        @error('link_curriculo')
                            <input title="{{ $message }}" class="alert-danger" type="text" id="link_curriculo" name="link_curriculo" autocomplete="off" value="{{ $usuarioProfessor->link_curriculo }}"  style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                            <label for="link_curriculo">
                                <span>Link do curriculo</span>
                            </label>
                        @else
                            <input type="text" id="link_curriculo" name="link_curriculo" autocomplete="off" value="{{ $usuarioProfessor->link_curriculo }}">
                            <label for="nome">
                                <span>Link do curriculo</span>
                            </label>
                        @enderror
                    </div>
                </form>
            <div class="div-button">
                <button type="submit">Salvar</button>
            </div>
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script> 
    <script src="{{ asset('js/usuarioProfessor/cadastro/cep.js') }}"></script>

    <script>

        function goBack() {
            window.history.back();
        }   
        // Aplica a máscara de telefone usando Inputmask
        $(document).ready(function(){
            $('#telefone').inputmask('(99) 99999-9999');
        });
    
        // Aplica a máscara de data usando Inputmask
        $(document).ready(function(){
            $('#nascimento').inputmask('99/99/9999');
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

        /* IMAGEM DE PERFIL */
        function previewImage(event) {
            const input = event.target;
            const currentImage = document.getElementById('current-image');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const addImageText = document.getElementById('add-image-text');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                    currentImage.style.display = 'inline-block';
                    if (imagePlaceholder) {
                        imagePlaceholder.style.display = 'none'; // Oculta a mensagem "Adicionar uma imagem"
                    }

                    if (addImageText) {
                        addImageText.style.display = 'none';
                    }
                };

                reader.readAsDataURL(input.files[0]);
            } else {
                // Se nenhum arquivo foi selecionado, redefina a imagem para a imagem padrão
                currentImage.src = "{{ asset('img/icones/perfil_claro.png') }}";
                currentImage.style.display = 'inline-block:';
                if (imagePlaceholder) {
                    imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
                }
            }

            currentImage.style['object-fit'] = 'cover';
        }

        function openFileSelector() {
            document.getElementById('image-input').click();
        }

        function removeImage() {
            const currentImage = document.getElementById('current-image');
            const imagePlaceholder = document.getElementById('image-placeholder');
            const addImageText = document.getElementById('add-image-text');
            const imageInput = document.getElementById('image-input');

            currentImage.src = "{{ asset('img/icones/perfil_claro.png') }}";
            currentImage.style = 'object-fit: none; padding-bottom: 0px';

            if (imagePlaceholder) {
                imagePlaceholder.style.display = 'block'; // Mostra novamente a mensagem "Adicionar uma imagem"
            }

            if (addImageText) {
                addImageText.style.display = 'block'; // Mostra o texto "Adicionar imagem"
                addImageText.style = 'margin: 0; padding-bottom: 60px; color: #FFF'; 
            }

            // Remove o arquivo de imagem do campo de entrada de arquivo (input)
            imageInput.value = ''; // Limpa o input file
            
            const fotoAtualHiddenInput = document.querySelector('input[name="foto_atual"]');
            fotoAtualHiddenInput.value = 'null';
        }

    </script>
</body>
</html>