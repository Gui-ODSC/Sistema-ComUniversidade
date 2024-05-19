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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.8/dist/js/bootstrap-select.min.js"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.6/css/bootstrap-select.min.css" rel="stylesheet" />
    <link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.3.1/css/bootstrap.min.css" rel="stylesheet" />
    {{-- Autocomplete.JS --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/cadastrar_demandas.css') }}">
    <title>Minhas Demandas</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="cadastrar-demandas" id="conteudo">
        <div class="botao-voltar">
            <a title="Voltar" onclick="goBack()" href="{{ route('demanda_index') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
        </div>
        <div class="titulo">
            <h1>Cadastrar Necessidade</h1>
        </div>
        <form action="{{ route('demanda_create_store') }}" method="POST">
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
                @csrf
                <div class="caixa-input" style="width: 60%; padding-right: 3px">
                    @if ($errors->has('titulo') || $errors->has('id_usuario'))
                        <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206); color: black" required maxlength="80" value="{{old('titulo')}}">
                        <label for="titulo">
                            <span style="color: black">Titulo *</span>
                        </label>
                    @else    
                        <input type="text" name="titulo" autocomplete="off" required maxlength="80" value="{{old('titulo')}}">
                        <label for="titulo">
                            <span>Titulo *</span>
                        </label>
                    @endif
                </div>
                <div class="caixa-input" style="width: 40%;">
                    @error('publico_alvo')
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
                {{--  --}}
                <div class="caixa-input" style="width: 50%; padding-right: 3px">
                    @error('area_conhecimento')
                        <label for="area_conhecimento" style="z-index: 1">
                            <span>Área conhecimento *</span>
                        </label>
                        <div class="areaConhecimento">
                            <select class="selectpicker" data-live-search="true" title="{{$message}}" name="area_conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="70">
                                <option value="" selected disabled>Selecione aqui</option>
                                @foreach ($listAreaConhecimento as $areaConhecimento)
                                    <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <label for="area_conhecimento" style="z-index: 1">
                            <span>Área conhecimento *</span>
                        </label>
                        <div class="areaConhecimento">
                            <select class="selectpicker areaConhecimento" data-live-search="true" name="area_conhecimento" required maxlength="70" value="{{old('area_conhecimento')}}">
                                <option value="" selected disabled>Selecione aqui</option>
                                @foreach ($listAreaConhecimento as $areaConhecimento)
                                    <option value="{{$areaConhecimento->nome}}" {{ old('area_conhecimento') == $areaConhecimento->nome ? 'selected' : '' }}>{{ $areaConhecimento->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @enderror
                </div>
                {{--  --}}
                <div class="caixa-input" style="width: 50%;">
                    @error('pessoas_afetadas')
                        <input title="{{$message}}" type="number" name="pessoas_afetadas" min="0" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="10" value="{{old('pessoas_afetadas')}}">
                        <label for="pessoas_afetadas">
                            <span style="color: black">Pessoas atingidas (apenas números) *</span>
                        </label>
                    @else
                        <input type="number" name="pessoas_afetadas" min="0" autocomplete="off" onkeypress="return event.charCode >= 48 && event.charCode <= 57" required maxlength="10" value="{{old('pessoas_afetadas')}}">
                        <label for="pessoas_afetadas">
                            <span>Pessoas atingidas (apenas números) *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="height: 120px; width: 100%;">
                    @error('descricao')
                        <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="500">{{old('descricao')}}</textarea>
                        <label id="campo-label" for="descricao">
                            <span id="campo-spam" style="color: black">Descrição *</span>
                        </label>
                    @else
                        <textarea type="text" name="descricao" autocomplete="off" required maxlength="500">{{old('descricao')}}</textarea>
                        <label id="campo-label" for="descricao">
                            <span id="campo-spam">Descrição *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%; padding-right: 3px">
                    @error('duracao')
                        <select title="{{$message}}" name="duracao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required value="{{old('duracao')}}">
                            <option disabled selected></option>
                            <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                        </select>
                        <label for="duracao">
                            <span style="color: black">Selecione a duração da necessidade *</span>
                        </label>
                    @else
                        <select name="duracao" autocomplete="off" required value="{{old('duracao')}}">
                            <option disabled selected></option>
                            <option value="DIAS" {{ old('duracao') == 'DIAS' ? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ old('duracao') == 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ old('duracao') == 'MESES' ? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ old('duracao') == 'ANOS' ? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ old('duracao') == 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                        </select>
                        <label for="duracao">
                            <span>Selecione a duração da necessidade *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%; padding-right: 3px">
                    @error('nivel_prioridade')
                        <select title="{{$message}}" name="nivel_prioridade" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required value="{{old('nivel_prioridade')}}">
                            <option disabled selected></option>
                            <option value="BAIXO" {{ old('nivel_prioridade') == 'BAIXO' ? 'selected' : '' }}>Baixo</option>
                            <option value="MEDIO" {{ old('nivel_prioridade') == 'MEDIO' ? 'selected' : '' }}>Medio</option>
                            <option value="ALTO" {{ old('nivel_prioridade') == 'ALTO' ? 'selected' : '' }}>Alto</option>
                        </select>
                        <label for="nivel_prioridade">
                            <span style="color: black">Selecione o nível de prioridade da necessidade *</span>
                        </label>
                    @else
                        <select name="nivel_prioridade" autocomplete="off" required value="{{old('nivel_prioridade')}}">
                            <option disabled selected></option>
                            <option value="BAIXO" {{ old('nivel_prioridade') == 'BAIXO' ? 'selected' : '' }}>Baixo</option>
                            <option value="MEDIO" {{ old('nivel_prioridade') == 'MEDIO' ? 'selected' : '' }}>Medio</option>
                            <option value="ALTO" {{ old('nivel_prioridade') == 'ALTO' ? 'selected' : '' }}>Alto</option>

                        </select>
                        <label for="nivel_prioridade">
                            <span>Selecione o nível de prioridade da necessidade *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%;">
                    @error('instituicao_setor')
                        <input title="{{$message}}" type="text" name="instituicao_setor" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" maxlength="70" value="{{old('instituicao_setor')}}">
                        <label for="instituicao_setor">
                            <span style="color: black">Instituição</span>
                        </label>
                    @else
                        <input type="text" name="instituicao_setor" autocomplete="off" maxlength="70" value="{{old('instituicao_setor')}}">
                        <label for="instituicao_setor">
                            <span>Instituição</span>
                        </label>
                    @enderror
                </div>
                <div class="button_send">
                    <button type="submit">Cadastrar</button>
                </div>
            </div>
        </form>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
        <script>

            function goBack() {
                window.history.back();
            }
            // Variável PHP contendo os bairros
            const listPublicoAlvo = {!! json_encode($listPublicoAlvo) !!};
    
            // Variável PHP contendo os bairros
            const listAreaConhecimento = {!! json_encode($listAreaConhecimento) !!};
    
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
            
            
        </script>
    </main>
</body>
</html>