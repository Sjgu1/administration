<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sprint;

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

    public function sprints(){

        return $this->hasMany('App\Sprint');
        
    }
}
