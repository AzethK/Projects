@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Usuários</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2 class="text-center">Usuários</h2>
  <button type="button" id="showFiltersBtn" class="btn btn-outline-primary mb-2">Filtros</button> 
                    <a href="{{ route('insertUsuario') }}" class="btn btn-outline-success mb-2">Adicionar</a>
                        <div id="filtersForm" style="display: none;">
                            <form action="{{ route('viewUsuario') }}" method="GET">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="string" name="filter[cpf]" value="{{ request('filter.cpf') }}" placeholder="CPF" class="form-control">
                                        </div>
                                        <div class="col">
                                            <input type="string" name="filter[rg]" value="{{ request('filter.rg') }}" placeholder="RG" class="form-control">
                                        </div>
                                        <div class="col">
                                            <input type="string" name="filter[nome]" value="{{ request('filter.nome') }}" placeholder="Nome" class="form-control">
                                        </div>
                                    </div>

                                    <div class="row mt-2">
                                        <div class="col">
                                            <input type="string" name="filter[email]" value="{{ request('filter.email') }}" placeholder="Email" class="form-control">
                                        </div>
                                        <div class="col">
                                            <input type="string" name="filter[username]" value="{{ request('filter.username') }}" placeholder="Username" class="form-control">
                                        </div>
                                    </div>

                                    <button type="submit" class="btn btn-outline-primary mt-2 mb-2">Filtrar</button>
                                    <a href="{{ route('viewUsuario') }}" class="btn btn-outline-secondary">Limpar Filtros</a>
                                </div>
                            </form>
                        </div>
  <table class="table table-bordered table-striped">
    <thead>
      <!-- Tabela de usuarios -->
      <tr>
        <th>CPF</th>
        <th>Nome</th>
        <th>Email</th>
        <th>Username</th>
        <th>RG</th>
        <th>Data de Criação</th>
        <th>Data de Edição</th>
      </tr>
    </thead>
    <tbody>
      <!-- Insere dados de cada usuario na tabela -->
    @foreach ($usuarios as $usuario)
      <tr>
      <td style="white-space: nowrap;">{{ $usuario->cpf }}</td>
      <td style="white-space: nowrap;">{{ $usuario->nome }}</td>
      <td style="white-space: nowrap;">{{ $usuario->email }}</td>
      <td style="white-space: nowrap;">{{ $usuario->username }}</td>
      <td style="white-space: nowrap;">{{ $usuario->rg }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($usuario->created_at)->format('H:i d/m/Y') }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($usuario->updated_at)->format('H:i d/m/Y') }}</td>
      <!-- Inicia form para receber id_usuario para ser usada no delete e no edit -->
      <form action="{{ route('delete.usuario', ['id_usuario' => $usuario->id_usuario]) }}" method="POST">
        @csrf <!-- Add a CSRF token for security -->
      <input type="hidden" name="id_usuario" value="{{ $usuario->id_usuario }}">
      <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
      <td><a href="/editarUsuario/{{ $usuario->id_usuario }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
      </form>
      </tr>
      @endforeach 
    </tbody>
  </table>
</div>
</body>
</html>
@endsection