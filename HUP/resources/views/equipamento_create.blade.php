@extends('layouts.app')
@section('content')

<?php $salas = DB::select("select * from sala"); ?>
<?php $marcas = DB::select("select * from marca"); ?>
<?php $categorias = DB::select("select * from categoria"); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastrar Equipamento</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
  <script>
  $(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip(); 
  });
</script>
</head>
<body>

<div class="container">
  <h2 class="text-center">Cadastrar Equipamento</h2>
  <br>
  <form action = "/createEquipamento" method = "post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">

  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

  <label for="patrimonio_uepg">
        Patrimônio
        <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Identificador interno da UEPG"></i>
  </label>
    <input type="text" class="form-control" placeholder="patrimonio_uepg" name="patrimonio_uepg">
  <label for="nome">
        Nome
        <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Nome do equipamento"></i>
  </label>
    <input type="text" class="form-control" placeholder="nome" name="nome">
	<label>Modelo:</label>
    <input type="text" class="form-control" placeholder="modelo" name="modelo">
	<label>Numero de Série:</label>
    <input type="text" class="form-control" placeholder="num_serie" name="num_serie">

  <label for="id_marca">Marca:</label>
  <select class="select2 form-control" name="id_marca" id="id_marca" required>
    <option value="">Selecione uma marca</option>
    @foreach($marcas as $marca)
        <option value="{{ $marca->id_marca }}">{{ $marca->marca }}</option>
    @endforeach
  </select>

  <label for="id_categoria">Categoria:</label>
  <select class="select2 form-control" name="id_categoria" id="id_categoria" required>
    <option value="">Selecione uma categoria</option>
    @foreach($categorias as $categoria)
        <option value="{{ $categoria->id_categoria }}">{{ $categoria->categoria }}</option>
    @endforeach
  </select>
  
  <label for="id_sala">Sala:</label>
  <select class="select2 form-control" name="id_sala" id="id_sala" required>
    <option value="">Selecione uma sala</option>
    @foreach($salas as $sala)
        <option value="{{ $sala->id_sala}}">{{ $sala->nome }}</option>
    @endforeach
  </select>

  <!--<label>estado_baixa:</label>
    <input type="text" class="form-control" placeholder="estado_baixa" name="estado_baixa"><br>-->
  <label>Observacao:</label>
    <input type="text" class="form-control" placeholder="observacao" name="observacao"><br>
    <button type="submit"  value = "Cadastrar" class="btn btn-primary">Confirmar</button>
  </form>
</div>

</body>
</html>
@endsection