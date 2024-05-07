<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    {{-- CLOUDFLARE --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    {{-- SELECTPICKER --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.6/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.6/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/cadastrar_ofertas.css') }}">
    {{-- JS --}}
    <script src="{{ asset('js/usuarioProfessor/oferta/modal_ajuda_oferta.js') }}"></script>
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
        <div class="container-botoes">
            <div class="botao-voltar">
                <a title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
            </div>
            <div class="botao-ajuda-ofertas">
                <button onclick="openModalAjudaOferta({{$usuarioProfessor}})">(?) Tipo de Ofertas</button>
                <x-usuario-professor.oferta.modal-ajuda-oferta :id-usuario="$usuarioProfessor"/>
            </div>
        </div>
        <div class="titulo">
            <h1>Cadastrar Oferta</h1>
        </div>
        @if($errors->any())
            <div class="alert alert-danger" style="margin-top: 10px; font-size: 15px">
                <ul>
                    @foreach ($errors->all() as $error)
                        @if ($error)
                            <p style="margin-bottom: 5px">{{ $error }}</p>
                        @endif
                    @endforeach
                </ul>
            </div>
        @endif
            <div class="section-form">
                <div class="caixa-input" style="width: 100%; margin-bottom: 20px;">
                    <select id="opcao" name="opcao" autocomplete="off" onchange="mostrarFormulario()" required>
                        <option value=""></option>
                        <option value="acao" {{ old('opcao') == "acao" ? 'selected' : '' }}>Ação</option>
                        <option value="conhecimento" {{ old('opcao') == "conhecimento" ? 'selected' : '' }}">Conhecimento</option>
                    </select>
                    <label for="opcao">
                        <span>Selecione o tipo de Oferta:</span> 
                    </label>
                </div>
                <div id="formularioAcao" style="{{ old('opcao') === 'acao' ? 'display: block;' : 'display: none; width: 100%' }}">
                    <form action="{{ route('oferta_create_store_acao') }}" method="POST" style="display: flex; width: 100%; flex-wrap: wrap;">
                        @csrf
                        <input type="hidden" id="opcaoSelecionadaAcao" name="opcao" value="acao">
                        <div class="caixa-input" style="width: 40%;">
                            @if ($errors->has('titulo') || $errors->has('id_usuario'))
                                <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206); color: black" required maxlength="150" value="{{old('titulo')}}">
                                <label for="titulo">
                                    <span>Titulo *</span>
                                </label>
                            @else    
                                <input type="text" name="titulo" id="titulo" autocomplete="off" required maxlength="150" value="{{old('titulo')}}">
                                <label for="titulo">
                                    <span>Titulo *</span>
                                </label>
                            @endif
                        </div>
                        <div class="caixa-input" style="width: 30%; margin-left: 3px">
                            @error('id_area_conhecimento')
                                <label for="area_conhecimento" style="z-index: 1">
                                    <span>Área Conhecimento *</span>
                                </label>
                                <div class="areaConhecimentoAcao">
                                    <select class="selectpicker" data-live-search="true" title="{{$message}}" name="area_conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="70">
                                        <option value="" selected disabled>Selecione aqui</option>
                                        @foreach ($listAreaConhecimento as $areaConhecimento)
                                            <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <label for="area_conhecimento" style="z-index: 1">
                                    <span>Área Conhecimento *</span>
                                </label>
                                <div class="areaConhecimentoAcao">
                                    <select class="selectpicker" data-live-search="true" name="area_conhecimento" required maxlength="70">
                                        <option value="" selected disabled>Selecione aqui</option>
                                        @foreach ($listAreaConhecimento as $areaConhecimento)
                                            <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 356px; margin-left: 3px">
                            @error('id_publico_alvo')
                                <label for="publico_alvo" style="z-index: 1">
                                    <span>Publico alvo *</span>
                                </label>
                                <div class="publicoAlvo">
                                    <select class="selectpicker" data-live-search="true" title="{{$message}}" name="publico_alvo" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="70">
                                        <option value="" selected disabled>Selecione aqui</option>
                                        @foreach ($listPublicoAlvo as $publicoAlvo)
                                            <option value="{{$publicoAlvo->nome}}" {{ old('publico_alvo') == $publicoAlvo->nome ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <label for="publico_alvo" style="z-index: 1">
                                    <span>Publico alvo *</span>
                                </label>
                                <div class="publicoAlvo">
                                    <select class="selectpicker" data-live-search="true" name="publico_alvo" required maxlength="70" value="{{old('publico_alvo')}}">
                                        <option value="" selected disabled>Selecione aqui</option>
                                        @foreach ($listPublicoAlvo as $publicoAlvo)
                                            <option value="{{$publicoAlvo->nome}}" {{ old('publico_alvo') == $publicoAlvo->nome ? 'selected' : '' }}>{{ $publicoAlvo->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 30%;">
                            @error('tipo_acao')
                                <select title="{{$message}}" name="tipo_acao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="Curso" {{ old('tipo_acao') == 'Curso' ? 'selected' : '' }}>Curso</option>
                                    <option value="Projeto" {{ old('tipo_acao') == 'Projeto' ? 'selected' : '' }}>Projeto</option>
                                    <option value="Programa" {{ old('tipo_acao') == 'Programa' ? 'selected' : '' }}>Programa</option>
                                    <option value="Evento" {{ old('tipo_acao') == 'Evento' ? 'selected' : '' }}>Evento</option>
                                </select>
                                <label for="tipo_acao">
                                    <span>Selecione a duração da oferta *</span>
                                </label>
                            @else
                                <select name="tipo_acao" required autocomplete="off">
                                    <option disabled selected></option>
                                    <option value="Curso" {{ old('tipo_acao') == 'Curso' ? 'selected' : '' }}>Curso</option>
                                    <option value="Projeto" {{ old('tipo_acao') == 'Projeto' ? 'selected' : '' }}>Projeto</option>
                                    <option value="Programa" {{ old('tipo_acao') == 'Programa' ? 'selected' : '' }}>Programa</option>
                                    <option value="Evento" {{ old('tipo_acao') == 'Evento' ? 'selected' : '' }}>Evento</option>
                                </select>
                                <label for="tipo_acao">
                                    <span>Selecione a duração da oferta *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 35%; margin-left: 3px;">
                            @error('duracao')
                                <select title="{{$message}}" name="duracao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                                    <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                                    <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                                    <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                                    <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                                </select>
                                <label for="duracao">
                                    <span>Selecione a duração da oferta *</span>
                                </label>
                            @else
                                <select name="duracao" required autocomplete="off">
                                    <option disabled selected></option>
                                    <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                                    <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                                    <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                                    <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                                    <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                                </select>
                                <label for="duracao">
                                    <span>Selecione a duração da oferta *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 418px; margin-left: 3px">
                            @error('data_limite')
                                <input type="date" name="data_limite" placeholder="Dia/Mes/Ano" min="{{ date('Y-m-d') }}" value="{{old('data_limite')}}">
                                <label for="data_expiracao">
                                    <span>Data Expiração da Oferta</span>
                                </label>
                            @else
                                <input type="date" name="data_limite" autocomplete="off" placeholder="Dia/Mes/Ano" min="{{ date('Y-m-d') }}" value="{{old('data_limite')}}s>
                                <label for="data_expiracao">
                                    <span>Data Expiração da Oferta</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="height: 120px; width: 100%;">
                            @error('descricao')
                                <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="500">{{old('descricao')}}</textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição *</span>
                                </label>
                            @else
                                <textarea type="text" name="descricao" autocomplete="off" required maxlength="500">{{old('descricao')}}</textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 50%;">
                            @error('status_registro')
                                <select title="{{$message}}" name="status_registro" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="NAO_REGISTRADA" {{ old('status_registro') == 'NAO_REGISTRADA' ? 'selected' : '' }}>Não Registrada</option>
                                    <option value="REGISTRADA" {{ old('status_registro') == 'REGISTRADA' ? 'selected' : '' }}>Registrada</option>
                                </select>
                                <label for="status_registro">
                                    <span>Selecione o Status de Registro da Oferta *</span>
                                </label>
                            @else
                                <select name="status_registro" autocomplete="off" required>
                                    <option disabled selected></option>
                                    <option value="NAO_REGISTRADA" {{ old('status_registro') == 'NAO_REGISTRADA' ? 'selected' : '' }}>Não Registrada</option>
                                    <option value="REGISTRADA" {{ old('status_registro') == 'REGISTRADA' ? 'selected' : '' }}>Registrada</option>
                                </select>
                                <label for="status_registro">
                                    <span>Selecione o Status de Registro da Oferta *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 604px; margin-left: 3px">
                            @error('regime')
                                <select title="{{$message}}" name="regime" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="PRESENCIAL" {{ old('regime') == 'PRESENCIAL' ? 'selected' : '' }}>Presencial</option>
                                    <option value="ONLINE" {{ old('regime') == 'ONLINE' ? 'selected' : '' }}>Online</option>
                                </select>
                                <label for="regime">
                                    <span>Selecione o Regime de Aplicação da Oferta *</span>
                                </label>
                            @else
                                <select name="regime" autocomplete="off" required>
                                    <option disabled selected></option>
                                    <option value="PRESENCIAL" {{ old('regime') == 'PRESENCIAL' ? 'selected' : '' }}>Presencial</option>
                                    <option value="ONLINE" {{ old('regime') == 'ONLINE' ? 'selected' : '' }}>Online</option>
                                </select>
                                <label for="regime">
                                    <span>Selecione o Regime de Aplicação da Oferta *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="button_send">
                            <button type="submit">Cadastrar</button>
                        </div>
                    </form>
                </div>
                <div id="formularioConhecimento" style="{{ old('opcao') === 'conhecimento' ? 'display: block;' : 'display: none; width: 100%' }}">
                    <form action="{{ route('oferta_create_store_conhecimento') }}" method="POST" style="display: flex; width: 100%; flex-wrap: wrap;">
                        @csrf
                        <input type="hidden" id="opcaoSelecionadaConhecimento" name="opcao" value="conhecimento">
                        <div class="caixa-input" style="width: 40%;">
                            @if ($errors->has('titulo') || $errors->has('id_usuario'))
                                <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206); color: black" required maxlength="150" {{old('titulo')}}>
                                <label for="titulo">
                                    <span>Titulo *</span>
                                </label>
                            @else    
                                <input type="text" name="titulo" id="titulo" autocomplete="off" required maxlength="150" {{old('titulo')}}>
                                <label for="titulo">
                                    <span>Titulo *</span>
                                </label>
                            @endif
                        </div>
                        <div class="caixa-input" style="width: 30%; margin-left: 3px">
                            @error('id_area_conhecimento')
                                <label for="area_conhecimento" style="z-index: 1">
                                    <span>Área Conhecimento *</span>
                                </label>
                                <div class="areaConhecimentoAcao">
                                    <select class="selectpicker" data-live-search="true" title="{{$message}}" name="area_conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="70">
                                        <option value="" selected disabled>Selecione aqui</option>
                                        @foreach ($listAreaConhecimento as $areaConhecimento)
                                            <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @else
                                <label for="area_conhecimento" style="z-index: 1">
                                    <span>Área Conhecimento *</span>
                                </label>
                                <div class="areaConhecimentoAcao">
                                    <select class="selectpicker" data-live-search="true" name="area_conhecimento" required maxlength="70">
                                        <option value="" selected disabled>Selecione aqui</option>
                                        @foreach ($listAreaConhecimento as $areaConhecimento)
                                            <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 358px; margin-left: 3px">
                            @error('tempo_atuacao')
                                <select title="{{$message}}" name="tempo_atuacao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                                    <option disabled selected></option>
                                    <option value="MENOS_1_ANO" {{ old('tempo_atuacao') == 'MENOS_1_ANO' ? 'selected' : '' }}>Menos de 1 Ano</option>
                                    <option value="MAIS_1_ANO" {{ old('tempo_atuacao') == 'MAIS_1_ANO' ? 'selected' : '' }}>Mais de 1 Ano</option>
                                    <option value="MAIS_3_ANOS" {{ old('tempo_atuacao') == 'MAIS_3_ANOS' ? 'selected' : '' }}>Mais de 3 Anos</option>
                                    <option value="MAIS_5_ANOS" {{ old('tempo_atuacao') == 'MAIS_5_ANOS' ? 'selected' : '' }}>Mais de 5 Anos</option>
                                </select>
                                <label for="tempo_atuacao">
                                    <span>Selecione o Tempo de Atuação *</span>
                                </label>
                            @else
                                <select name="tempo_atuacao" autocomplete="off" required>
                                    <option disabled selected></option>
                                    <option value="MENOS_1_ANO" {{ old('tempo_atuacao') == 'MENOS_1_ANO' ? 'selected' : '' }}>Menos de 1 Ano</option>
                                    <option value="MAIS_1_ANO" {{ old('tempo_atuacao') == 'MAIS_1_ANO' ? 'selected' : '' }}>Mais de 1 Ano</option>
                                    <option value="MAIS_3_ANOS" {{ old('tempo_atuacao') == 'MAIS_3_ANOS' ? 'selected' : '' }}>Mais de 3 Anos</option>
                                    <option value="MAIS_5_ANOS" {{ old('tempo_atuacao') == 'MAIS_5_ANOS' ? 'selected' : '' }}>Mais de 5 Anos</option>
                                </select>
                                <label for="tempo_atuacao">
                                    <span>Selecione o Tempo de Atuação *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="height: 120px; width: 100%;">
                            @error('descricao')
                                <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="500">{{old('descricao')}}</textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição *</span>
                                </label>
                            @else
                                <textarea type="text" name="descricao" autocomplete="off" required maxlength="500">{{old('descricao')}}</textarea>
                                <label id="campo-label" for="descricao">
                                    <span id="campo-spam">Descrição *</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 50%;">
                            @error('link_lattes')
                                <input title="{{$message}}" type="text" name="link_lattes" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" maxlength="255" {{old('link_lattes')}}>
                                <label for="link_lattes">
                                    <span>Link Lattes</span>
                                </label>
                            @else
                                <input type="text" name="link_lattes" autocomplete="off" maxlength="255" {{old('link_lattes')}}>
                                <label for="link_lattes">
                                    <span>Link Lattes</span>
                                </label>
                            @enderror
                        </div>
                        <div class="caixa-input" style="width: 604px; margin-left: 3px">
                            @error('link_linkedin')
                                <input title="{{$message}}" type="text" name="link_linkedin" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" autocomplete="off" maxlength="255" {{old('link_linkedin')}}>
                                <label for="link_linkedin">
                                    <span>Link Linkedin</span>
                                </label>
                            @else
                                <input type="text" name="link_linkedin" autocomplete="off" maxlength="255" {{old('link_linkedin')}}>
                                <label for="link_linkedin">
                                    <span>Link Linkedin</span>
                                </label>
                            @enderror
                        </div>
                        <div class="button_send">
                            <button type="submit">Cadastrar *</button>
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


            function mostrarFormulario() {
                var opcaoSelecionada = document.getElementById("opcao").value;

                // Esconder todos os formulários
                document.getElementById("formularioAcao").style.display = "none";
                document.getElementById("formularioConhecimento").style.display = "none";

                // Exibir o formulário correspondente à opção selecionada
                if (opcaoSelecionada === "acao") {
                    document.getElementById("formularioAcao").style.display = "block";
                } else if (opcaoSelecionada === "conhecimento") {
                    document.getElementById("formularioConhecimento").style.display = "block";
                }
            }

        </script>
    </main>
</body>
</html>