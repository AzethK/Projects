<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class SalaDeleteController extends Controller
{
    public function deletarSala($id_sala)
    {
        try {
            DB::delete("delete from sala where id_sala in ($id_sala)");
            return redirect()->route('viewSala');
        } catch (Exception $e) {
            if ($e->getCode() == '23503') {
                return redirect()->back()->with('error', 'Não é possível deletar uma sala atrelada a algum equipamento.');
            } else {
                return redirect()->back()->with('error', 'Ocorreu um erro ao deletar a sala.');
            }
        }
    }
}
