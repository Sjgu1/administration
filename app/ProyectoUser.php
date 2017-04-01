<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Proyecto;
use App\Rol;

class ProyectoUser extends Model
{
    // Tabla que representa esta relación
    protected $table = 'proyecto_user';

    public function proyecto(){
        return $this->belongsTo('App\Proyecto');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function rol(){

        return $this->belongsTo('App\Rol');
    }
}
