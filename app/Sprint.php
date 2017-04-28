<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Proyecto;
use App\Requisito;

class Sprint extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    public function Sprint(){
        return $this->belongsTo('App\Sprint');
    }

    public function proyecto(){

        return $this->belongsTo('App\Proyecto');

    }

    public function requisitos(){

        return $this->hasMany('App\Requisito');

    }

}
