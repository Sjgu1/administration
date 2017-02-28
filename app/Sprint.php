<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sprint extends Model
{
    //
    public function proyecto(){
        return this->belongsTo('App\Proyecto');
    }
}
