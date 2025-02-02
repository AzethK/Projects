@extends('layouts.app')
@section('content')
<!-- Recebe lista de estabelecimentos -->

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Estabelecimentos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2 class="text-center">Estabelecimentos</h2>
  <button type="button" id="showFiltersBtn" class="btn btn-outline-primary mb-2">Filtros</button> 
                    <a href="{{ route('insertEstabelecimento') }}" class="btn btn-outline-success mb-2">Adicionar</a>
                        <div id="filtersForm" style="display: none;">
                            <form action="{{ route('viewEstabelecimento') }}" method="GET">
                                <div class="form-group">
                                    <div class="row">
                                        <div class="col">
                                            <input type="string" name="filter[estabelecimento]" value="{{ request('filter.estabelecimento') }}" placeholder="Estabelecimento" class="form-control">
                                        </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mt-2 mb-2">Filtrar</button>
                                    <a href="{{ route('viewEstabelecimento') }}" class="btn btn-outline-secondary">Limpar Filtros</a>
                                </div>
                            </form>
                        </div>
  <table class="table table-bordered table-striped">
    <thead>
      <!-- Tabela de Estabelecimentos -->
      <tr>
        <th>Estabelecimento</th>
        <th>Data de Criação</th>
        <th>Data de Edição</th>
      </tr>
    </thead>
    <tbody>
      <!-- Insere dados de cada estabelecimento na tabela -->
    @foreach ($estabelecimentos as $estabelecimento)
      <tr>
      <td style="white-space: nowrap;">{{ $estabelecimento->estabelecimento }}</td>
      <td style="white-space: nowrap;"> {{ \Carbon\Carbon::parse($estabelecimento->created_at)->format('H:i d/m/Y') }}</td>
      <td style="white-space: nowrap;"{{ \Carbon\Carbon::parse($estabelecimento->updated_at)->format('H:i d/m/Y') }}</td>
      <!-- Inicia form para receber id_estabelecimento para ser usada no delete e no edit -->
      <form action="{{ route('delete.estabelecimento', ['id_estabelecimento' => $estabelecimento->id_estabelecimento]) }}" method="POST">
        @csrf <!-- Add a CSRF token for security -->
      <input type="hidden" name="id_estabelecimento" value="{{ $estabelecimento->id_estabelecimento }}">
      <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
      <td><a href="/editarEstabelecimento/{{ $estabelecimento->id_estabelecimento }}" class="btn btn-primary"><i class="bi bi-pencil-fill"></i></a></td>
      </form>
      </tr>
      @endforeach 
    </tbody>
  </table>
</div>
</body>
</html>
@endsection