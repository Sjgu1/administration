<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Mail;

class ContactoController extends Controller
{
    public function __construct(){

        parent::__construct();
    }
    
        public function contacto(Request $request)
    {
        
        $nombre = $request->input('name');
        $surname = $request->input('surname');
        $dir = $request->input('email');
        $phone = $request->input('phone');
        $messages = $request->input('message');

        $data = "Mensaje de: ". $dir . "
        Nombre: ". $nombre . "
        Apellidos: ". $surname ."
        Telefono: " . $phone . "

        Mensaje: " . $messages ;

        Mail::raw($data, function ($message) {
            $message->to('crisantemo.dss.2017@gmail.com', 'Crisantemo');
        });
        return view('public/home');
    }
}