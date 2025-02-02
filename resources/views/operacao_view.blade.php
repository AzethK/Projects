@extends('layouts.app')
@section('content')
<?php $equipamento = DB::select("
     SELECT equipamento.*, marca.marca as marca , categoria.categoria as categoria, CONCAT(estabelecimento.estabelecimento, '[PLACEHOLDER]', setor.setor, '[PLACEHOLDER]', sala.nome) as localizacao
     FROM equipamento 
     LEFT JOIN marca ON equipamento.id_marca = marca.id_marca
     LEFT JOIN categoria ON equipamento.id_categoria = categoria.id_categoria
     LEFT JOIN sala ON equipamento.id_sala = sala.id_sala
     LEFT JOIN setor ON sala.id_setor = setor.id_setor
     LEFT JOIN estabelecimento ON setor.id_estabelecimento = estabelecimento.id_estabelecimento
     WHERE (equipamento.id_equipamento=$equipamento->id_equipamento);
"); 
if (!empty($equipamento)) {
    $equipamento = $equipamento[0]; // Get the first item from the array
} else {
    // Handle the case where no equipment was found
    $equipamento = null;
}

$manutencoes = DB::select("select operacao.*, usuario.nome as usuario FROM operacao LEFT JOIN usuario ON operacao.id_usuario = usuario.id_usuario 
where (id_tipo=1 AND operacao.id_equipamento=$equipamento->id_equipamento) order by created_at");
$movimentacoes = DB::select("select operacao.*, usuario.nome as usuario, CONCAT(obter_estabelecimento_setor(obter_setor_id_sala(operacao.sala_origem_movimentacao)), 
'[PLACEHOLDER]', obter_setor_sala(operacao.sala_origem_movimentacao), '[PLACEHOLDER]', obter_nome_sala(operacao.sala_origem_movimentacao)) as localizacao_origem, 
CONCAT(obter_estabelecimento_setor(obter_setor_id_sala(operacao.sala_destino_movimentacao)), '[PLACEHOLDER]', obter_setor_sala(operacao.sala_destino_movimentacao), 
'[PLACEHOLDER]', obter_nome_sala(operacao.sala_destino_movimentacao)) as localizacao_destino FROM operacao LEFT JOIN usuario ON operacao.id_usuario = usuario.id_usuario
where (id_tipo=2 AND operacao.id_equipamento=$equipamento->id_equipamento) order by created_at");
$emprestimos = DB::select("select operacao.*, usuario.nome as usuario FROM operacao LEFT JOIN usuario ON operacao.id_usuario = usuario.id_usuario 
where (id_tipo=3 AND operacao.id_equipamento=$equipamento->id_equipamento) order by created_at");
$baixa = DB::table('operacao')->select('operacao.*', 'usuario.nome as usuario')->leftJoin('usuario', 'operacao.id_usuario', '=', 'usuario.id_usuario')
->where('id_tipo', 4)->where('operacao.id_equipamento', $equipamento->id_equipamento)->first();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <title>Operações</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
    <h3 class="text-center">Operações</h2>
    @if (isset($equipamento))
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Patrimônio UEPG</th>
                    <th>Nome</th>
                    <th>Número de Série</th>
                </tr>
            </thead>
                <!-- Add more rows for other equipment details -->
            <tbody>
                <tr>
                    <td>{{ $equipamento->patrimonio_uepg }}</td>
                    <td>{{ $equipamento->nome }}</td>
                    <td>{{ $equipamento->num_serie }}</td>
                </tr>
            </tbody>
        </table>
    @else
        <p>Equipment data not found.</p>
    @endif
</div>
<div class="container">
    <h3 class="text-center">Movimentação</h2>
    @if (isset($equipamento))
        <a href="/insertMovimentacao/{{ $equipamento->id_equipamento }}" class="btn btn-success">Adicionar</a>
        <table class="table table-bordered">
            <thead>
            <!-- Tabela de equipamento -->
            <tr>
                <th>Sala Origem</th>
                <th>Sala Destino</th>
                <th>Usuário</th>
                <th>Data de Movimentação</th>
                <th>Data de Edição</th>
                <th>Observação</th>
            </tr>
            </thead>
            <tbody>
                <!-- Insere dados de cada equipamento na tabela -->
                @foreach ($movimentacoes as $movimentacao)
                <tr>
                <td style="white-space: nowrap;">{!! str_replace('[PLACEHOLDER]', '<br>', $movimentacao->localizacao_origem) !!}</td>
                <td style="white-space: nowrap;">{!! str_replace('[PLACEHOLDER]', '<br>', $movimentacao->localizacao_destino) !!}</td>
                <td style="white-space: nowrap;">{{ $movimentacao -> usuario }}</td>
                <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($movimentacao->created_at)->format('H:i d/m/Y') }}</td>
                <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($movimentacao->updated_at)->format('H:i d/m/Y') }}</td>
                <td style="white-space: nowrap;">{{ $movimentacao -> observacao }}</td>
                <form action="{{ route('delete.operacao', ['id_operacao' => $movimentacao->id_operacao, 'id_equipamento' => $equipamento->id_equipamento]) }}" method="POST">
                    @csrf <!-- Add a CSRF token for security -->
                <input type="hidden" name="id_operacao" value="{{ $movimentacao->id_operacao }}">
                <td><a href="/editarMovimentacao/{{ $movimentacao->id_operacao }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
                <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                </form>
                </tr>
                @endforeach 
    </tbody>
        </table>
    @else
        <p>Equipment data not found.</p>
    @endif
