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
    {{-- AUTOCOMPLETE --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>
    {{-- CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/editar_demandas.css') }}">
    <title>Editar Demanda</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="cadastrar-demandas" id="conteudo">
        <div class="botao-voltar">
            <a title="Voltar" onclick="goBack()"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
        </div>
        <div class="titulo">
            <h1>Editar Necessidade</h1>
        </div>
        <form action="{{ route('demanda_edit_store', $demanda->id_demanda) }}" method="POST">
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
                <div class="caixa-input" style="width: 60%;">
                    @if ($errors->has('titulo') || $errors->has('id_usuario'))
                        <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206); color: black" required maxlength="150">
                        <label for="titulo">
                            <span>Titulo *</span>
                        </label>
                    @else    
                        <input type="text" name="titulo" value="{{ $demanda->titulo }}" required maxlength="150">
                        <label for="titulo">
                            <span>Titulo *</span>
                        </label>
                    @endif
                </div>
                <div class="caixa-input" style="width: 482px; margin-left: 3px">
                    @error('publico_alvo')
                        <label for="publico_alvo" style="z-index: 1">
                            <span>Publico alvo *</span>
                        </label>
                        <div class="publicoAlvo">
                            <input class="selectpicker" data-live-search="true" title="{{$message}}" type="text" name="publico_alvo" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="70">
                                <option value="" selected disabled>Selecione aqui</option>
                                @foreach ($listPublicoAlvo as $publicoAlvoElement)
                                    <option value="{{$publicoAlvoElement->nome}}" {{ $publicoAlvo->nome === $publicoAlvoElement->nome ? 'selected' : '' }}>{{ $publicoAlvoElement->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <label for="publico_alvo" style="z-index: 1">
                            <span>Publico alvo *</span>
                        </label>
                        <div class="publicoAlvo">
                            <select class="selectpicker" data-live-search="true" name="publico_alvo" required maxlength="70">
                                <option value="" selected disabled>Selecione aqui</option>
                                @foreach ($listPublicoAlvo as $publicoAlvoElement)
                                    <option value="{{$publicoAlvoElement->nome}}" {{ $publicoAlvo->nome === $publicoAlvoElement->nome ? 'selected' : '' }}>{{ $publicoAlvoElement->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%">
                    @error('areaConhecimento')
                        <label for="area_conhecimento" style="z-index: 1">
                            <span>Área Conhecimento *</span>
                        </label>
                        <div class="areaConhecimento">
                            <input class="selectpicker" data-live-search="true" title="{{$message}}" type="text" name="area_conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="70">
                                <option value="" selected disabled>Selecione aqui</option>
                                @foreach ($listPublicoAlvo as $areaConhecimentoElement)
                                    <option value="{{$areaConhecimentoElement->nome}}" {{ $areaConhecimento->nome === $areaConhecimentoElement->nome ? 'selected' : '' }}>{{ $areaConhecimentoElement->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @else
                        <label for="area_conhecimento" style="z-index: 1">
                            <span>Área Conhecimento *</span>
                        </label>
                        <div class="areaConhecimento">
                            <select class="selectpicker" data-live-search="true" name="area_conhecimento" required maxlength="70">
                                <option value="" selected disabled>Selecione aqui</option>
                                @foreach ($listAreaConhecimento as $areaConhecimentoElement)
                                    <option value="{{$areaConhecimentoElement->nome}}" {{ $areaConhecimento->nome === $areaConhecimentoElement->nome ? 'selected' : '' }}>{{ $areaConhecimentoElement->nome }}</option>
                                @endforeach
                            </select>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 603px; margin-left: 3px">
                    @error('pessoas_afetadas')
                        <input title="{{$message}}" type="number" name="pessoas_afetadas" onkeypress="return event.charCode >= 48 && event.charCode <= 57" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="10">
                        <label for="pessoas_afetadas">
                            <span>Pessoas atingidas (apenas números) *</span>
                        </label>
                    @else
                        <input type="number" name="pessoas_afetadas" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ $demanda->pessoas_afetadas }}" required maxlength="10">
                        <label for="pessoas_afetadas">
                            <span>Pessoas atingidas (apenas números) *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="height: 120px; width: 100%;">
                    @error('descricao')
                        <textarea title="{{$message}}" type="text" name="descricao" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required maxlength="500"></textarea>
                        <label id="campo-label" for="descricao">
                            <span id="campo-spam">Descrição *</span>
                        </label>
                    @else
                        <textarea type="text" name="descricao" required maxlength="500">{{ $demanda->descricao }}</textarea>
                        <label id="campo-label" for="descricao">
                            <span id="campo-spam">Descrição *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%">
                    @error('duracao')
                        <select title="{{$message}}" name="duracao" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <option disabled></option>
                            <option value="DIAS" {{ $demanda->duracao === 'DIAS' ? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ $demanda->duracao === 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ $demanda->duracao === 'MESES' ? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ $demanda->duracao === 'ANOS' ? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ $demanda->duracao === 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                        </select>
                        <label for="duracao">
                            <span>Selecione a duração da necessidade *</span>
                        </label>
                    @else
                        <select name="duracao" required>
                            <option disabled></option>
                            <option value="DIAS" {{ $demanda->duracao === 'DIAS' ? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ $demanda->duracao === 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ $demanda->duracao === 'MESES' ? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ $demanda->duracao === 'ANOS' ? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ $demanda->duracao === 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                        </select>
                        <label for="duracao">
                            <span>Selecione a duração da necessidade *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%; margin-left: 3px">
                    @error('nivel_prioridade')
                        <select title="{{$message}}" name="nivel_prioridade" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" required>
                            <option disabled selected></option>
                            <option value="BAIXO" {{ $demanda->nivel_prioridade === 'BAIXO'? 'selected' : '' }}>Baixo</option>
                            <option value="MEDIO" {{ $demanda->nivel_prioridade === 'MEDIO'? 'selected' : '' }}>Medio</option>
                            <option value="ALTO" {{ $demanda->nivel_prioridade === 'ALTO'? 'selected' : '' }}>Alto</option>
                        </select>
                        <label for="nivel_prioridade">
                            <span>Selecione o nível de prioridade da necessidade *</span>
                        </label>
                    @else
                        <select name="nivel_prioridade" required>
                            <option disabled selected></option>
                            <option value="BAIXO" {{ $demanda->nivel_prioridade === 'BAIXO'? 'selected' : '' }}>Baixo</option>
                            <option value="MEDIO" {{ $demanda->nivel_prioridade === 'MEDIO'? 'selected' : '' }}>Medio</option>
                            <option value="ALTO" {{ $demanda->nivel_prioridade === 'ALTO'? 'selected' : '' }}>Alto</option>
                        </select>
                        <label for="nivel_prioridade">
                            <span>Selecione o nível de prioridade da necessidade *</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 358px; margin-left: 3px">
                    @error('instituicao_setor')
                        <input title="{{$message}}" type="text" name="instituicao_setor" style="border: 1px solid red; background-color:rgb(235, 201, 206); color: black" maxlength="70">
                        <label for="instituicao_setor">
                            <span>Instituição</span>
                        </label>
                    @else
                        <input type="text" name="instituicao_setor" value="{{ $demanda->instituicao_setor ?? '' }}" maxlength="70">
                        <label for="instituicao_setor">
                            <span>Instituição</span>
                        </label>
                    @enderror
                </div>
                <div class="button_send">
                    <button type="submit">Salvar</button>
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