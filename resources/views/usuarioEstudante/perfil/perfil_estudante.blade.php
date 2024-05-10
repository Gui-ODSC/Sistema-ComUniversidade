<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('css/menu_navegacao/menu.css') }}">
    <link rel="stylesheet" href="{{ asset('css/usuarioEstudante/perfil/perfil_estudante.css') }}">
    <script src="{{ asset('js/perfil_imagem.js') }}"></script>
    <script src="{{ asset('js/menu/menu_navegacao.js') }}"></script>

    {{-- InputMask --}}
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <script script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.inputmask/5.0.6/jquery.inputmask.min.js"></script>

    <title>Perfil</title>
</head>
<body> 
    @include('usuarioEstudante.menu')
    <main class="perfil" id="conteudo">
        <div>
            <div class="botao-voltar">
                <a title="Voltar" href="{{ route('lista_todas_ofertas_estudante') }}"><img src="{{ asset('img/usuarioMembro/cadastrar_demandas/botao_voltar.png')}}" alt=""></a>
            </div>
            <a href="{{ route('perfil_edit_index_estudante', $usuario->id_usuario) }}"><button type="submit">Editar</button></a>
        </div>
            @if( session()->has('perfil-update'))
                <div class="alert alert-success" style="text-align: center; margin-top: 10px">
                    <p>{{session('perfil-update')}}</p>
                </div>
            @endif
            <div class="cadastro-container" style="display: flex">
                <div class="section-form">
                    <div id="container">
                        @if($usuario->foto)
                            <img class="foto-perfil" src="{{ url('storage/' . Auth::user()->foto) }}" alt="imagem de perfil do usuario">
                        @else
                            <img class="foto-padrao" src="{{ asset('img/icones/perfil_escuro.png') }}" alt="imagem de perfil do usuario">
                            <p>Fazer upload de uma imagem</p>
                        @endif
                    </div>
                    <div style="width: 81%; display: flex; flex-wrap: wrap">
                        <div class="caixa-input" style="width: 35%;">
                            <input type="text" id="nome" name="nome" autocomplete="off" value="{{ $usuario->nome }}" readonly>
                            <label for="nome">
                                <span>Nome</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 615px; margin-left: 3px">
                            <input type="text" id="sobrenome" name="sobrenome" autocomplete="off" value="{{ $usuario->sobrenome }}" readonly>
                            <label for="sobrenome">
                                <span>Sobrenome</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 20%;">
                            <input type="text" id="nascimento" name="nascimento" autocomplete="off" value="{{ $nascimentoFormat }}" readonly>
                            <label for="nascimento">
                                <span>Data Nascimento</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 757px; margin-left: 3px">
                            <input type="email" id="email" name="email" autocomplete="off" value="{{ $usuario->email }}" readonly>
                            <label for="email">
                                <span>Email</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 70%;">
                            <input type="email" id="email_secundario" name="email_secundario" value="{{ $usuario->email_secundario }}" autocomplete="off" readonly>
                            <label for="email_secundario">
                                <span>Email Secundário</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 282px; margin-left: 3px">
                            <input type="text" id="telefone" name="telefone" autocomplete="off" value="{{ $usuario->telefone }}" readonly>
                            <label for="telefone">
                                <span>Telefone</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 50%;">
                            <input type="tipo_pessoa" id="tipo_pessoa" name="tipo_pessoa" value="{{ ucwords(strtolower($usuario->tipo_pessoa)) }}" readonly>
                            <label for="password">
                                <span>TipoPessoa</span>
                            </label>
                        </div>
                        <div class="caixa-input" style="width: 472px; margin-left: 3px;">
                            <input type="text" id="autoCompleteCidade" name="nome_cidade" autocomplete="off" value="{{ $cidade->nome }}" required>
                            <label for="nome_cidade">
                                <span>Cidade</span>
                            </label>
                        </div>
                    </div>
                    <div class="caixa-input" style="width: 40%;">
                        <input type="text" id="rua" name="rua" autocomplete="off" value="{{ $endereco->rua }}" readonly>
                        <label for="rua">
                            <span>Rua</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 30%; margin-left: 3px;">
                        <input type="number" id="numero" name="numero" autocomplete="off" value="{{ $endereco->numero}}" readonly>
                        <label for="numero">
                            <span>Número</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 342px; margin-left: 3px;">
                        <input type="text" id="complemento" name="complemento" autocomplete="off" value="{{ $endereco->complemento }}" readonly>
                        <label for="complemento">
                            <span>Complemento</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 30%;">
                        <input class="estado" type="text" id="autoCompleteEstado" name="nome_estado" autocomplete="off" value="{{ $estado->nome }}" readonly>
                        <label for="nome_estado">
                            <span>Estado</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 433px; margin-left: 3px;">
                        <input type="text" id="autoCompleteBairro" name="nome_bairro" autocomplete="off" value="{{ $bairro->nome }}" readonly>
                        <label for="nome_bairro">
                            <span>Bairro</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 380px; margin-left: 3px;">
                        <input type="text" id="ra" name="ra" autocomplete="off" value="{{ $usuarioEstudante->ra }}" readonly>
                        <label for="ra">
                            <span>RA</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 50%;">
                        <input type="text" id="curso" name="curso" autocomplete="off" value="{{ $usuarioEstudante->curso }}" readonly>
                        <label for="curso">
                            <span>Curso</span>
                        </label>
                    </div>
                    <div class="caixa-input" style="width: 580px; margin-left: 3px;">
                        <input type="text" id="instituicao" name="instituicao" autocomplete="off" value="{{ $usuario->instituicao }}" readonly>
                        <label for="instituicao">
                            <span>Instituição</span>
                        </label>
                    </div>
                </div>
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
    </script>
</body>
</html>