<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Proyecto extends Model
{
    //
    public function sprint(){
        return $this->hasMany('App\Sprint');
    }
}
