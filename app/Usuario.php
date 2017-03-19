<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proyecto;
use App\Rol;
use App\Requisito;

class Usuario extends Model
{

    public function proyectos(){

        return $this->belongsToMany('App\Proyecto');
    }

    // Provisional
    public function rol(){

        return $this->belongsTo('App\Rol');
    }
    // Fin provisional

    public function requisitos(){

        return $this->belongsToMany('App\Requisito');
    }
}
