<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;

class UserController extends Controller
{

    public function search(){
        
        $users = User::get();
        return view('users', compact('users'));
    }
}
