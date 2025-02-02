<?php

namespace App\Http\Controllers;

use App\Models\Estabelecimento;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;
class EstabelecimentoViewController extends Controller
{
    //
    public function index(Request $request){
        try {
        if ($request->has('clear_filters')) {
            return redirect()->route('estabelecimento_view');
        }
        
        $estabelecimentos = QueryBuilder::for(Estabelecimento::class)
        ->allowedFilters([
            AllowedFilter::partial('estabelecimento'),
        ])
        ->orderBy('estabelecimento', 'asc')
        ->paginate(100)
        ->appends(request()->query());

        return view('estabelecimento_view', compact('estabelecimentos'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
}
}