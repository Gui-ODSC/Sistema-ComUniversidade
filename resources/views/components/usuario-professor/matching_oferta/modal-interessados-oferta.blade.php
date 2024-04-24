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
    <div class="caixa-modal-interessados" id="caixa-modal-interessados-{{$idOferta}}">
        <span onclick="closeModalUsuariosInteressados({{$idOferta}})" id="botao_fechar_modal"><img src="{{ asset('img/usuarioMembro/minhas_demandas/fechar.png') }}" alt=""></span>
        <div class="modal-descricao">
            <h3>Usuários Interessados</h3>
            <h6>Lista de Usuários na sua Oferta</h6>
            <table class="modal-table">
                <thead>
                    <tr>
                        <th>Email</th>
                        <th>Tipo Usuário</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($usuarios as $usuario)
                        <tr>
                            <td>{{ $usuario->email }}</td>
                            <td>{{ ucwords(strtolower($usuario->tipo)) }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</body>
</html>