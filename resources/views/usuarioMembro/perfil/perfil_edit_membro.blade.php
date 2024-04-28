<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/perfil/perfil_edit_membro.css') }}">
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
    @include('usuarioMembro.menu')
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
            <form action="{{ route('perfil_edit_store', $usuario->id_usuario) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="cadastro-container" style="display: flex;">
                    <div class="section-form">
                        <div id="container">
                            @if($usuario->foto)
                                <img id="current-image" class="foto-perfil" src="{{ url('storage/' . Auth::user()->foto) }}" alt="imagem de perfil do usuario" onclick="openFileSelector()">
                            @else
                                <img class="foto-padrao" src="{{ asset('img/icones/perfil_escuro.png') }}" alt="imagem de perfil do usuario">
                                <p>Fazer upload de uma imagem</p>
                            @endif
                            <div id="image-box" style="width: 200px; height: 200px; border: 1px solid #ccc; display: flex; justify-content: center; align-items: center; cursor: pointer;">
                                <span id="image-placeholder">Clique para selecionar uma imagem</span>
                                <input type="file" id="image-input" name="foto" style="display: none;" accept="image/*" onchange="previewImage(event)">
                            </div>
                        </div>
                        <div style="width: 81%; display: flex; flex-wrap: wrap">
                        {{-- NOME --}}
                        <div class="caixa-input" style="width: 30%;">
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
                        <div class="caixa-input" style="width: 662px; margin-left: 3px">
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
                                    <span>Data Nascimento</span>
                                </label>
                            @else
                                <input type="text" id="nascimento" name="nascimento" autocomplete="off" value="{{ $nascimentoFormat }}" required>
                                <label for="nascimento">
                                    <span>Data Nascimento</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 757px; margin-left: 3px">
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
                                    <span>Email Secundário</span>
                                </label>
                            @else
                                <input type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario}}" autocomplete="off">
                                <label for="email_secundario">
                                    <span>Email Secundário</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 281px; margin-left: 3px">
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
                                        <span>Alterar Senha</span>
                                    </label>
                                    <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 440px; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                                </div>
                            @else
                                <div style="position: relative;">
                                    <input type="password" id="password" name="password" required oninput="toggleEye()">
                                    <label for="password">
                                        <span>Alterar Senha</span>
                                    </label>
                                    <span class="toggle-password" onclick="togglePassword()" style="position: absolute; top: 50%; left: 440px; transform: translateY(-50%); cursor: pointer; display: none"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/olho_desmarcado.png')}}" alt="" style="width: 25px"></span>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 472px; margin-left: 3px">
                            {{-- TIPO PESSOA --}}
                            @error('telefone')
                                <input title="{{ $message }}" class="alert-danger" type="text" id="tipo_pessoa" value="{{ ucwords(strtolower($usuario->tipo_pessoa)) }}" name="tipo_pessoa" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                <label for="tipo_pessoa">
                                    <span>Tipo Pessoa</span>
                                </label>
                            @else
                                <select name="tipo_pessoa" id="tipo_pessoa" autocomplete="off" required>
                                    <option value="" {{ ucwords(strtolower($usuario->tipo_pessoa)) ? '' : 'selected' }} disabled></option>
                                    <option value="FISICA" {{ ucwords(strtolower($usuario->tipo_pessoa)) == 'FISICA' ? 'selected' : '' }}>Física</option>
                                    <option value="JURIDICA" {{ ucwords(strtolower($usuario->tipo_pessoa)) == 'JURIDICA' ? 'selected' : '' }}>Jurídica</option>
                                </select>
                                <label for="tipo_pessoa">
                                    <span>Tipo Pessoa</span>
                                </label>
                            @enderror
                        </div>      
                    </div>
                    <div class="caixa-input" style="width: 40%;">
                        {{-- RUA --}}
                        @error('rua')
                            <input title="{{ $message }}" class="alert-danger" type="text" id="rua" name="rua" value="{{ $endereco->rua }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <label for="rua">
                                <span>Rua</span>
                            </label>
                        @else
                            <input type="text" id="rua" name="rua" autocomplete="off" value="{{ $endereco->rua }}" required>
                            <label for="rua">
                                <span>Rua</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 20%; margin-left: 3px;">
                        {{-- NUMERO --}}
                        @error('numero')
                            <input title="{{ $message }}" class="alert-danger" type="number" id="numero" name="numero" value="{{ $endereco->numero }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <label for="numero">
                                <span>Número</span>
                            </label>
                        @else
                            <input type="number" id="numero" name="numero" value="{{ $endereco->numero }}" autocomplete="off" required>
                            <label for="numero">
                                <span>Número</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 461px; margin-left: 3px;">
                        {{-- COMPLEMENTO --}}
                        @error('complemento')
                            <input title="{{ $message }}" class="alert-danger" type="text" id="complemento" name="complemento" value="{{ $endereco->complemento }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black">
                            <label for="complemento">
                                <span>Complemento</span>
                            </label>
                        @else
                            <input type="text" id="complemento" name="complemento" value="{{ $endereco->complemento }}" autocomplete="off">
                            <label for="complemento">
                                <span>Complemento</span>
                            </label>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 50%;">
                        {{-- ESTADO --}}
                        @error('estado')
                            <div class="autoComplete_wrapper">  
                                <input title="{{ $message }}" type="text" id="autoCompleteEstado" class="estado alert-danger" name="nome_estado" tabindex="1" autocomplete="off" value="{{ $estado->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                <label for="nome_estado">
                                    <span>Estado</span>
                                </label>
                            </div>
                        @else
                            <div class="autoComplete_wrapper">  
                                <input type="text" id="autoCompleteEstado" name="nome_estado" autocomplete="off" value="{{ $estado->nome }}" tabindex="1" required>
                                <label for="nome_estado">
                                    <span>Estado</span>
                                </label>
                            </div>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 582px; margin-left: 3px;">
                        {{-- BAIRRO --}}
                        @error('bairro')
                            <div title="{{ $message }}" class="autoComplete_wrapper">  
                                <input type="text" id="autoCompleteBairro" class="bairro alert-danger" name="nome_bairro" autocomplete="off" value="{{ $bairro->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                <label for="nome_bairro">
                                    <span>Bairro</span>
                                </label>
                            </div>    
                        @else
                            <div class="autoComplete_wrapper">  
                                <input type="text" id="autoCompleteBairro" class="bairro" name="nome_bairro" autocomplete="off" value="{{ $bairro->nome }}" required>
                                <label for="nome_bairro">
                                    <span>Bairro</span>
                                </label>
                            </div>
                        @enderror
                    </div>
                    <div class="caixa-input" style="width: 50%">
                        {{-- CIDADE --}}
                        @error('cidade')
                            <div class="autoComplete_wrapper">  
                                <input title="{{ $message }}" class="cidade alert-danger" type="text" name="nome_cidade" autocomplete="off" value="{{ $cidade->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                <label for="nome_cidade">
                                    <span>Cidade</span>
                                </label>
                            </div>
                        @else
                            <div class="autoComplete_wrapper">  
                                <input type="text" id="autoCompleteCidade" name="nome_cidade" autocomplete="off" value="{{ $cidade->nome }}" required>
                                <label for="nome_cidade">
                                    <span>Cidade</span>
                                </label>
                            </div>
                        @enderror
                    </div>
                    {{-- INSTITUICAO --}}
                    <div class="caixa-input" style="width: 582px; margin-left: 3px">
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
                </form>
            <div class="div-button">
                <button type="submit">Salvar</button>
            </div>
    </main>
    <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script> 
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

        // Variável PHP contendo os bairros
        const bairros = {!! json_encode($listBairros) !!};

        // Variável PHP contendo os bairros
        const cidades = {!! json_encode($listCidades) !!};

        // Variável PHP contendo os bairros
        const estados = {!! json_encode($listEstados) !!};

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

        /* imagem de perfil */
        function previewImage(event) {
            const input = event.target;
            const currentImage = document.getElementById('current-image');
            const imagePlaceholder = document.getElementById('image-placeholder');

            if (input.files && input.files[0]) {
                const reader = new FileReader();

                reader.onload = function(e) {
                    currentImage.src = e.target.result;
                    currentImage.style.display = 'inline-block';
                    imagePlaceholder.style.display = 'none';
                }

                reader.readAsDataURL(input.files[0]);
            }
        }

        // Função para abrir o seletor de arquivo quando a imagem é clicada
        function openFileSelector() {
            document.getElementById('image-input').click();
        }
    </script>
</body>
</html>