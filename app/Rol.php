<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Permiso;
use App\ProyectoUser;

class Rol extends Model
{

    public function proyectosusers(){

        return $this->hasMany('App\RolPermio');
    }

    public function permisos(){

        return $this->belongsToMany('App\Permiso');
    }
}
