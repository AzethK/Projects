@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <h2>Editar Categoria</h2>
    <form method="POST" action="/updateCategoria/{{ $categoria->id_categoria }}">
        @csrf
        @method('PUT')
        
        <!-- categoria -->
        <div class="form-group">
            <label for="categoria">Categoria:</label>
            <input type="text" class="form-control" id="categoria" name="categoria" value="{{ $categoria->categoria }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection