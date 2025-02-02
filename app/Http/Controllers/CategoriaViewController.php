<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class CategoriaViewController extends Controller
{
    //
    public function index(Request $request){ 
        try {
        if ($request->has('clear_filters')) {
            return redirect()->route('categoria_view');
        }
        
        $categorias = QueryBuilder::for(Categoria::class)
        ->allowedFilters([
            AllowedFilter::partial('categoria'),
        ])
        ->orderBy('categoria', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('categoria_view', compact('categorias'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }
}