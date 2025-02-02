@extends('layouts.app')
@section('content')

<?php $setores = DB::select("select * from setor"); ?>
<?php $estabelecimentos = DB::select("select * from estabelecimento"); ?>
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <h2>Editar Setor</h2>
    <form method="POST" action="/updateSetor/{{ $setor->id_setor }}">
        @csrf
        @method('PUT')
        
        <!-- setor -->
        <div class="form-group">
            <label for="setor">Setor:</label>
            <input type="text" class="form-control" id="setor" name="setor" value="{{ $setor->setor }}" required>
        </div>

        <div class="form-group">
            <label for="pavimento">Pavimento:</label>
            <input type="text" class="form-control" id="pavimento" name="pavimento" value="{{ $setor->pavimento }}">
        </div>

        <label for="id_setor">Estabelecimento:</label>
    <select class="select2 form-control" name="id_estabelecimento" id="id_estabelecimento" required>
        <option value="">Selecione um estabelecimento</option>
        @foreach($estabelecimentos as $estabelecimento)
            <option value="{{ $estabelecimento->id_estabelecimento }}">{{ $estabelecimento->estabelecimento }}</option>
        @endforeach
    </select>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection
