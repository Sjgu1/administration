<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Permiso;

class Rol extends Model
{

    // Provisional
    public function usuarios(){

        return $this->hasMany('App\Usuario');
    }
    // Fin provisional

    public function permisos(){

        return $this->belongsToMany('App\Permiso');
    }
}
