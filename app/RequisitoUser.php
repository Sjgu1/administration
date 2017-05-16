<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Usuario;
use App\Requisito;
use App\Rol;

class RequisitoUser extends Model
{
    // Tabla que representa esta relación
    protected $table = 'requisito_user';

    public function Requisito(){
        return $this->belongsTo('App\Requisito');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function rol(){

        return $this->belongsTo('App\Rol');
    }
}
