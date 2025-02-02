@extends('layouts.app')
@section('content')
<?php $setores = DB::select("select * from setor"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastrar Sala</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 class="text-center">Cadastrar Sala</h2>
  <br>
  <form action = "/createSala" method = "post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">

  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

    <label>Nome:</label>
        <input type="text" class="form-control" placeholder="nome" name="nome" required>

    <label for="id_setor">Setor:</label>
    <select class="select2 form-control" name="id_setor" id="id_setor" required>
        <option value="">Selecione um setor</option>
        @foreach($setores as $setor)
            <option value="{{ $setor->id_setor }}">{{ $setor->setor }}</option>
        @endforeach
    </select>

    <button type="submit"  value = "Cadastrar" class="btn btn-primary">Confirmar</button>
  </form>
</div>

</body>
</html>
@endsection