@extends('layouts.app')
@section('content')

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Setores</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2 class="text-center">Setores</h2>
  <button type="button" id="showFiltersBtn" class="btn btn-outline-primary mb-2">Filtros</button> 
                    <a href="{{ route('insertSetor') }}" class="btn btn-outline-success mb-2">Adicionar</a>
                        <div id="filtersForm" style="display: none;">
                            <form action="{{ route('viewSetor') }}" method="GET">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="string" name="filter[setor]" value="{{ request('filter.setor') }}" placeholder="Setor" class="form-control">
                                        </div>
                                        <div class="col">
                                            <input type="string" name="filter[pavimento]" value="{{ request('filter.pavimento') }}" placeholder="Pavimento" class="form-control">
                                        </div>
                                        <div class="col">
                                            <select name="filter[id_estabelecimento]" class="select2 form-control">
                                                <option value="">Selecione um Estabelecimento</option>
                                                @foreach($estabelecimentos->sortBy('nome') as $estabelecimento)
                                                    <option value="{{ $estabelecimento->id_estabelecimento }}" {{ request('filter.id_estabelecimento') == $estabelecimento->id_estabelecimento ? 'selected' : '' }}>
                                                        {{ $estabelecimento->estabelecimento }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mt-2 mb-2">Filtrar</button>
                                    <a href="{{ route('viewSetor') }}" class="btn btn-outline-secondary">Limpar Filtros</a>
                                </div>
                            </form>
                        </div>
  <table class="table table-bordered table-striped">
    <thead>
      <!-- Tabela de Setores -->
      <tr>
        <th>Setor</th>
        <th>Pavimento</th>
        <th>Estabelecimento</th>
        <th>Data de Criação</th>
        <th>Data de Edição</th>
      </tr>
    </thead>
    <tbody>
      <!-- Insere dados de cada setor na tabela -->
    @foreach ($setores as $setor)
      <tr>
      <td style="white-space: nowrap;">{{ $setor->setor }}</td>
      <td style="white-space: nowrap;">{{ $setor->pavimento }}</td>
      <td style="white-space: nowrap;">{{ $setor->estabelecimento->estabelecimento }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($setor->created_at)->format('H:i d/m/Y') }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($setor->updated_at)->format('H:i d/m/Y') }}</td>
      <!-- Inicia form para receber id_setor para ser usada no delete e no edit -->
      <form action="{{ route('delete.setor', ['id_setor' => $setor->id_setor]) }}" method="POST">
        @csrf <!-- Add a CSRF token for security -->
      <input type="hidden" name="id_setor" value="{{ $setor->id_setor }}">
      <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
      <td><a href="/editarSetor/{{ $setor->id_setor }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
      </form>
      </tr>
      @endforeach 
    </tbody>
  </table>
</div>
</body>
</html>
@endsection