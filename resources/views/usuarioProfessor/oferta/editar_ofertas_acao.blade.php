<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioProfessor/oferta/editar_ofertas_acao.css') }}">
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- AUTOCOMPLETE --}}
    <script src="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js/dist/js/autoComplete.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@tarekraafat/autocomplete.js@10.2.7/dist/css/autoComplete.02.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Editar Demanda</title>
</head>
<body>
    @include('usuarioMembro.menu')
    <main class="editar-ofertas" id="conteudo">
        <div class="botao-voltar">
            <a title="Voltar" onclick="goBack()"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
        </div>
        <div class="titulo">
            <h1>Editar Oferta Ação</h1>
        </div>
        <form action="{{ route('oferta_edit_store_acao', $oferta->id_oferta) }}" method="POST">
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
                        <input type="text" name="titulo" id="titulo" autocomplete="off" value="{{$oferta->titulo}}" required>
                        <label for="titulo">
                            <span>Titulo</span>
                        </label>
                    @endif
                </div>
                <div class="caixa-input" style="width: 30%; margin-left: 3px">
                    @error('areaConhecimento')
                        <div class="autoComplete_wrapper">  
                            <input title="{{$message}}" type="text" id="autoCompleteAreaConhecimentoAcao" name="area_conhecimento" value="{{$areaConhecimento->nome}}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                            <label for="area_conhecimento">
                                <span>Área Conhecimento</span>
                            </label>
                        </div>
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteAreaConhecimentoAcao" name="area_conhecimento" value="{{$areaConhecimento->nome}}" autocomplete="off" required>
                            <label for="area_conhecimento">
                                <span>Área Conhecimento</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 355px; margin-left: 3px">
                    @error('publico_alvo')
                        <div class="autoComplete_wrapper">  
                            <input title="{{$message}}" type="text" id="autoCompletePublicoAlvo" name="publico_alvo" value="{{$publicoAlvo->nome}}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                            <label for="publico_alvo">
                                <span>Publico alvo</span>
                            </label>
                        </div>
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompletePublicoAlvo" name="publico_alvo" value="{{$publicoAlvo->nome}}" autocomplete="off" required>
                            <label for="publico_alvo">
                                <span>Publico alvo</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 30%;">
                    @error('tipo_acao')
                        <div class="autoComplete_wrapper">  
                            <input title="{{$message}}" type="text" id="autoCompleteTipoAcao" name="tipo_acao" value="{{$tipoAcao->nome}}" style="border: 1px solid red; background-color:rgb(235, 201, 206)" autocomplete="off" required>
                            <label for="tipo_acao">
                                <span>Modalidade da Ação de Extensão</span>
                            </label>
                        </div>
                    @else
                        <div class="autoComplete_wrapper">  
                            <input type="text" id="autoCompleteTipoAcao" name="tipo_acao" value="{{$tipoAcao->nome}}" autocomplete="off" required>
                            <label for="tipo_acao">
                                <span>Modalidade da Ação de Extensão</span>
                            </label>
                        </div>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 35%; margin-left: 3px;">
                    @error('duracao')
                        <select title="{{$message}}" name="duracao" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <option disabled selected></option>
                            <option value="DIAS" {{ $oferta->ofertaAcao->duracao === 'DIAS'? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ $oferta->ofertaAcao->duracao === 'SEMANAS'? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ $oferta->ofertaAcao->duracao === 'MESES'? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ $oferta->ofertaAcao->duracao === 'ANOS'? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ $oferta->ofertaAcao->duracao === 'INDEFINIDO'? 'selected' : '' }}>Indefinido</option>
                        </select>
                        <label for="duracao">
                            <span>Selecione a duração da demanda</span>
                        </label>
                    @else
                        <select name="duracao" required autocomplete="off">
                            <option disabled selected></option>
                            <option value="DIAS" {{ $oferta->ofertaAcao->duracao === 'DIAS'? 'selected' : '' }}>Dias</option>
                            <option value="SEMANAS" {{ $oferta->ofertaAcao->duracao === 'SEMANAS'? 'selected' : '' }}>Semanas</option>
                            <option value="MESES" {{ $oferta->ofertaAcao->duracao === 'MESES'? 'selected' : '' }}>Meses</option>
                            <option value="ANOS" {{ $oferta->ofertaAcao->duracao === 'ANOS'? 'selected' : '' }}>Anos</option>
                            <option value="INDEFINIDO" {{ $oferta->ofertaAcao->duracao === 'INDEFINIDO'? 'selected' : '' }}>Indefinido</option>
                        </select>
                        <label for="duracao">
                            <span>Selecione a duração da demanda</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 417px; margin-left: 3px">
                    @error('data_limite')
                        <input type="date" name="data_limite" value="{{$dataLimite}}" autocomplete="off">
                        <label for="data_expiracao">
                            <span>Data Expiração da Demanda</span>
                        </label>
                    @else
                        <input type="date" name="data_limite" value="{{$dataLimite}}" autocomplete="off">
                        <label for="data_expiracao">
                            <span>Data Expiração da Demanda</span>
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
                    @error('status_registro')
                        <select title="{{$message}}" name="status_registro" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <option disabled selected></option>
                            <option value="NAO_REGISTRADA"{{$oferta->ofertaAcao->status_registro === 'NAO_REGISTRADA'? 'selected': '' }}>Não Registrada</option>
                            <option value="REGISTRADA"{{$oferta->ofertaAcao->status_registro === 'REGISTRADA'? 'selected': '' }}>Registrada</option>
                        </select>
                        <label for="status_registro">
                            <span>Selecione o Status de Registro da Oferta:</span>
                        </label>
                    @else
                        <select name="status_registro" autocomplete="off" required>
                            <option disabled selected></option>
                            <option value="NAO_REGISTRADA"{{$oferta->ofertaAcao->status_registro === 'NAO_REGISTRADA'? 'selected': '' }}>Não Registrada</option>
                            <option value="REGISTRADA"{{$oferta->ofertaAcao->status_registro === 'REGISTRADA'? 'selected': '' }}>Registrada</option>
                        </select>
                        <label for="status_registro">
                            <span>Selecione o Status de Registro da Oferta:</span>
                        </label>
                    @enderror
                </div>
                <div class="caixa-input" style="width: 604px; margin-left: 3px">
                    @error('regime')
                        <select title="{{$message}}" name="regime" autocomplete="off" style="border: 1px solid red; background-color:rgb(235, 201, 206)" required>
                            <option disabled selected></option>
                            <option value="PRESENCIAL"{{$oferta->ofertaAcao->regime === 'PRESENCIAL'? 'selected': '' }}>Presencial</option>
                            <option value="ONLINE"{{$oferta->ofertaAcao->regime === 'ONLINE'? 'selected': '' }}>Online</option>
                        </select>
                        <label for="status_registro">
                            <span>Selecione o regime da Oferta:</span>
                        </label>
                    @else
                        <select name="regime" autocomplete="off" required>
                            <option disabled selected></option>
                            <option value="PRESENCIAL"{{$oferta->ofertaAcao->regime === 'PRESENCIAL'? 'selected': '' }}>Presencial</option>
                            <option value="ONLINE"{{$oferta->ofertaAcao->regime === 'ONLINE'? 'selected': '' }}>Online</option>
                        </select>
                        <label for="status_registro">
                            <span>Selecione o regime da Oferta:</span>
                        </label>
                    @enderror
                </div>
            <div class="button_send">
                <button type="submit">Salvar</button>
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
            inicializarAutoComplete(listAreaConhecimento, "#autoCompleteAreaConhecimentoAcao", feedback => {
                const areaConhecimento = feedback.selection.value;
                const autoCompleteInput = document.getElementById('autoCompleteAreaConhecimentoAcao');
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
            
        </script>
    </main>
</body>
</html>