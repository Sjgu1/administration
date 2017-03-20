<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sprint;
use App\Usuario;

class Requisito extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    public function usuarios(){

        return $this->belongsToMany('App\Usuario');
    }

    public function sprint(){

        return $this->belongsTo('App\Sprint');

    }

    public function requisitos(){

        return $this->belongsToMany('App\Requisito', 'requisito_requisito', 'requisito_id', 'requisito_precedente_id');
    }

}
