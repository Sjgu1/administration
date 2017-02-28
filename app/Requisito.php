<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sprint;

class Requisito extends Model
{

    public function sprint(){

        return $this->belongsTo('App\Sprint');

    }

}
