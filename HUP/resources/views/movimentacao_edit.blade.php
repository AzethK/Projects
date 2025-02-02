@extends('layouts.app')
@section('content')
<?php $salas = DB::select("select * from sala"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Movimentação</title>

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
    <h2 class="text-center">Editar Movimentação</h2>
    <form method="POST" action="{{ route('updateMovimentacao', ['id_operacao' => $operacao->id_operacao, 'id_equipamento' => $operacao->id_equipamento]) }}">
        
        @csrf
        @method('PUT')


    <!-- Sala Destino -->
        <div class="form-group">
            <label for="sala_destino_movimentacao">Sala Destino:</label>
            <select class="select2 form-control" name="sala_destino_movimentacao" id="sala_destino_movimentacao" required>
                <option value="">Selecione uma sala</option>
                @foreach($salas as $sala)
                    <option value="{{ $sala->id_sala }}" {{ $sala->id_sala == $operacao->sala_destino_movimentacao ? 'selected' : '' }}>
                        {{ $sala->nome }}
                    </option>
                @endforeach
            </select>
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