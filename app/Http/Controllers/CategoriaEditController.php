<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class CategoriaEditController extends Controller
{
    public function edit($id_categoria)
    {
        try {
            $categoria = DB::table('categoria')->select('*')->where('id_categoria', $id_categoria)->first();
            return view('categoria_edit', compact('categoria'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
        }
        
    }

    public function update(Request $request, $id_categoria)
    {
        try {
            $data = $request->only(['categoria']);

            // Atualiza os dados no banco
            DB::table('categoria')->where('id_categoria', $id_categoria)->update($data);

            return redirect('/viewCategoria');
        }  catch (Exception $e) {
             return redirect()->back()->with('error', 'Ocorreu um erro ao editar a categoria.');
     }
    }
}