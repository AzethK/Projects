<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class EstabelecimentoDeleteController extends Controller
{
    public function deletarEstabelecimento($id_estabelecimento)
    {
        try {
            DB::delete("delete from estabelecimento where id_estabelecimento in ($id_estabelecimento)");
            return redirect()->route('viewEstabelecimento');
        } catch (Exception $e) {
            if ($e->getCode() == '23503') {
                return redirect()->back()->with('error', 'Não é possível deletar um estabelecimento atrelado a algum setor.');
            } else {
                return redirect()->back()->with('error', 'Ocorreu um erro ao deletar o estabelecimento.');
            }
        }
    }
}
