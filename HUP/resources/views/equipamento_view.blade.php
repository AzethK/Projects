@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Equipamentos</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>
<div class="container">
  <h2 class="text-center">Equipamentos</h2>
  <button type="button" id="showFiltersBtn" class="btn btn-outline-primary mb-2">Filtros</button> 
                    <a href="{{ route('insertEquipamento') }}" class="btn btn-outline-success mb-2">Adicionar</a>

                        <div id="filtersForm" style="display: none;">
                            <form action="{{ route('viewEquipamento') }}" method="GET">
                                <div class="form-group">
                                    <div class="row">

                                        <div class="col">
                                            <input type="string" name="filter[patrimonio_uepg]" value="{{ request('filter.patrimonio_uepg') }}" placeholder="Patrimonio UEPG" class="form-control">
                                        </div>

                                        <div class="col">
                                            <input type="string" name="filter[nome]" value="{{ request('filter.nome') }}" placeholder="Nome" class="form-control">
                                        </div>

                                        <div class="col">
                                            <select name="filter[id_sala]" class="select2 form-control">
                                                <option value="">Selecione uma Sala</option>
                                                @foreach($salas->sortBy('nome') as $sala)
                                                    <option value="{{ $sala->id_sala }}" {{ request('filter.id_sala') == $sala->id_sala ? 'selected' : '' }}>
                                                        {{ $sala->nome }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                    </div>
                                    
                                    <div class="row mt-2">
                                        <div class="col">
                                            <input type="string" name="filter[modelo]" value="{{ request('filter.modelo') }}" placeholder="Modelo" class="form-control">
                                        </div>

                                        <div class="col">
                                            <select name="filter[id_categoria]" class="select2 form-control">
                                                <option value="">Selecione uma Categoria</option>
                                                @foreach($categorias->sortBy('categoria') as $categoria)
                                                    <option value="{{ $categoria->id_categoria }}" {{ request('filter.id_categoria') == $categoria->id_categoria ? 'selected' : '' }}>
                                                        {{ $categoria->categoria }}
                                                    </option>
                                                @endforeach
                                            </select>
                                        </div>

                                        <div class="col">
                                            <input type="string" name="filter[num_serie]" value="{{ request('filter.num_serie') }}" placeholder="Num. Série" class="form-control">
                                        </div>
                                    </div>
                                    </div>
                                    <button type="submit" class="btn btn-outline-primary mt-2 mb-2">Filtrar</button>
                                    <a href="{{ route('viewEquipamento') }}" class="btn btn-outline-secondary">Limpar Filtros</a>
                                </div>
                            </form>
                        </div>
  <table class="table table-bordered table-striped">
    <thead>
      <!-- Tabela de equipamento -->
      <tr>
        <th>Patrimônio</th>
        <th>Nome</th>
        <th>Modelo</th>
        <th>Número de série</th>
        <th>Marca</th>
        <th>Categoria</th>
        <th>Local</th>
        <th>Data de Criação</th>
        <th>Data de Edição</th>
        <th>Observação</th>
      </tr>
    </thead>
    <tbody>
      <!-- Insere dados de cada equipamento na tabela -->
    @foreach ($equipamentos as $equipamento)
      <tr>
      <td style="white-space: nowrap;">{{ $equipamento->patrimonio_uepg }}</td>
      <td style="white-space: nowrap;">{{ $equipamento->nome }}</td>
      <td style="white-space: nowrap;">{{ $equipamento->modelo }}</td>
      <td style="white-space: nowrap;">{{ $equipamento->num_serie }}</td>
      <td style="white-space: nowrap;">{{ $equipamento->marca->marca }}</td>
      <td style="white-space: nowrap;">{{ $equipamento->categoria->categoria }}</td>
      <td>{{$equipamento->sala->setor->estabelecimento->estabelecimento}}<br> {{$equipamento->sala->setor->setor}}<br> {{ $equipamento->sala->nome}}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($equipamento->created_at)->format('H:i d/m/Y') }}</td>
      <td style="white-space: nowrap;">{{ \Carbon\Carbon::parse($equipamento->updated_at)->format('H:i d/m/Y') }}</td>
      <td>{{ $equipamento->observacao }}</td>
      <!-- Inicia form para receber id_equipamento para ser usada no delete e no edit -->
      <form action="{{ route('delete.equipamento', ['id_equipamento' => $equipamento->id_equipamento]) }}" method="POST">
        @csrf <!-- Add a CSRF token for security -->
      <input type="hidden" name="id_equipamento" value="{{ $equipamento->id_equipamento }}">
      <td><button type="Submit" class="btn btn-danger"><i class="bi bi-trash"></i></button></td>
      <td><a href="/editarEquipamento/{{ $equipamento->id_equipamento }}" class="btn btn-primary"> <i class="bi bi-pencil-fill"></i></a></td>
      <td><a href="{{ route('viewOperacao', ['id_equipamento' => $equipamento->id_equipamento]) }}" class="btn btn-success"><i class="bi bi-tools"></i></a></td>
      </form>
      </tr>
      @endforeach 
    </tbody>
  </table>
</div>
</body>
</html>
@endsection