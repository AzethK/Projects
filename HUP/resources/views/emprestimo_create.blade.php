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

<!-- jQuery Masked Input -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.maskedinput/1.4.1/jquery.maskedinput.min.js"></script>

    <script>
        $(function() {
    // Initialize the datepicker
            $("#datepicker").datepicker({
                dateFormat: 'dd/mm/yy', // Set the desired date format
                minDate: 0,
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
            //Máscaras
            $('#telefone_emprestimo').mask('(99) 99999-9999');
            $('#cpf_emprestimo').mask('99999999999');

            //Insere o telefone e o cpf no banco sem a máscara
            $('form').submit(function() {
                var telefone = $('#telefone_emprestimo').val();
                telefone = telefone.replace(/\D/g, '');
                $('#telefone_emprestimo').val(telefone);
            });

        });

    </script>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Empréstimo</title>

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
<body>
    <h1>Cadastrar Emprestimo</h1>

    <form method="POST" action="{{ route('insertEmprestimo') }}">
        @csrf

        <!-- Hidden field to store the id_equipamento -->
        <input type="hidden" name="id_equipamento" value="{{ $id_equipamento }}">

        <!-- Nome Emprestimo -->
        <label for="nome_emprestimo">Nome:</label>
        <input name="nome_emprestimo" id="nome_emprestimo" rows="4" cols="50" required></textarea>

        <!-- CPF -->
        <label for="cpf_emprestimo">CPF:</label>
        <input name="cpf_emprestimo" id="cpf_emprestimo" rows="4" cols="50" required></textarea>

        <!-- Telefone -->
        <label for="telefone_emprestimo">Telefone:</label>
        <input name="telefone_emprestimo" id="telefone_emprestimo" rows="4" cols="50" required></textarea>

        <!-- Data prevista de devolução -->
        <label for="data_prevista_devolucao_emprestimo">Data Prevista de Devolução:</label>
        <input type="text" id="datepicker" name="data_prevista_devolucao_emprestimo" required>

        <!-- Devolvido -->
        <label for="devolvido_emprestimo">Devolvido:</label>
        <input type="hidden" name="devolvido_emprestimo" value="false">
        <input type="checkbox" name="devolvido_emprestimo" id="devolvido_emprestimo" value="true">

        <!-- Observation -->
        <label for="observacao">Observação:</label>
        <textarea name="observacao" id="observacao" rows="4" cols="50"></textarea>

        <button type="submit">Confirmar</button>
    </form>


</body>
</html>
@endsection