</div>
<div class="container">
    <h3 class="text-center">Manutenção</h2>
    @if (isset($equipamento))
        <a href="/insertManutencao/{{ $equipamento->id_equipamento }}" class="btn btn-success">Adicionar</a>
        <table class="table table-bordered">
                <thead>
            <!-- Tabela de equipamento -->
            <tr>
                <th>Tipo de Manutenção</th>
                <th>Usuário</th>
                <th>Data da Manutenção</th>
                <th>Data de Edição</th>
                <th>Observação</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($manutencoes as $manutencao)
                <!-- Insere dados de cada equipamento na tabela -->
                <tr>
                <td style="white-space: nowrap;">{{ $manutencao->descricao_manutencao }}</td>
                <td style="white-space: nowrap;">{{ $manutencao->usuario }}</td>
                <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($manutencao->created_at)->format('H:i d/m/Y') }}</td>
                <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($manutencao->updated_at)->format('H:i d/m/Y') }}</td>
                <td style="white-space: nowrap;">{{ $manutencao->observacao }}</td>
                <form action="{{ route('delete.operacao', ['id_operacao' => $manutencao->id_operacao, 'id_equipamento' => $equipamento->id_equipamento]) }}" method="POST">
                    @csrf <!-- Add a CSRF token for security -->
                <input type="hidden" name="id_operacao" value="{{ $manutencao->id_operacao }}">
                <td ><a href="/editarManutencao/{{ $manutencao->id_operacao }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
                <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                </form>
                </tr>
            @endforeach
    </tbody>
        </table>
    @else
        <p>Equipment data not found.</p>
    @endif
