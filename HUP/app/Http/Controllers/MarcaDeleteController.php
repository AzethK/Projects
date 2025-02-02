<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class MarcaDeleteController extends Controller
{
 public function deletarMarca($id_marca){
   try {
    DB::delete("delete from marca where id_marca in ($id_marca)");
    return redirect()->route('viewMarca');
   } catch (Exception $e) {
      if ($e->getCode() == '23503') {
          return redirect()->back()->with('error', 'Não é possível deletar uma marca atrelada a algum equipamento.');
      } else {
          return redirect()->back()->with('error', 'Ocorreu um erro ao deletar a marca.');
      }
  }
 }
}
?>