@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<div class="container">
    <h2>Editar Estabelecimento</h2>
    <form method="POST" action="/updateEstabelecimento/{{ $estabelecimento->id_estabelecimento }}">
        @csrf
        @method('PUT')
        
        <!-- estabelecimento -->
        <div class="form-group">
            <label for="estabelecimento">Editar Estabelecimento</label>
            <input type="text" class="form-control" id="estabelecimento" name="estabelecimento" value="{{ $estabelecimento->estabelecimento }}" required>
        </div>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection