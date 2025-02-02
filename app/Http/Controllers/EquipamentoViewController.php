<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Equipamento;
use App\Models\Marca;
use App\Models\Sala;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class EquipamentoViewController extends Controller
{
    //
    public function index(Request $request){
        if ($request->has('clear_filters')) {
            return redirect()->route('equipamento_view');
        }
        
        $marcas = Marca::all();
        $categorias = Categoria::all();
        $salas = Sala::all();
        
        $equipamentos = QueryBuilder::for(Equipamento::class)
        ->allowedFilters([
            AllowedFilter::partial('patrimonio_uepg'),
            AllowedFilter::exact('nome'),
            AllowedFilter::exact('id_sala'),
            AllowedFilter::partial('modelo'),
            AllowedFilter::exact('id_categoria'),
            AllowedFilter::partial('num_serie'),
        ])
        ->where('estado_baixa', false)
        ->orderBy('nome', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('equipamento_view', compact('equipamentos','marcas','categorias','salas'));
        }
}