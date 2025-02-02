<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class MarcaEditController extends Controller
{
    public function edit($id_marca)
    {
        try {
        $marca = DB::table('marca')->select('*')->where('id_marca', $id_marca)->first();
        return view('marca_edit', compact('marca'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }

    public function update(Request $request, $id_marca)
    {
        try {
        $data = $request->only(['marca']);

        // Atualiza os dados no banco
        DB::table('marca')->where('id_marca', $id_marca)->update($data);

        return redirect('/viewMarca');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a marca.');
    }
    }
}