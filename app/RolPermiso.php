<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Permiso;
use App\Rol;

class RolPermiso extends Model
{
    // Tabla que representa esta relación
    protected $table = 'rol_user';

    public function rol(){
        return $this->belongsTo('App\Rol');
    }

    public function permiso(){
        return $this->belongsTo('App\Permiso');
    }

}
