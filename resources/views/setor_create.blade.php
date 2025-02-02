@extends('layouts.app')
@section('content')
<?php $estabelecimentos = DB::select("select * from estabelecimento"); ?>

<!DOCTYPE html>
<html lang="en">
<head>
<title>Cadastrar Setor</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>

<div class="container">
  <h2 class="text-center">Cadastrar Setor</h2>
  <br>
  <form action = "/createSetor" method = "post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">

  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

    <label>Nome:</label>
        <input type="text" class="form-control" placeholder="setor" name="setor">

    <label for="id_setor">Estabelecimento:</label>
    <select name="id_estabelecimento" id="id_estabelecimento" class="select2 form-control">
        <option value="">Selecione um estabelecimento</option>
        @foreach($estabelecimentos as $estabelecimento)
            <option value="{{ $estabelecimento->id_estabelecimento }}">{{ $estabelecimento->estabelecimento }}</option>
        @endforeach
    </select>

    <label>Pavimento:</label>
        <input type="integer" class="form-control" placeholder="pavimento" name="pavimento">

    <button type="submit"  value = "Cadastrar" class="btn btn-primary">Confirmar</button>
  </form>
</div>
</body>
</html>
@endsection