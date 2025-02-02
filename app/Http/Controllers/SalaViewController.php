<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\Sala;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class SalaViewController extends Controller
{
    //
    public function index(Request $request){
        try {
        if ($request->has('clear_filters')) {
            return redirect()->route('sala_view');
        }

        $setores = Setor::all();
        $estabelecimentos = Estabelecimento::all();

        $salas = QueryBuilder::for(Sala::class)
        ->allowedFilters([
            AllowedFilter::partial('nome'),
            AllowedFilter::exact('id_setor'),
        ])
        ->orderBy('sala', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('sala_view', compact('salas','setores','estabelecimentos'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o setor.');
    }
    }
}