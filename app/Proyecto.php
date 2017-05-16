<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sprint;
use App\ProyectoUser;

class Proyecto extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'nombre'
    ];

    public function proyectosusers(){

        return $this->hasMany('App\ProyectoUser');
    }

    public function sprints(){

        return $this->hasMany('App\Sprint');
        
    }
}
