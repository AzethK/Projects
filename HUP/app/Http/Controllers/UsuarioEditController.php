<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class UsuarioEditController extends Controller
{
    public function edit($id_usuario)
    {
        try {
        $usuario = DB::table('usuario')->select('*')->where('id_usuario', $id_usuario)->first();
        return view('usuario_edit', compact('usuario'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar o usuário.');
    }
    }

    public function update(Request $request, $id_usuario)
    {
        try {
        $data = $request->only(['cpf', 'rg', 'nome', 'email', 'username', 'senha', 'cargo']);

        // Atualiza os dados no banco
        DB::table('usuario')->where('id_usuario', $id_usuario)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('usuario')->where('id_usuario', $id_usuario)->update($data);

        return redirect('/viewUsuario');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }
}