<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class MarcaInsertController extends Controller
{
    //
    public function insertform(){
        try {
        return view('marca_create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }

        public function insert(Request $request){
            try {
        $marca = $request->input('marca');
        $data=array('marca'=>$marca);
        DB::table('marca')->insert($data);
        return redirect()->route('viewMarca');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a marca.');
    }
    }
        }