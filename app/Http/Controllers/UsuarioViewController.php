<?php

namespace App\Http\Controllers;

use App\Models\Usuario;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class UsuarioViewController extends Controller
{
    //
    public function index(Request $request){
        try {
        if ($request->has('clear_filters')) {
            return redirect()->route('usuario_view');
        }
        
        $usuarios = QueryBuilder::for(Usuario::class)
        ->allowedFilters([
            AllowedFilter::exact('cpf'),
            AllowedFilter::exact('rg'),
            AllowedFilter::partial('nome'),
            AllowedFilter::partial('email'),
            AllowedFilter::partial('username'),
        ])
        ->orderBy('usuario', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('usuario_view', compact('usuarios'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }
}