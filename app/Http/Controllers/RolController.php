<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Rol;

class RolController extends Controller
{

    public function search(){

        $rols = Rol::get();
        return view('rols', compact('rols'));
    }
}
