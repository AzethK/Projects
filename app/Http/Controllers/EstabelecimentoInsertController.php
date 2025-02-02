<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class EstabelecimentoInsertController extends Controller
{
    //
    public function insertform(){
        try {
        return view('estabelecimento_create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }

        public function insert(Request $request){
            try {
        $estabelecimento = $request->input('estabelecimento');
        $data=array('estabelecimento'=>$estabelecimento);
        DB::table('estabelecimento')->insert($data);
        return redirect()->route('viewEstabelecimento');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o estabelecimento.');
    }
}
        }