</div>
<div class="container">
    <h3 class="text-center">Empréstimo</h2>
    @if (isset($equipamento))
         <a href="/insertEmprestimo/{{ $equipamento->id_equipamento }}" class="btn btn-success">Adicionar</a>
        <table class="table table-bordered">
                <thead>
            <!-- Tabela de Emprestimo -->
            <tr>
                <th>Nome Empréstimo</th>
                <th>CPF</th>
                <th>Telefone</th>
                <th>Data Prevista Devolução</th>
                <th>Devolvido</th>
                <th>Usuário</th>
                <th>Data do Empréstimo</th>
                <th>Data de Edição</th>
                <th>Observação</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($emprestimos as $emprestimo)
                <!-- Insere dados de cada emprestimo na tabela -->
                <tr>
                <td style="white-space: nowrap;">{{ $emprestimo->nome_emprestimo }}</td>
                <td style="white-space: nowrap;">{{ $emprestimo->cpf_emprestimo }}</td>
                <td style="white-space: nowrap;">({{ substr($emprestimo->telefone_emprestimo, 0, 2) }}) {{ substr($emprestimo->telefone_emprestimo, 2, 5) }}-{{ substr($emprestimo->telefone_emprestimo, 7, 4) }}</td>
                <td style="white-space: nowrap;">{{ date('d/m/Y', strtotime($emprestimo->data_prevista_devolucao_emprestimo)) }}</td>
                <td style="white-space: nowrap;">{{ $emprestimo->devolvido_emprestimo == '1' ? 'Sim' : 'Não' }}</td>
                <td style="white-space: nowrap;">{{ $emprestimo->usuario }}</td>
                <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($emprestimo->created_at)->format('H:i d/m/Y') }}</td>
                <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($emprestimo->updated_at)->format('H:i d/m/Y') }}</td>
                <td style="white-space: nowrap;">{{ $emprestimo->observacao }}</td>
                <form action="{{ route('delete.operacao', ['id_operacao' => $emprestimo->id_operacao, 'id_equipamento' => $equipamento->id_equipamento]) }}" method="POST">
                    @csrf <!-- Add a CSRF token for security -->
                <input type="hidden" name="id_operacao" value="{{ $emprestimo->id_operacao }}">
                <td><a href="/editarEmprestimo/{{ $emprestimo->id_operacao }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
                <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
                </form>
                </tr>
            @endforeach
    </tbody>
        </table>
    @else
        <p>Equipment data not found.</p>
    @endif
</div>

<div class="container">
    <h3 class="text-center">Baixa Patrimonial</h2>
    @if (isset($equipamento))
        <table class="table table-bordered">
                <thead>
            <!-- Tabela de equipamento -->
            <tr>
                <th>Baixa</th>
                <th>Usuário</th>
                <th>Data da Baixa</th>
                <th>Data de Edição</th>
            </tr>
            </thead>
            <tbody>
                <!-- Insere dados de cada equipamento na tabela -->
                <tr>
                <td>
                <input type="checkbox" id="estadoBaixaCheckbox" {{ $equipamento->estado_baixa == true ? 'checked' : '' }}>
                </td>
                @if ($baixa)
                <td>{{ $baixa->usuario }}</td>
                <td>{{ \Carbon\Carbon::parse($baixa->created_at)->format('H:i d/m/Y') }}</td>
                <td>{{ \Carbon\Carbon::parse($baixa->updated_at)->format('H:i d/m/Y') }}</td>
                </tr>
                @endif
                </tr>
    </tbody>
        </table>
    @else
        <p>Equipment data not found.</p>
    @endif
</div>

<script>
    $(document).ready(function () {
    $('#estadoBaixaCheckbox').change(function () {
        var isChecked = $(this).prop('checked');
        
        // Include the id_equipamento and id_usuario values
        var id_equipamento = {{ $equipamento->id_equipamento }};
        var id_usuario = 1;
        var id_tipo = 4;

        // Send an AJAX request to update the database
        $.ajax({
            type: 'POST',
            url: '/insertBaixa', // Replace with your route URL for updating state
            data: {
                isChecked: isChecked,
                id_equipamento: id_equipamento,
                id_usuario: id_usuario, // Include the id_usuario
                id_tipo : id_tipo,
                _token: '{{ csrf_token() }}'
            },
            success: function (response) {
                // Handle the response, e.g., show a success message
                console.log('AJAX Response:', response);
                location.reload();
            },
            error: function (xhr, textStatus, errorThrown) {
                // Handle errors here
                console.error(xhr.responseText);
            }
        });
    });
});

</script>

</body>
</html>
@endsection