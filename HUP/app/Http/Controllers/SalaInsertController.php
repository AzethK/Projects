<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class SalaInsertController extends Controller
{
    //
    public function insertform(){
        try {
        return view('sala_create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a sala.');
    }
        }


        public function insert(Request $request){
            try {
        $nome = $request->input('nome');
        $id_setor = $request->input('id_setor');
        $data=array('nome'=>$nome,"id_setor"=>$id_setor);
        DB::table('sala')->insert($data);
        return redirect()->route('viewSala');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a sala.');
    }
    }
        }