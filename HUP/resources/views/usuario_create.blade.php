@extends('layouts.app')
@section('content')
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Cadastrar Usuário</title>
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
  <h2 class="text-center">Cadastrar Usuário</h2>
  <br>
  <form action = "/createUsuario" method = "post" class="form-group" style="width:70%; margin-left:15%;" action="/action_page.php">

  <input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>"><input type = "hidden" name = "_token" value = "<?php echo csrf_token(); ?>">

    <label>CPF:</label>
    <input type="text" class="form-control" placeholder="CPF" name="cpf" required>
    <label>RG:</label>
    <input type="text" class="form-control" placeholder="RG" name="rg">
    <label for="nome">
        Nome
        <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Nome do usuário"></i>
  </label>
    <input type="text" class="form-control" placeholder="Nome" name="nome" required>
	  <label for="username">
        Username
        <i class="fas fa-question-circle" data-toggle="tooltip" data-placement="top" title="Nome utilizado para login"></i>
    </label>
    <input type="text" class="form-control" placeholder="Username" name="username" required>
	  <label>Senha:</label>
    <input type="password" class="form-control" placeholder="Senha" name="senha" required>
    <label>Email:</label>
    <input type="email" class="form-control" placeholder="Email" name="email" required><br>
    <button type="submit"  value = "Adicionar Usuario" class="btn btn-primary">Confirmar</button>
  </form>
</div>

</body>
</html>
@endsection