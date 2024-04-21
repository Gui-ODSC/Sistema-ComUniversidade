<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/cadastrar_ofertas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    {{-- Autocomplete.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Minhas Ofertas</title>
</head>
<body>
    @include('usuarioProfessor.menu')
    <main class="cadastrar-ofertas" id="conteudo">
        <div class="botao-voltar">
            <a title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
        </div>
        <div class="titulo">
            <h1>Cadastrar Oferta</h1>
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
            <div class="section-form">
                <div class="caixa-input" style="width: 100%; margin-bottom: 20px;">
                    <select id="opcao" name="opcao" autocomplete="off" onchange="mostrarFormulario()" required>
                        <option value="" selected></option>
                        <option value="acao">Ação</option>
                        <option value="conhecimento">Conhecimento</option>
                    </select>
                    <label for="opcao">
                        <span>Selecione o tipo de Oferta:</span> 
                    </label>
                </div>
                <div id="formularioAcao" style="display: none; width: 100%;">
                    <form action="{{ route('oferta_create_store_acao') }}" method="POST" style="display: flex; width: 100%; flex-wrap: wrap;">
                        @csrf
                        <div class="caixa-input" style="width: 40%;">
                            @if ($errors->has('titulo') || $errors->has('id_usuario'))
                                <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206); color: black" required>
                                <label for="titulo">
                                    <span>Titulo</span>
                                </label>
                            @else    
                                <input type="text" name="titulo" id="titulo" autocomplete="off" required>
                                <label for="titulo">
                                    <span>Titulo</span>
                                </label>
                            @endif
                        </div>
                        <div class="caixa-input" style="width: 30%; margin-left: 3px">
                            @error('areaConhecimento')
                                <div class="autoComplete_wrapper">  
                                    <input title="{{$message}}" type="text" id="autoCompleteAreaConhecimentoAcao" name="area_conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" required>
                                    <label for="area_conhecimento">
                                        <span>Área Conhecimento</span>
                                    </label>
                                </div>
                            @else
                                <div class="autoComplete_wrapper">  
                                    <input type="text" id="autoCompleteAreaConhecimentoAcao" name="area_conhecimento" autocomplete="off" required>
                                    <label for="area_conhecimento">
                                        <span>Área Conhecimento</span>
                                    </label>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 355px; margin-left: 3px">
                            @error('publico_alvo')
                                <div class="autoComplete_wrapper">  
                                    <input title="{{$message}}" type="text" id="autoCompletePublicoAlvo" name="publico_alvo" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" required>
                                    <label for="publico_alvo">
                                        <span>Publico alvo</span>
                                    </label>
                                </div>
                            @else
                                <div class="autoComplete_wrapper">  
                                    <input type="text" id="autoCompletePublicoAlvo" name="publico_alvo" autocomplete="off" required>
                                    <label for="publico_alvo">
                                        <span>Publico alvo</span>
                                    </label>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 30%;">
                            @error('tipo_acao')
                                <div class="autoComplete_wrapper">  
                                    <input title="{{$message}}" type="text" id="autoCompleteTipoAcao" name="tipo_acao" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" required>
                                    <label for="tipo_acao">
                                        <span>Modalidade da Ação de Extensão</span>
                                    </label>
                                </div>
                            @else
                                <div class="autoComplete_wrapper">  
                                    <input type="text" id="autoCompleteTipoAcao" name="tipo_acao" autocomplete="off" required>
                                    <label for="tipo_acao">
                                        <span>Modalidade da Ação de Extensão</span>
                                    </label>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 35%; margin-left: 3px;">
                            @error('duracao')
                                <select title="{{$message}}" name="duracao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="DIAS">Dias</option>
                                    <option value="SEMANAS">Semanas</option>
                                    <option value="MESES">Meses</option>
                                    <option value="ANOS">Anos</option>
                                    <option value="INDEFINIDO">Indefinido</option>
                                </select>
                                <label for="duracao">
                                    <span>Selecione a duração da demanda</span>
                                </label>
                            @else
                                <select name="duracao" required autocomplete="off">
                                    <option disabled selected></option>
                                    <option value="DIAS">Dias</option>
                                    <option value="SEMANAS">Semanas</option>
                                    <option value="MESES">Meses</option>
                                    <option value="ANOS">Anos</option>
                                    <option value="INDEFINIDO">Indefinido</option>
                                </select>
                                <label for="duracao">
                                    <span>Selecione a duração da demanda</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 417px; margin-left: 3px">
                            @error('data_limite')
                                <input type="date" name="data_limite" placeholder="Dia/Mes/Ano">
                                <label for="data_expiracao">
                                    <span>Data Expiração da Demanda</span>
                                </label>
                            @else
                                <input type="date" name="data_limite" autocomplete="off" placeholder="Dia/Mes/Ano">
                                <label for="data_expiracao">
                                    <span>Data Expiração da Demanda</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="height: 120px; width: 100%;">
                            @error('descricao')
                                <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required></textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição</span>
                                </label>
                            @else
                                <textarea type="text" name="descricao" autocomplete="off" required></textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 50%;">
                            @error('status_registro')
                                <select title="{{$message}}" name="status_registro" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="NAO_REGISTRADA">Não Registrada</option>
                                    <option value="REGISTRADA">Registrada</option>
                                </select>
                                <label for="status_registro">
                                    <span>Selecione o Status de Registro da Oferta:</span>
                                </label>
                            @else
                                <select name="status_registro" autocomplete="off" required>
                                    <option disabled selected></option>
                                    <option value="NAO_REGISTRADA">Não Registrada</option>
                                    <option value="REGISTRADA">Registrada</option>
                                </select>
                                <label for="status_registro">
                                    <span>Selecione o Status de Registro da Oferta:</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 604px; margin-left: 3px">
                            @error('regime')
                                <select title="{{$message}}" name="regime" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="PRESENCIAL">Presencial</option>
                                    <option value="ONLINE">Online</option>
                                </select>
                                <label for="regime">
                                    <span>Selecione o Regime de Aplicação da Oferta:</span>
                                </label>
                            @else
                                <select name="regime" autocomplete="off" required>
                                    <option disabled selected></option>
                                    <option value="PRESENCIAL">Presencial</option>
                                    <option value="ONLINE">Online</option>
                                </select>
                                <label for="regime">
                                    <span>Selecione o Regime de Aplicação da Oferta:</span>
                                </label>
                            @enderror
                        </div>
                        <div class="button_send">
                            <button type="submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div id="formularioConhecimento" style="display: none; width: 100%">
                    <form action="{{ route('oferta_create_store_conhecimento') }}" method="POST" style="display: flex; width: 100%; flex-wrap: wrap;">
                        @csrf
                        <div class="caixa-input" style="width: 40%;">
                            @if ($errors->has('titulo') || $errors->has('id_usuario'))
                                <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206); color: black" required>
                                <label for="titulo">
                                    <span>Titulo</span>
                                </label>
                            @else    
                                <input type="text" name="titulo" id="titulo" autocomplete="off" required>
                                <label for="titulo">
                                    <span>Titulo</span>
                                </label>
                            @endif
                        </div>
                        <div class="caixa-input" style="width: 30%; margin-left: 3px">
                            @error('areaConhecimento')
                                <div class="autoComplete_wrapper">  
                                    <input title="{{$message}}" type="text" id="autoCompleteAreaConhecimento" name="area_conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" required>
                                    <label for="area_conhecimento">
                                        <span>Área Conhecimento</span>
                                    </label>
                                </div>
                            @else
                                <div class="autoComplete_wrapper">  
                                    <input type="text" id="autoCompleteAreaConhecimento" name="area_conhecimento" autocomplete="off" required>
                                    <label for="area_conhecimento">
                                        <span>Área Conhecimento</span>
                                    </label>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 358px; margin-left: 3px">
                            @error('tempo_atuacao')
                                <select title="{{$message}}" name="tempo_atuacao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="MENOS_1_ANO">Menos de 1 Ano</option>
                                    <option value="MAIS_1_ANO">Mais de 1 Ano</option>
                                    <option value="MAIS_3_ANOS">Mais de 3 Anos</option>
                                    <option value="MAIS_5_ANOS">Mais de 5 Anos</option>
                                </select>
                                <label for="tempo_atuacao">
                                    <span>Selecione o Tempo de Atuação:</span>
                                </label>
                            @else
                                <select name="tempo_atuacao" autocomplete="off" required>
                                    <option disabled selected></option>
                                    <option value="MENOS_1_ANO">Menos de 1 Ano</option>
                                    <option value="MAIS_1_ANO">Mais de 1 Ano</option>
                                    <option value="MAIS_3_ANOS">Mais de 3 Anos</option>
                                    <option value="MAIS_5_ANOS">Mais de 5 Anos</option>
                                </select>
                                <label for="tempo_atuacao">
                                    <span>Selecione o Tempo de Atuação:</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="height: 120px; width: 100%;">
                            @error('descricao')
                                <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required></textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição</span>
                                </label>
                            @else
                                <textarea type="text" name="descricao" autocomplete="off" required></textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 50%;">
                            @error('link_lattes')
                                <input title="{{$message}}" type="text" name="link_lattes" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" required>
                                <label for="link_lattes">
                                    <span>Link Lattes</span>
                                </label>
                            @else
                                <input type="text" name="link_lattes" autocomplete="off" required>
                                <label for="link_lattes">
                                    <span>Link Lattes</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 604px; margin-left: 3px">
                            @error('link_linkedin')
                                <input title="{{$message}}" type="text" name="link_linkedin" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" required>
                                <label for="link_linkedin">
                                    <span>Link Linkedin</span>
                                </label>
                            @else
                                <input type="text" name="link_linkedin" autocomplete="off" required>
                                <label for="link_linkedin">
                                    <span>Link Linkedin</span>
                                </label>
                            @enderror
                        </div>
                        <div class="button_send">
                            <button type="submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
            </div>            
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
        <script>

            function goBack() {
                window.history.back();
            }

            // Variável PHP contendo os bairros
            const listAreaConhecimento = {!! json_encode($listAreaConhecimento) !!};
            
            // Variável PHP contendo os bairros
            const listPublicoAlvo = {!! json_encode($listPublicoAlvo) !!};

            // Variável PHP contendo os bairros
            const listTipoAcao = {!! json_encode($listTipoAcao) !!};

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
                    onSelection: onSelectionCallback,
                    resultsList: {
                        position: "afterend",
                        maxResults: 10,
                        noResults: true,
                        tabSelect: true
                    },
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
            // Inicializar o autocomplete para as áreas de conhecimento
            inicializarAutoComplete(listAreaConhecimento, "#autoCompleteAreaConhecimentoAcao", feedback => {
                const areaConhecimento = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompleteAreaConhecimentoAcao');
                autoCompleteInput.value = areaConhecimento.nome;
            });

            // Inicializar o autocomplete para as áreas de conhecimento
            inicializarAutoComplete(listAreaConhecimento, "#autoCompleteAreaConhecimento", feedback => {
                const areaConhecimento = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompleteAreaConhecimento');
                autoCompleteInput.value = areaConhecimento.nome;
            });

            // Inicializar o autocomplete para os públicos-alvo
            inicializarAutoComplete(listPublicoAlvo, "#autoCompletePublicoAlvo", feedback => {
                const publicoAlvo = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompletePublicoAlvo');
                autoCompleteInput.value = publicoAlvo.nome;
            });

            // Inicializar o autocomplete para os públicos-alvo
            inicializarAutoComplete(listTipoAcao, "#autoCompleteTipoAcao", feedback => {
                const tipoAcao = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompleteTipoAcao');
                autoCompleteInput.value = tipoAcao.nome;
            });

            /* opcao SELECT */
            function mostrarFormulario() {
                var opcao = document.getElementById("opcao").value;

                // Esconde todos os formulários
                document.getElementById("formularioAcao").style.display = "none";
                document.getElementById("formularioConhecimento").style.display = "none";

                // Mostra o formulário correspondente à opção selecionada
                if (opcao === "acao") {
                    document.getElementById("formularioAcao").style.display = "block";
                } else if (opcao === "conhecimento") {
                    document.getElementById("formularioConhecimento").style.display = "block";
                }
            }
            
        </script>
    </main>
</body>
</html>