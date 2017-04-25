<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;

class ProyectoUserController extends Controller
{

    public function search(){
         $proyectosusers = ProyectoUser::with('proyecto')->get();
         return view('proyectosusers', compact('proyectosusers'));
     }

}
