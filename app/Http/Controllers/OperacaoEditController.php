<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class OperacaoEditController extends Controller
{
    public function editManutencao($id_operacao)
    {
        try {
        $operacao = DB::table('operacao')->select('*')->where('id_operacao', $id_operacao)->first();
        return view('manutencao_edit', compact('operacao'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a manutenção.');
    }
    }

    public function editMovimentacao($id_operacao)
    {
        try {
        $operacao = DB::table('operacao')->select('*')->where('id_operacao', $id_operacao)->first();
        return view('movimentacao_edit', compact('operacao'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a movimentação.');
    }
    }

    public function editEmprestimo($id_operacao)
    {
        try {
        $operacao = DB::table('operacao')->select('*')->where('id_operacao', $id_operacao)->first();
        return view('emprestimo_edit', compact('operacao'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar o empréstimo.');
    }
    }

    public function updateManutencao(Request $request, $id_operacao, $id_equipamento)
    { 
        try {
        $data = $request->only(['id_operacao', 'id_equipamento', 'id_usuario', 'id_tipo', 'descricao_manutencao', 'observacao']);
        // Atualiza os dados no banco
        DB::table('operacao')->where('id_operacao', $id_operacao)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('operacao')->where('id_operacao', $id_operacao)->update($data);
        return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a manutenção.');
    }
    }

    public function updateMovimentacao(Request $request, $id_operacao, $id_equipamento)
    {
        try {
        $data = $request->only(['id_operacao', 'id_equipamento', 'id_usuario', 'id_tipo', 'sala_origem_movimentacao', 'sala_destino_movimentacao','observacao']);
        // Atualiza os dados no banco
        DB::table('operacao')->where('id_operacao', $id_operacao)->update(['updated_at' => now()->setTimezone('GMT-3')]);
        DB::table('operacao')->where('id_operacao', $id_operacao)->update($data);
        return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao editar a movimentação.');
    }
    }

    public function updateEmprestimo(Request $request, $id_operacao, $id_equipamento)
    { 
        $data = $request->only(['id_operacao', 'id_equipamento', 'id_usuario', 'id_tipo', 'nome_emprestimo', 'telefone_emprestimo','data_prevista_devolucao_emprestimo',
        'devolvido_emprestimo','cpf_emprestimo','observacao']);
        // Atualiza os dados no banco
        try {
            DB::table('operacao')->where('id_operacao', $id_operacao)->update(['updated_at' => now()->setTimezone('GMT-3')]);
            DB::table('operacao')->where('id_operacao', $id_operacao)->update($data);
            return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
        } catch (Exception $e) {
            if ($e->getCode() == 'P0001') {
                return redirect()->back()->with('error', 'Não é possível inserir números no nome de empréstimo.');
            } else {
                return redirect()->back()->with('error', 'Ocorreu um erro ao editar o empréstimo.');
            }
        }
    }
}