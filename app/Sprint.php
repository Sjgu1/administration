<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proyecto;
use App\Requisito;

class Sprint extends Model
{

    public function proyecto(){

        return $this->belongsTo('App\Proyecto');

    }

    public function requisitos(){

        return $this->hasMany('App\Requisito');

    }

}