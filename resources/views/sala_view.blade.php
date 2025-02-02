@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Salas</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2 class="text-center">Salas</h2>
  <button type="button" id="showFiltersBtn" class="btn btn-outline-primary mb-2">Filtros</button> 
                    <a href="{{ route('insertSala') }}" class="btn btn-outline-success mb-2">Adicionar</a>
                        <div id="filtersForm" style="display: none;">
                            <form action="{{ route('viewSala') }}" method="GET">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="string" name="filter[nome]" value="{{ request('filter.nome') }}" placeholder="Nome" class="form-control">
                                        </div>
                                        <div class="col">
                                            <select name="filter[id_setor]" class="select2 form-control">
                                                <option value="">Selecione um Setor</option>
                                                @foreach($setores->sortBy('nome') as $setor)
                                                    <option value="{{ $setor->id_setor }}" {{ request('filter.id_setor') == $setor->id_setor ? 'selected' : '' }}>
                                                        {{ $setor->setor }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mt-2 mb-2">Filtrar</button>
                                    <a href="{{ route('viewSala') }}" class="btn btn-outline-secondary">Limpar Filtros</a>
                                </div>
                            </form>
                        </div>
  <table class="table table-bordered table-striped">
    <thead>
      <!-- Tabela de salas -->
      <tr>
        <th>Sala</th>
        <th>Setor</th>
        <th>Estabelecimento</th>
        <th>Data de Criação</th>
        <th>Data de Edição</th>
      </tr>
    </thead>
    <tbody>
      <!-- Insere dados de cada sala na tabela -->
    @foreach ($salas as $sala)
      <tr>
      <td style="white-space: nowrap;">{{ $sala->nome }}</td>
      <td style="white-space: nowrap;">{{ $sala->setor->setor }}</td>
      <td style="white-space: nowrap;">{{ $sala->setor->estabelecimento->estabelecimento }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($sala->created_at)->format('H:i d/m/Y') }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($sala->updated_at)->format('H:i d/m/Y') }}</td>
      <!-- Inicia form para receber id_sala para ser usada no delete e no edit -->
      <form action="{{ route('delete.sala', ['id_sala' => $sala->id_sala]) }}" method="POST">
        @csrf <!-- Add a CSRF token for security -->
      <input type="hidden" name="id_sala" value="{{ $sala->id_sala }}">
      <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
      <td><a href="/editarSala/{{ $sala->id_sala }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
      </form>
      </tr>
      @endforeach 
    </tbody>
  </table>
</div>
</body>
</html>
@endsection