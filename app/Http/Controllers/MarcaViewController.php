<?php

namespace App\Http\Controllers;

use App\Models\Marca;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class MarcaViewController extends Controller
{
    public function index(Request $request){
        try {
        if ($request->has('clear_filters')) {
            return redirect()->route('marca_view');
        }
        
        $marcas = QueryBuilder::for(Marca::class)
        ->allowedFilters([
            AllowedFilter::partial('marca'),
        ])
        ->orderBy('marca', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('marca_view', compact('marcas'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }
}