<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioMembro/demanda/editar_demandas.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- AUTOCOMPLETE --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <title>Editar Demanda</title>
</head>
<body>
    @include('menu')
    <main class="cadastrar_demandas" id="conteudo">
        <h1>Editar Demanda</h1>
        <form action="{{ route('demanda_edit_store', $demanda->id_demanda) }}" method="POST">
            @csrf
            @if($errors->has('dados'))
                <div class="msg-erro fade-effect-error" id="error-message-email">
                    @foreach ($errors->get('dados') as $dado)
                        <p style="display: flex width: 651px">{{ $dado }}</p>
                        <br>
                    @endforeach
                </div>
            @endif
            @if ($errors->has('titulo') || $errors->has('id_usuario'))
                <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" placeholder="Titulo" style="border: 1px solid red; background-color: rgb(235, 201, 206)" required>
            @else    
                <input type="text" name="titulo" placeholder="Titulo" value="{{ $demanda->titulo }}" required>
            @endif
            @error('publico_alvo')
                <div class="autoComplete_wrapper">
                    <input title="{{$message}}" type="text" id="autoCompletePublicoAlvo" name="publico_alvo" placeholder="Publico Alvo da Ação" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                </div>
            @else
                <div class="autoComplete_wrapper">
                    <input type="text" id="autoCompletePublicoAlvo" name="publico_alvo" value="{{ $publicoAlvo->nome }}" placeholder="Publico Alvo da Ação" autocomplete="off" required>
                </div>
            @enderror
            @error('areaConhecimento')
                <div class="autoComplete_wrapper">
                    <input title="{{$message}}" type="text" id="autoCompleteAreaConhecimento" name="area_conhecimento" placeholder="Área de Conhecimento" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                </div>
            @else
                <div class="autoComplete_wrapper">
                    <input type="text" id="autoCompleteAreaConhecimento" name="area_conhecimento" value="{{ $areaConhecimento->nome }}" placeholder="Área de Conhecimento" autocomplete="off" required>
                </div>
            @enderror
            @error('descricao')
                <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required></textarea>
            @else
                <textarea type="text" name="descricao" placeholder="Texto Livre" required>{{ $demanda->descricao }}</textarea>
            @enderror
            @error('pessoas_afetadas')
                <input title="{{$message}}" type="number" name="pessoas_afetadas" onkeypress="return event.charCode >= 48 && event.charCode <= 57" placeholder="Numero Aproximado de Pessoas Impactadas" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
            @else
                <input type="number" name="pessoas_afetadas" onkeypress="return event.charCode >= 48 && event.charCode <= 57" value="{{ $demanda->pessoas_afetadas }}" placeholder="Numero Aproximado de Pessoas Impactadas" required>
            @enderror
            @error('duracao')
                <select title="{{$message}}" name="duracao" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                    <option disabled selected>Selecione a duração da Demanda:</option>
                    <option value="DIAS">Dias</option>
                    <option value="SEMANAS">Semanas</option>
                    <option value="MESES">Meses</option>
                    <option value="ANOS">Anos</option>
                    <option value="INDEFINIDO">Indefinido</option>
                </select>
            @else
                <select name="duracao" required>
                    <option disabled>Selecione a duração da Demanda:</option>
                    <option value="DIAS" {{ $demanda->duracao === 'DIAS' ? 'selected' : '' }}>Dias</option>
                    <option value="SEMANAS" {{ $demanda->duracao === 'SEMANAS' ? 'selected' : '' }}>Semanas</option>
                    <option value="MESES" {{ $demanda->duracao === 'MESES' ? 'selected' : '' }}>Meses</option>
                    <option value="ANOS" {{ $demanda->duracao === 'ANOS' ? 'selected' : '' }}>Anos</option>
                    <option value="INDEFINIDO" {{ $demanda->duracao === 'INDEFINIDO' ? 'selected' : '' }}>Indefinido</option>
                </select>
            @enderror
            @error('nivel_prioridade')
                <select title="{{$message}}" name="nivel_prioridade" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                    <option disabled selected>Selecione o nível de Prioridade:</option>
                    <option value="BAIXO">Baixo</option>
                    <option value="MEDIO">Medio</option>
                    <option value="ALTO">Alto</option>
                </select>
            @else
                <select name="nivel_prioridade" required>
                    <option disabled selected>Selecione o nível de Prioridade:</option>
                    <option value="BAIXO" {{ $demanda->nivel_prioridade === 'BAIXO'? 'selected' : '' }}>Baixo</option>
                    <option value="MEDIO" {{ $demanda->nivel_prioridade === 'MEDIO'? 'selected' : '' }}>Medio</option>
                    <option value="ALTO" {{ $demanda->nivel_prioridade === 'ALTO'? 'selected' : '' }}>Alto</option>
                </select>
            @enderror
            @error('instituicao_setor')
                <input title="{{$message}}" type="text" name="instituicao_setor" placeholder="Setor/Instituição" style="border: 1px solid red; background-color:rgb(235, 201, 206)">
            @else
                <input type="text" name="instituicao_setor" value="{{ $demanda->instituicao_setor ?? '' }}" placeholder="Setor/Instituição">
            @enderror
            <div class="button_send">
                <button type="submit">Salvar</button>
            </div>
        </form>
        <script src="{{ asset('js/errors/mensagem_erro.js') }}"></script>
        <script>
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