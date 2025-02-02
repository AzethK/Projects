<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class EquipamentoDeleteController extends Controller
{
 public function deletarEquipamento($id_equipamento){
   try {
      DB::delete("delete from equipamento where id_equipamento in ($id_equipamento)");
      return redirect()->route('viewEquipamento');
   } catch (Exception $e) {
      if ($e->getCode() == '23503') {
          return redirect()->back()->with('error', 'Não é possível deletar um equipamento atrelado a alguma operação.');
      } else {
          return redirect()->back()->with('error', 'Ocorreu um erro ao deletar o estabelecimento.');
      }
  }
 }
}
?>