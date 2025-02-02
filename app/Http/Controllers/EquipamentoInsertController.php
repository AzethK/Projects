<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EquipamentoInsertController extends Controller
{
    //
    public function insertform(){
        try {
        return view('equipamento_create');
        }catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }


        public function insert(Request $request){
            try {
        $patrimonio_uepg = $request->input('patrimonio_uepg');
        $nome = $request->input('nome');
        $modelo = $request->input('modelo');
        $num_serie = $request->input('num_serie');
		$id_marca = $request->input('id_marca');
		$id_categoria = $request->input('id_categoria');
        $id_sala = $request->input('id_sala');
        $observacao = $request->input('observacao');
        $data=array('patrimonio_uepg'=>$patrimonio_uepg, "nome"=>$nome,"modelo"=>$modelo,"num_serie"=>$num_serie,"id_marca"=>$id_marca,"id_categoria"=>$id_categoria
            ,"id_sala"=>$id_sala,"observacao"=>$observacao);
        DB::table('equipamento')->insert($data);
        return redirect()->route('viewEquipamento');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o equipamento.');
        }
        }
        }