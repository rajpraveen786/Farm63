<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    public function products(){
        return $this->hasMany('App\Model\Products','bid','id');
    }
}
