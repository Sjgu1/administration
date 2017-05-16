<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use App\Requisito;

class Modificacion extends Model
{

    public function requisito(){

        return $this->belongsTo('App\Requisito');
    }
}
