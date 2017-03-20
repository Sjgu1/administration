<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisito;

class RequisitosController extends Controller
{
    public function show(){
        $requisitos = Requisito::all();
        return view('index', ['requisitos'=>$requisitos]);
    }
}
