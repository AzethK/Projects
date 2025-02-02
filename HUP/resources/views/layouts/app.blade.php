<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>HU Patrimônios</title>
    <!-- Adicione os links para os arquivos CSS do Bootstrap e outros estilos -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/css/all.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- Adicione seus estilos personalizados -->
    <!-- <link href="caminho/para/seu/arquivo.css" rel="stylesheet"> -->

</head>
<body class="d-flex flex-column h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
            <!-- Logo -->
            <a class="navbar-brand" href="#">
                <img src="{{ asset('HU_logo.png') }}" width="180" height="50" class="d-inline-block align-top">
            </a>
            <!-- Nome do Projeto -->
            <div class="container">
                <div class="row">
                    <div class="d-flex align-items-start pb-3">
                        <h2>HU Patrimônios</h2>
                    </div>
                </div>
            </div>
            <!-- Nome do Usuário e opção de Sair -->
            <ul class="navbar-nav ml-auto">
                <li class="nav-item">
                    <span class="nav-link">Usuário</span>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#">
                        Sair <i class="bi bi-box-arrow-right"></i>
                    </a>
                </li>
            </ul>
        </div>
    </nav>

    <!-- Sidebar -->
    <div class="container-fluid">
        <div class="row flex-xl-nowrap">
            <nav id="sidebar" class="col-md-3 col-lg-2 d-md-block bg-light sidebar">
                <!-- Links da Sidebar -->
                <div class="position-sticky">
                    <ul class="nav flex-column">
                        <li class="nav-item">
                            <a class="nav-link active" href="/">
                                <i class="bi bi-house-fill"></i> Página Inicial
                            </a>
                        </li>
                        <li class="nav-item dropdown">
                            <a class="nav-link dropdown-toggle" href="#" role="button" id="submenuUsuarios" data-bs-toggle="dropdown" aria-expanded="false">
                                <i class="bi bi-pencil-square"></i> Gestão
                            </a>
                            <ul class="dropdown-menu" aria-labelledby="submenuUsuarios">
                                <li><a class="dropdown-item" href="/viewUsuario/">Usuários</a></li>
                                <li><a class="dropdown-item" href="/viewEstabelecimento/">Estabelecimentos</a></li>
                                <li><a class="dropdown-item" href="/viewSetor/">Setores</a></li>
                                <li><a class="dropdown-item" href="/viewSala/">Salas</a></li>
                                <li><a class="dropdown-item" href="/viewCategoria/">Categorias</a></li>
                                <li><a class="dropdown-item" href="/viewMarca/">Marcas</a></li>
                            </ul>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="/viewEquipamento/">
                                <i class="bi bi-pc-display"></i> Equipamentos
                            </a>
                        </li>
                        <!-- Adicione mais itens conforme necessário -->
                    </ul>
                </div>
            </nav>

            <!-- Conteúdo das Views -->
            <main class="col-md-9 ms-sm-auto col-lg-10 px-md-4">
            <body class="d-flex flex-column h-100">
    @if(session('error'))
        <div class="alert alert-danger">
            {{ session('error') }}
        </div>
    @endif
                <!-- O conteúdo das suas views será renderizado aqui -->
                @yield('content')
            </main>
        </div>
    </div>

    <!-- Adicione os scripts do Bootstrap e outros scripts -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/js/select2.full.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
    <!-- Adicione seus scripts personalizados -->
    <!-- <script src="caminho/para/seu/arquivo.js"></script> -->
</body>
<script>
    $(document).ready(function() {
        $(".select2").select2({
            theme: "bootstrap-5",
        });
    });

const showFiltersBtn = document.getElementById('showFiltersBtn');
const filtersForm = document.getElementById('filtersForm');
let filtersVisible = false;

showFiltersBtn.addEventListener('click', function() {
    filtersVisible = !filtersVisible;
    filtersForm.style.display = filtersVisible ? 'block' : 'none';
});
</script>
</html>