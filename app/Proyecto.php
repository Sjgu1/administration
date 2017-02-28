<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Sprint;

class Proyecto extends Model
{

    public function sprints(){

        return $this->hasMany('App\Sprint');
        
    }
}
