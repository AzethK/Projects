<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use Exception;

class OperacaoInsertController extends Controller
{
    public function insertManutencaoForm($id_equipamento){
        try {
        return view('manutencao_create',compact('id_equipamento'));
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a manutenção.');
    }
}
    
    public function insertMovimentacaoForm($id_equipamento){
        try {
        return view('movimentacao_create',compact('id_equipamento'));
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a movimentação.');
}
    }

    public function insertEmprestimoForm($id_equipamento){
        try {
        return view('emprestimo_create',compact('id_equipamento'));
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o empréstimo.');
}
}
    
    public function insertManutencao(Request $request)
    {
        try {
        // Validate the form data as needed

        $id_equipamento = $request->input('id_equipamento');
        $id_tipo = 1; 
        $id_usuario=1;
        $descricao_manutencao = $request->input('descricao_manutencao');
        $observacao = $request->input('observacao');

        // Insert data into the 'operacao' table
        DB::table('operacao')->insert([
            'id_usuario'=>$id_usuario,
            'id_equipamento' => $id_equipamento,
            'id_tipo' => $id_tipo,
            'descricao_manutencao' => $descricao_manutencao,
            'observacao' => $observacao,
        ]);

        // Redirect back or to a success page
        return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a manutenção.');
}
    }

    public function insertMovimentacao(Request $request)
    {
        try {
        // Validate the form data as needed

        $id_equipamento = $request->input('id_equipamento');
        $id_tipo = 2; 
        $id_usuario=1;
        $sala_origem_movimentacao = $request->input('sala_origem_movimentacao');
        $sala_destino_movimentacao = $request->input('sala_destino_movimentacao');
        $observacao = $request->input('observacao');

        // Insert data into the 'operacao' table
        DB::table('equipamento')
            ->where('id_equipamento', $id_equipamento)
            ->update(['id_sala' => $sala_destino_movimentacao]);

        DB::table('operacao')->insert([
            'id_usuario'=>$id_usuario,
            'id_equipamento' => $id_equipamento,
            'id_tipo' => $id_tipo,
            'sala_origem_movimentacao' => $sala_origem_movimentacao,
            'sala_destino_movimentacao' => $sala_destino_movimentacao,
            'observacao' => $observacao,
        ]);

        // Redirect back or to a success page
        return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
    } catch (Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a movimentação.');
}
    }

    public function insertEmprestimo(Request $request)
    {
        // Validate the form data as needed

        $id_equipamento = $request->input('id_equipamento');
        $id_tipo = 3; 
        $id_usuario=1;
        $nome_emprestimo = $request->input('nome_emprestimo');
        $cpf_emprestimo = $request->input('cpf_emprestimo');
        $telefone_emprestimo = $request->input('telefone_emprestimo');
        $data_prevista_devolucao_emprestimo = $request->input('data_prevista_devolucao_emprestimo');
        $devolvido_emprestimo = $request->input('devolvido_emprestimo');
        $observacao = $request->input('observacao');

        try {
        // Insert data into the 'operacao' table
            DB::table('operacao')->insert([
                'id_usuario'=>$id_usuario,
                'id_equipamento' => $id_equipamento,
                'id_tipo' => $id_tipo,
                'nome_emprestimo' => $nome_emprestimo,
                'cpf_emprestimo' => $cpf_emprestimo,
                'telefone_emprestimo' => $telefone_emprestimo,
                'data_prevista_devolucao_emprestimo' => $data_prevista_devolucao_emprestimo,
                'devolvido_emprestimo' => $devolvido_emprestimo,
                'observacao' => $observacao,
            ]);

        // Redirect back or to a success page
            return redirect()->route('viewOperacao', ['id_equipamento' => $id_equipamento]);
        } catch (Exception $e) {
            if ($e->getCode() == 'P0001') {
                return redirect()->back()->with('error', 'Não é possível inserir números no nome de empréstimo.');
            } else  if ($e->getCode() == '22008'){
                return redirect()->back()->with('error', 'Favor inserir a data de devolução no fomato dd/mm/yyyy');
            } else {
                return redirect()->back()->with('error', 'Ocorreu um erro ao cadastrar o empréstimo ao inserir o empréstimo.');
            }
        }
    }

    public function insertBaixa(Request $request)
    {
        try {
        $id_equipamento = $request->input('id_equipamento');
        $id_usuario = $request->input('id_usuario');
        $id_tipo = $request->input('id_tipo');

        $isChecked = $request->input('isChecked');

        // Check if an 'operacao' record with 'id_tipo' = 4 and 'id_equipamento' exists
        $existingOperacao = DB::table('operacao')
            ->where('id_tipo', 4)
            ->where('id_equipamento', $id_equipamento)
            ->first();

        if ($existingOperacao) {
            // Update the 'updated_at' timestamp of the existing 'operacao' record
            DB::table('operacao')
                ->where('id_operacao', $existingOperacao->id_operacao)
                ->update(['updated_at' => now()->setTimezone('GMT-3')]);
        } else {
            // Insert data into the 'operacao' table
            DB::table('operacao')->insert([
                'id_equipamento' => $id_equipamento,
                'id_usuario' => $id_usuario,
                'id_tipo' => $id_tipo,
            ]);
        }

        // Update the 'estado_baixa' value in the 'equipamento' table
        DB::table('equipamento')
            ->where('id_equipamento', $id_equipamento)
            ->update(['estado_baixa' => $isChecked]);

        return response()->json(['message' => 'Estado de Baixa atualizado com sucesso']);
    }
    catch (Exception $e) {
        return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a baixa.');
}
    }
}

