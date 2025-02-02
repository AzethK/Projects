@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastrar Categoria</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
</head>
<body>

<div class="container">
  <h2 class="text-center">Cadastrar Categoria</h2>
  <br>
  <form action = "/createCategoria" method = "post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">

  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

  <label>Categoria:</label>
    <input type="text" class="form-control" placeholder="categoria" name="categoria" required>
    <button type="submit"  value = "Cadastrar" class="btn btn-primary">Confirmar</button>
  </form>
</div>
@push('scripts')
<script>
    $(".select2").select2({
        theme: "bootstrap-5",
    });
</script>
@endpush
</body>
</html>
@endsection