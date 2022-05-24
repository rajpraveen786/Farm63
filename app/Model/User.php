<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    public function permission(){
        return $this->hasOne('App\Model\Permissions','uid','id');
    }
    public function reviews(){
        return $this->hasMany('App\Model\Review','uid','id');
    }
}
