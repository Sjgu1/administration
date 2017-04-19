<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\RequisitoUser;

class RequisitoUserController extends Controller
{

    public function search($field = null){
        $requisitosusers = RequisitoUser::with('requisito')->with('user')->paginate(8);
        /*$requisitosusers->requisito = $requisitosusers->requisito();
        $requisitosusers->rol = $requisitosusers->rol();
        $requisitosusers->usuario = $requisitosusers->usuario();*/

        $valorID = "";
        $valorNombre="";
        return view('requisitosusers', compact(['requisitosusers', 'valorID', 'valorNombre']));
    }
}
