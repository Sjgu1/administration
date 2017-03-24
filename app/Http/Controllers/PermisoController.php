<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Permiso;

class PermisoController extends Controller
{

    public function search(){

        $permisos = Permiso::get();
        return view('permisos', compact('permisos'));
    }
}
