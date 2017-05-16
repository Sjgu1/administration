<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

use App\ProyectoUser;
use App\Requisito;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password', 'username', 'apellidos', 'fecha_registro',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function proyectosusers(){

        return $this->hasMany('App\ProyectoUser');
    }

    // Fin provisional

    public function requisitos(){

        return $this->belongsToMany('App\Requisito');
    }
}
