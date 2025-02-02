<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SalaEditController extends Controller
{
    public function edit($id_sala)
    {
        try {
        $sala = DB::table('sala')->select('*')->where('id_sala', $id_sala)->first();
        return view('sala_edit', compact('sala'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a sala.');
    }
    }

    public function update(Request $request, $id_sala)
    {
        try {
        $data = $request->only(['nome', 'id_setor']);

        // Atualiza os dados no banco
        DB::table('sala')->where('id_sala', $id_sala)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('sala')->where('id_sala', $id_sala)->update($data);

        return redirect('/viewSala');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a sala.');
    }
    }
}