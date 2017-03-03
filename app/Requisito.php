<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sprint;

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

    public function sprint(){

        return $this->belongsTo('App\Sprint');

    }

}
