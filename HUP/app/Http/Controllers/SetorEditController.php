<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class SetorEditController extends Controller
{
    public function edit($id_setor)
    {
        try {
        $setor = DB::table('setor')->select('*')->where('id_setor', $id_setor)->first();
        return view('setor_edit', compact('setor'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar o setor.');
    }
    }

    public function update(Request $request, $id_setor)
    {
        try {
        $data = $request->only(['setor', 'pavimento', 'id_estabelecimento']);

        // Atualiza os dados no banco
        DB::table('setor')->where('id_setor', $id_setor)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('setor')->where('id_setor', $id_setor)->update($data);

        return redirect('/viewSetor');
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao editar o setor.');
}
}
}