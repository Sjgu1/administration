<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ProyectoUser;
use Auth;
use Log;

class ProyectoUserController extends Controller
{

    public function search(){
         $user = Auth::id();
         Log::info($user);
         $proyectosusers = ProyectoUser::with('proyecto')->get()->where('user_id', $user);
         return view('proyectosusers', compact('proyectosusers'));


     }

}
