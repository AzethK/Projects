<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;
use App\Http\Requests;
use App\Http\Controllers\Controller;

class UsuarioInsertController extends Controller
{
    //
    public function insertform(){
        try {
        return view('usuario_create');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro ao inserir o usuário.');
    }
    }


        public function insert(Request $request){
            try {
        $cpf = $request->input('cpf');
        $nome = $request->input('nome');
        $email = $request->input('email');
		$username = $request->input('username');
		$senha = $request->input('senha');
        $rg = $request->input('rg');
        $data=array("cpf"=>$cpf,"nome"=>$nome,"email"=>$email,"username"=>$username,"senha"=>$senha, "rg"=>$rg);
        DB::table('usuario')->insert($data);
        return redirect()->route('viewUsuario');
        } catch (Exception $e) {
            return redirect()->back()->with('error', 'Ocorreu um erro.');
    }
    }
        }