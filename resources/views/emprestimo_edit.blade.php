@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- jQuery library -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- jQuery UI Datepicker styles -->
    <link rel="stylesheet" href="https://code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">

    <!-- jQuery UI Datepicker script -->
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>

    <script>
        $(function() {
    // Initialize the datepicker
            $("#datepicker").datepicker({
                dateFormat: 'dd/mm/yy', // Set the desired date format
                onSelect: function(dateText, inst) {
                    // Parse the selected date
                    var selectedDate = $.datepicker.parseDate('dd/mm/yy', dateText);

                    // Set the time part to midnight (00:00)
                    selectedDate.setHours(0, 0, 0, 0);

                    // Format the date as 'yyyy-mm-dd'
                    var formattedDate = $.datepicker.formatDate('dd/mm/yy', selectedDate);

                    // Set the input field's value with the formatted date
                    $("#datepicker").val(formattedDate);
                }
            });
        });
    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Empréstimo</title>
    
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
        }

        h1 {
            text-align: center;
            margin-top: 20px;
        }

        form {
            max-width: 400px;
            margin: 0 auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 10px;
        }

        textarea {
            width: 95%;
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        button[type="submit"] {
            background-color: #007bff;
            color: #fff;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button[type="submit"]:hover {
            background-color: #0056b3;
        }
    </style>
</head>

<div class="container">
    <h2 class="text-center">Editar Empréstimo</h2>
    <form method="POST" action="{{ route('updateEmprestimo', ['id_operacao' => $operacao->id_operacao, 'id_equipamento' => $operacao->id_equipamento]) }}">
        
        @csrf
        @method('PUT')
        
        <!-- Nome -->
        <div class="form-group">
            <label for="nome_emprestimo">Nome:</label>
            <input type="text" class="form-control" id="nome_emprestimo" name="nome_emprestimo" value="{{ $operacao->nome_emprestimo }}"required>
        </div>

        <!-- CPF -->
        <div class="form-group">
            <label for="cpf_emprestimo">CPF:</label>
            <input type="text" class="form-control" id="cpf_emprestimo" name="cpf_emprestimo" value="{{ $operacao->cpf_emprestimo }}"required>
        </div>

        <!-- Telefone -->
        <div class="form-group">
            <label for="telefone_emprestimo">Telefone:</label>
            <input type="text" class="form-control" id="telefone_emprestimo" name="telefone_emprestimo" value="{{ $operacao->telefone_emprestimo }}"required>
        </div>

        <!-- Data prevista de devolução -->
        <div class="form-group">
            <label for="data_prevista_devolucao_emprestimo">Data Prevista de Devolução:</label>
            <input type="text" id="datepicker" name="data_prevista_devolucao_emprestimo" value="{{ $operacao->data_prevista_devolucao_emprestimo }}"required>
        </div>

        <!-- Devolvido -->
        <div class="form-group">
        <label for="devolvido_emprestimo">Devolvido:</label>
        <input type="hidden" name="devolvido_emprestimo" value="false">
        <input type="checkbox" name="devolvido_emprestimo" id="devolvido_emprestimo" value="true" @if ($operacao->devolvido_emprestimo) checked @endif>
        </div>

        <div class="form-group">
            <label for="observacao">Observação:</label>
            <input type="observacao" class="form-control" id="observacao" name="observacao" value="{{ $operacao->observacao }}">
        </div>
        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection