<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Requisito;

class RequisitosController extends Controller
{
    public function pagination(){
        $requisitos = Requisito::paginate(3);
        return view('index', compact('requisitos'));
    }
}
