<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Permiso;
use App\ProyectoUser;

class Rol extends Model
{

    public function rolsusers(){

        return $this->hasMany('App\RolPermiso');
    }

    public function permisos(){

        return $this->belongsToMany('App\Permiso');
    }
}
