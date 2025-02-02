<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EstabelecimentoEditController extends Controller
{
    public function edit($id_estabelecimento)
    {
        try {
        $estabelecimento = DB::table('estabelecimento')->select('*')->where('id_estabelecimento', $id_estabelecimento)->first();
        return view('estabelecimento_edit', compact('estabelecimento'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }

    public function update(Request $request, $id_estabelecimento)
    {
        try {
        $data = $request->only(['estabelecimento']);

        // Atualiza os dados no banco
        DB::table('estabelecimento')->where('id_estabelecimento', $id_estabelecimento)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('estabelecimento')->where('id_estabelecimento', $id_estabelecimento)->update($data);

        return redirect('/viewEstabelecimento');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar o estabelecimento.');
    }
    }
}