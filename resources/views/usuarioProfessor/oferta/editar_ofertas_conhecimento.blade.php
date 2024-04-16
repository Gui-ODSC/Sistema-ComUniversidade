<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/editar_ofertas_conhecimento.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- AUTOCOMPLETE --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Editar Oferta Conhecimento</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="editar-ofertas" id="conteudo">
        <div class="botao-voltar">
            <a title="Voltar" onclick="goBack()"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
        </div>
        <div class="titulo">
            <h1>Editar Oferta Conhecimento</h1>
        </div>
        <form action="{{ route('oferta_edit_store_conhecimento', $oferta->id_oferta) }}" method="POST">
            @csrf
            @if($errors->any())
                <div class="alert alert-danger" style="text-align: center; margin-top: 20px">
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
                @csrf
                <div class="caixa-input" style="width: 40%;">
                    @if ($errors->has('titulo') || $errors->has('id_usuario'))
                        <input title="{{ $errors->first('titulo') ?: $errors->first('id_usuario') }}" type="text" name="titulo" value="{{$oferta->titulo}}" style="border: 1px solid red; background-color: rgb(235, 201, 206)" required>
                        <label for="titulo">
                            <span>Titulo</span>
                        </label>
                    @else    
                        <input type="text" name="titulo" value="{{$oferta->titulo}}" id="titulo" autocomplete="off" required>
                        <label for="titulo">
                            <span>Titulo</span>
                        </label>
                    @endif
                </div>
                <div class="caixa-input" style="width: 30%; margin-left: 3px">
                    @error('areaConhecimento')
                        <div class="autoComplete_wrapper">  
                            <input title="{{$message}}" type="text" id="autoCompleteAreaConhecimento" name="area_conhecimento" value="{{$areaConhecimento->nome}}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                            <label for="area_conhecimento">
                                <span>Área Conhecimento</span>
                            </label>
                        </div>
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteAreaConhecimento" name="area_conhecimento" value="{{$areaConhecimento->nome}}" autocomplete="off" required>
                            <label for="area_conhecimento">
                                <span>Área Conhecimento</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 358px; margin-left: 3px">
                    @error('tempo_atuacao')
                        <select title="{{$message}}" name="tempo_atuacao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <option disabled selected></option>
                            <option value="MENOS_1_ANO"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO' ? 'selected' : ''}}>Menos de 1 Ano</option>
                            <option value="MAIS_1_ANO"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO' ? 'selected' : ''}}>Mais de 1 Ano</option>
                            <option value="MAIS_3_ANOS"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS' ? 'selected' : ''}}>Mais de 3 Anos</option>
                            <option value="MAIS_5_ANOS"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS' ? 'selected' : ''}}>Mais de 5 Anos</option>
                        </select>
                        <label for="tempo_atuacao">
                            <span>Selecione o Tempo de Atuação:</span>
                        </label>
                    @else
                        <select name="tempo_atuacao" autocomplete="off" required>
                            <option disabled selected></option>
                            <option value="MENOS_1_ANO"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MENOS_1_ANO' ? 'selected' : ''}}>Menos de 1 Ano</option>
                            <option value="MAIS_1_ANO"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_1_ANO' ? 'selected' : ''}}>Mais de 1 Ano</option>
                            <option value="MAIS_3_ANOS"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_3_ANOS' ? 'selected' : ''}}>Mais de 3 Anos</option>
                            <option value="MAIS_5_ANOS"{{$oferta->ofertaConhecimento->tempo_atuacao === 'MAIS_5_ANOS' ? 'selected' : ''}}>Mais de 5 Anos</option>
                        </select>
                        <label for="tempo_atuacao">
                            <span>Selecione o Tempo de Atuação:</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="height: 120px; width: 100%;">
                    @error('descricao')
                        <textarea title="{{$message}}" type="text" name="descricao" placeholder="Texto Livre" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>{{$oferta->descricao}}</textarea>
                        <label id="campo-label" for="descricao">
                            <span id="campo-spam">Descrição</span>
                        </label>
                    @else
                        <textarea type="text" name="descricao" autocomplete="off" required>{{$oferta->descricao}}</textarea>
                        <label id="campo-label" for="descricao">
                            <span id="campo-spam">Descrição</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 50%;">
                    @error('link_lattes')
                        <input title="{{$message}}" type="text" name="link_lattes" value="{{$oferta->ofertaConhecimento->link_lattes}}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                        <label for="link_lattes">
                            <span>Link Lattes</span>
                        </label>
                    @else
                        <input type="text" name="link_lattes" value="{{$oferta->ofertaConhecimento->link_lattes}}" autocomplete="off" required>
                        <label for="link_lattes">
                            <span>Link Lattes</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 604px; margin-left: 3px">
                    @error('link_linkedin')
                        <input title="{{$message}}" type="text" name="link_linkedin" value="{{$oferta->ofertaConhecimento->link_linkedin}}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                        <label for="link_linkedin">
                            <span>Link Linkedin</span>
                        </label>
                    @else
                        <input type="text" name="link_linkedin" value="{{$oferta->ofertaConhecimento->link_linkedin}}" autocomplete="off" required>
                        <label for="link_linkedin">
                            <span>Link Linkedin</span>
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
            
        </script>
    </main>
</body>
</html>