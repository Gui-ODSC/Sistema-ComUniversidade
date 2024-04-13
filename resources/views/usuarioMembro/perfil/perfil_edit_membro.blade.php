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
    @include('menu')
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
            <form action="{{ route('perfil_edit_store', $usuario->id_usuario) }}" method="POST">
                @csrf
                <div class="cadastro-container" style="display: flex;">
                    <div class="section-form">
                        <div id="container">
                            <img src="{{ asset('img/foto_usuario_perfil/perfil_foto.jpeg') }}" alt="foto perfil" id="imagem">
                            <input type="file" id="arquivo" accept=".jpg, .jpeg, .png" onchange="mostrarImagem()">
                        </div>
                        <div style="width: 81%; display: flex; flex-wrap: wrap">
                        {{-- NOME --}}
                        <div class="caixa-input" style="width: 30%;">
                            @error('nome')
                                <input title="{{ $message }}" class="alert-danger" type="text" id="nome" name="nome" autocomplete="off" value="{{ $usuario->nome }}"  style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                                <input title="{{ $message }}" class="alert-danger" type="text" id="sobrenome" name="sobrenome" value="{{ $usuario->sobrenome }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                                <input title="{{ $message }}" class="alert-danger" type="email" id="email" name="email" autocomplete="off" value="{{ $usuario->email }}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                                <input title="{{ $message }}" class="alert-danger" type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario}}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
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
                                <input title="{{ $message }}" class="alert-danger" type="text" id="telefone" value="{{ $usuario->telefone }}" name="telefone" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                                <input title="{{ $message }}" class="alert-danger" type="password" id="password" placeholder="Digite aqui a nova Senha" name="password" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
                                <label for="password">
                                    <span>Alterar Senha</span>
                                </label>
                            @else
                                <input type="password" id="password" name="password" placeholder="Digite aqui a nova Senha">
                                <label for="password">
                                    <span>Alterar Senha</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 472px; margin-left: 3px;">
                            {{-- CIDADE --}}
                            @error('cidade')
                                <input title="{{ $message }}" class="cidade alert-danger" type="text" name="nome_cidade" autocomplete="off" value="{{ $cidade->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                                <label for="nome_cidade">
                                    <span>Cidade</span>
                                </label>
                            @else
                                <input type="text" id="autoCompleteCidade" name="nome_cidade" autocomplete="off" value="{{ $cidade->nome }}" required>
                                <label for="nome_cidade">
                                    <span>Cidade</span>
                                </label>
                            @enderror
                        </div>
                    </div>
                    <div class="caixa-input" style="width: 40%;">
                        {{-- RUA --}}
                        @error('rua')
                            <input title="{{ $message }}" class="alert-danger" type="text" id="rua" name="rua" value="{{ $endereco->rua }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                            <input title="{{ $message }}" class="alert-danger" type="number" id="numero" name="numero" value="{{ $endereco->numero }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                            <input title="{{ $message }}" class="alert-danger" type="text" id="complemento" name="complemento" value="{{ $endereco->complemento }}" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
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
                                <input title="{{ $message }}" type="text" id="autoCompleteEstado" class="estado alert-danger" name="nome_estado" tabindex="1" autocomplete="off" value="{{ $estado->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
                                <input type="text" id="autoCompleteBairro" class="bairro alert-danger" name="nome_bairro" autocomplete="off" value="{{ $bairro->nome }}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
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
    </script>
</body>
</html>