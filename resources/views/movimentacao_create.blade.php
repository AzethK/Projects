@extends('layouts.app')
@section('content')
<?php $salas = DB::select("select * from sala"); 
$equipamento = DB::table('equipamento')->where('id_equipamento', $id_equipamento)->first();?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Movimentação</title>

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
    <h1>Cadastrar Movimentação</h1>

    <form method="POST" action="{{ route('insertMovimentacao') }}">
        @csrf

        <!-- Hidden field to store the id_equipamento -->
        <input type="hidden" name="id_equipamento" value="{{ $id_equipamento }}">
        <input type="hidden" name="sala_origem_movimentacao" value="{{ $equipamento->id_sala }}">

        <!-- Sala Destino -->
        <label for="sala_destino_movimentacao">Sala Destino:</label>
            <select class="select2 form-control" name="sala_destino_movimentacao" id="sala_destino_movimentacao" required>
            <option value="">Selecione uma sala</option>
             @foreach($salas as $sala)
                <option value="{{ $sala->id_sala}}">{{ $sala->nome }}</option>
            @endforeach
        </select>

        <!-- Observacao -->
        <label for="observacao">Observação:</label>
        <textarea name="observacao" id="observacao" rows="4" cols="50"></textarea>

        <button type="submit">Confirmar</button>
    </form>
</body>
</html>
@endsection