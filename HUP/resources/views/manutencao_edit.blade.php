@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Manutenção</title>

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
    <h2 class="text-center">Descrição da Manutenção</h2>
    <form method="POST" action="{{ route('updateManutencao', ['id_operacao' => $operacao->id_operacao, 'id_equipamento' => $operacao->id_equipamento]) }}">
        
        @csrf
        @method('PUT')
        
        <!-- Tipo -->
        <div class="form-group">
            <label for="descricao_manutencao">Descrição da Manutenção:</label>
            <input type="text" class="form-control" id="descricao_manutencao" name="descricao_manutencao" value="{{ $operacao->descricao_manutencao }}" required>
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