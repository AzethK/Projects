@extends('layouts.app')
@section('content')
<?php $salas = DB::select("select * from sala"); ?>
<?php $marcas = DB::select("select * from marca"); ?>
<?php $categorias = DB::select("select * from categoria"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Editar Equipamento</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>
</head>
<div class="container">
    <h2 class="text-center">Editar Equipamento</h2>
    <form method="POST" style="width:70%; margin-left:15%;" action="/updateEquipamento/{{ $equipamento->id_equipamento }}">
        @csrf
        @method('PUT')
        
        <!-- CPF -->
        <div class="form-group">
            <label for="patrimonio_uepg">
                Patrimônio
                <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Identificador interno da UEPG"></i>
                </label>
            <input type="text" class="form-control" id="patrimonio_uepg" name="patrimonio_uepg" value="{{ $equipamento->patrimonio_uepg }}">
        </div>

        <!-- RG -->
        <div class="form-group">
            <label for="nome">
                Nome
                <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Nome do equipamento"></i>
            </label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $equipamento->nome }}">
        </div>

        <!-- Nome -->
        <div class="form-group">
            <label for="modelo">Modelo:</label>
            <input type="text" class="form-control" id="modelo" name="modelo" value="{{ $equipamento->modelo }}">
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="num_serie">Número de série:</label>
            <input type="num_serie" class="form-control" id="num_serie" name="num_serie" value="{{ $equipamento->num_serie }}">
        </div>

        <!-- Username -->
        <div class="form-group">
            <label for="id_marca">Marca:</label>
            <select class="select2 form-control" name="id_marca" id="id_marca" required>
                <option value="">Selecione uma marca</option>
                @foreach($marcas as $marca)
                    <option value="{{ $marca->id_marca }}">{{ $marca->marca }}</option>
                @endforeach
            </select>
        </div>

        <!-- Senha -->
        <div class="form-group">
            <label for="id_categoria">Categoria:</label>
            <select class="select2 form-control" name="id_categoria" id="id_categoria" required>
                <option value="">Selecione uma categoria</option>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}</option>
                @endforeach
            </select>
        </div>

        <!-- Cargo -->
        <div class="form-group">
            <label for="id_sala">Sala:</label>
            <select class="select2 form-control" name="id_sala" id="id_sala" required>
                <option value="">Selecione uma sala</option>
                @foreach($salas as $sala)
                    <option value="{{ $sala->id_sala}}">{{ $sala->nome }}</option>
                @endforeach
            </select>
        </div>

        <div class="form-group">
            <label for="observacao">Observação:</label>
            <input type="observacao" class="form-control" id="observacao" name="observacao" value="{{ $equipamento->observacao }}">
        </div>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection