<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SetorInsertController extends Controller
{
    //
    public function insertform(){
        try {
        return view('setor_create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o setor.');
    }
    }


        public function insert(Request $request){
            try {
        $setor = $request->input('setor');
        $id_estabelecimento = $request->input('id_estabelecimento');
        $pavimento = $request->input('pavimento');
        $data=array('setor'=>$setor,"id_estabelecimento"=>$id_estabelecimento,"pavimento"=>$pavimento);
        DB::table('setor')->insert($data);
        return redirect()->route('viewSetor');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o setor.');
    }
    }
        }