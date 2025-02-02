@extends('layouts.app')
@section('content')
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
    <h2>Editar Usuário</h2>
    <form method="POST" action="/updateUsuario/{{ $usuario->id_usuario }}">
        @csrf
        @method('PUT')
        
        <!-- CPF -->
        <div class="form-group">
            <label for="cpf">CPF:</label>
            <input type="text" class="form-control" id="cpf" name="cpf" value="{{ $usuario->cpf }}" required>
        </div>

        <!-- RG -->
        <div class="form-group">
            <label for="rg">RG:</label>
            <input type="text" class="form-control" id="rg" name="rg" value="{{ $usuario->rg }}">
        </div>

        <!-- Nome -->
        <div class="form-group">
            <label for="nome">
                    Nome
                    <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Nome do usuário"></i>
            </label>
            <input type="text" class="form-control" id="nome" name="nome" value="{{ $usuario->nome }}" required>
        </div>

        <!-- Email -->
        <div class="form-group">
            <label for="email">Email:</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ $usuario->email }}" required>
        </div>

        <!-- Username -->
        <div class="form-group">
            <label for="username">
                Username
                <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Nome utilizado para login"></i>
            </label>
            <input type="text" class="form-control" id="username" name="username" value="{{ $usuario->username }}" required>
        </div>

        <!-- Senha -->
        <div class="form-group">
            <label for="senha">Senha:</label>
            <input type="password" class="form-control" id="senha" name="senha" value="{{ $usuario->senha }}" required>
        </div>

        <!-- Cargo -->
        <div class="form-group">
            <label for="cargo">Cargo:</label>
            <input type="text" class="form-control" id="cargo" name="cargo" value="{{ $usuario->cargo }}">
        </div>

        <button type="submit" class="btn btn-primary">Confirmar</button>
    </form>
</div>

</html>
@endsection