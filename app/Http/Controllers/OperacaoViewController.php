<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
class OperacaoViewController extends Controller
{
    //
    public function index(){
        return view("operacao_view");
        }
}