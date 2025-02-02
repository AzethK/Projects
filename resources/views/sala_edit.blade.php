@extends('layouts.app')
@section('content')

<?php $setores = DB::select("select * from setor"); ?>
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <h2>Editar Sala</h2>
    <form method="POST" action="/updateSala/{{ $sala->id_sala }}">
        @csrf
        @method('PUT')
        
        <!-- sala -->
        <div class="form-group">
            <label for="nome">Sala:</label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $sala->nome }}" required>
        </div>

        <label for="id_setor">Setor:</label>
    <select class="select2 form-control" name="id_setor" id="id_setor" required>
        <option value="">Selecione um setor</option>
        @foreach($setores as $setor)
            <option value="{{ $setor->id_setor }}">{{ $setor->setor }}</option>
        @endforeach
    </select>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection