@extends('layouts.app')
@section('content')
<div class="text-center">
    <h2>Página inicial</h2>
</div>

<div class="card mb-grid text-center">
    <div class="card-header">
        <ul class="nav nav-tabs card-header-tabs" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="card-tab-1" data-toggle="tab" href="#card-tab-content-1" role="tab" aria-controls="card-tab-1" aria-selected="true">Orientações gerais</a>
            </li>
        </ul>
    </div>
    <div class="card-body">
        <div class="tab-content">
            <div class="tab-pane fade show active" id="card-tab-content-1" role="tabpanel" aria-labelledby="card-tab-1">
                <!--<div>home_orientacoes_gerais</div>-->
                <h4 style="text-align: left;">Seja bem-vindo ao sistema de patrimônios do Hospital Universitário UEPG!</h4>
                <p style="text-align: left;">Para visualizar os equipamentos localizados em seu setor, acesse o menu <strong>Equipamentos</strong>.</p>
            </div>
            <div class="tab-pane fade" id="card-tab-content-2" role="tabpanel" aria-labelledby="card-tab-2">
                <!--<div>home_termos</div>-->
            </div>
            <div class="tab-pane fade" id="card-tab-content-3" role="tabpanel" aria-labelledby="card-tab-3">
                <div class="card text-center">
                    <img class="img-fluid" style="max-width: 1164px" src="{{ asset('img/novo-fluxo-pesquisadac.jpeg') }}" alt="Figura do fluxo de funcionamento do sistema">
                </div>
            </div>
        </div>
    </div>
</div>
@endsection