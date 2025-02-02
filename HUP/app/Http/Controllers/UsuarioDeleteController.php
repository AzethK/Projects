<?php 

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class UsuarioDeleteController extends Controller
{
 public function deletarUsuario($id_usuario){
   try {
    DB::delete("delete from usuario where id_usuario in ($id_usuario)");
    return redirect()->route('viewUsuario');
   } catch (Exception $e) {
      if ($e->getCode() == '23503') {
          return redirect()->back()->with('error', 'Não é possível deletar um usuário atrelado a alguma operação.');
      } else {
          return redirect()->back()->with('error', 'Ocorreu um erro ao deletar o usuário.');
      }
   }
 }
}
?>