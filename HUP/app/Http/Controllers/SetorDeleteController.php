<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class SetorDeleteController extends Controller
{
    public function deletarSetor($id_setor)
    {
        try {
            DB::delete("delete from setor where id_setor in ($id_setor)");
            return redirect()->route('viewSetor');
        } catch (Exception $e) {
            if ($e->getCode() == '23503') {
                return redirect()->back()->with('error', 'Não é possível deletar um setor atrelado a alguma sala.');
            } else {
                return redirect()->back()->with('error', 'Ocorreu um erro ao deletar o setor.');
            }
        }
    }
}
