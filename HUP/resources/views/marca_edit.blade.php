@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <h2>Editar Marca</h2>
    <form method="POST" action="/updateMarca/{{ $marca->id_marca }}">
        @csrf
        @method('PUT')
        
        <!-- Marca -->
        <div class="form-group">
            <label for="marca">Marca:</label>
            <input type="text" class="form-control" id="marca" name="marca" value="{{ $marca->marca }}"required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection