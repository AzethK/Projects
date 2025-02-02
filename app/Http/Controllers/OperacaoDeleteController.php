<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class OperacaoDeleteController extends Controller
{
 public function deletarOperacao($id_operacao, $id_equipamento){
   try {
    DB::delete("delete from operacao where id_operacao in ($id_operacao)");
    return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
   } catch (Exception $e) {
      return redirect()->back()->with('error', 'Ocorreu um erro ao deletar a operação.');
   }
 }
}
?>