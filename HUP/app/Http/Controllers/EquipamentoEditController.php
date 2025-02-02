<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;

class EquipamentoEditController extends Controller
{
    public function edit($id_equipamento)
    {
        try {
        $equipamento = DB::table('equipamento')->select('*')->where('id_equipamento', $id_equipamento)->first();
        return view('equipamento_edit', compact('equipamento'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }

    public function update(Request $request, $id_equipamento)
    {
        try {
        $data = $request->only(['patrimonio_uepg', 'nome', 'modelo', 'num_serie', 'id_marca', 'id_categoria', 'id_sala', 'observacao']);

        // Atualiza os dados no banco
        DB::table('equipamento')->where('id_equipamento', $id_equipamento)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('equipamento')->where('id_equipamento', $id_equipamento)->update($data);

        return redirect('/viewEquipamento');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar o equipamento.');
    }
    }
}