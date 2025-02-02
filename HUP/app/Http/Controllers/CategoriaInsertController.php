<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class CategoriaInsertController extends Controller
{
    //
    public function insertform(){
        try {
            return view('categoria_create');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Ocorreu um erro.');
            }
        }
    
    public function insert(Request $request){
        try {
            $categoria = $request->input('categoria');
            $data=array('categoria'=>$categoria);
            DB::table('categoria')->insert($data);
            return redirect()->route('viewCategoria');
            } catch (Exception $e) {
                return redirect()->back()->with('error', 'Ocorreu um erro ao inserir a categoria.');
        }
        }
        }