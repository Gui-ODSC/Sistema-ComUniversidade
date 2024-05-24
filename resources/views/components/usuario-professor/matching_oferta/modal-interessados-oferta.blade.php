<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/components_css/usuarioProfessor/matching_ofertas/modal_interessados_oferta.css') }}">
    <title>Usuários Interessados</title>
</head>
<body>
    <div class="clicar-fora-modal-interessados" id="clicar-fora-modal-interessados-{{$idOferta}}" onclick="closeModalUsuariosInteressados({{$idOferta}})"></div>
    <div class="caixa-modal-interessados" id="caixa-modal-interessados-{{$idOferta}}" style="padding-top: 35px">
        <span onclick="closeModalUsuariosInteressados({{$idOferta}})" id="botao_fechar_modal"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
        <div class="modal-descricao-interessados">
            <h3>Usuários Interessados</h3>
            <h6>Lista de Usuários interessados(as) na sua Oferta</h6>
            <table class="table table-rounded p-5 table-personalizacao">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Tipo interessado(a)</th>
                    </tr>
                </thead>
                <tbody>
                    @if (count($usuarios) < 1)
                        <tr>
                            <td colspan="2"><p class="sem-dados" style="max-width: none">-- Nenhum usuário interessado(a) na sua oferta --</p></td>
                        </tr>
                    @else
                        @foreach ($usuarios as $usuario)
                            <tr>
                                <td><p class="email" title="{{ $usuario->email }}">{{ $usuario->email }}</p></td>
                                @if ($usuario->tipo === 'MEMBRO')
                                    <td>Membro Externo</td>
                                @elseif ($usuario->tipo === 'ALUNO')
                                    <td>Estudante</td>
                                @endif
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>