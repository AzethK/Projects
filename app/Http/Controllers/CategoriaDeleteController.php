<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class CategoriaDeleteController extends Controller
{
 public function deletarCategoria($id_categoria){
   try {
      DB::delete("delete from categoria where id_categoria in ($id_categoria)");
      return redirect()->route('viewCategoria');
      } catch (Exception $e) {
         if ($e->getCode() == '23503') {
          return redirect()->back()->with('error', 'Não é possível deletar uma categoria atrelada a algum equipamento.');
         } else {
          return redirect()->back()->with('error', 'Ocorreu um erro ao deletar a categoria.');
         }
  }
 }
}
?>