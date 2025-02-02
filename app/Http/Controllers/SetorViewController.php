<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use App\Models\Setor;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class SetorViewController extends Controller
{
    //
    public function index(Request $request){
        try {
        if ($request->has('clear_filters')) {
            return redirect()->route('setor_view');
        }

        $estabelecimentos = Estabelecimento::all();

        $setores = QueryBuilder::for(Setor::class)
        ->allowedFilters([
            AllowedFilter::partial('setor'),
            AllowedFilter::exact('id_estabelecimento'),
            AllowedFilter::exact('pavimento'),
        ])
        ->orderBy('setor', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('setor_view', compact('setores','estabelecimentos'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }
}