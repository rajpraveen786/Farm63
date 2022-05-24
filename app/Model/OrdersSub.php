<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrdersSub extends Model
{

    public function image(){
        return $this->hasOne('App\Model\ProductImage','pid','pid')->select('id','pid','loc');
    }
    public function products(){
        return $this->hasOne('App\Model\Products','id','pid');
    }
    public function adminproducts(){
        return $this->hasOne('App\Model\Products','id','pid')->with('image')->select('id','name','urlslug');
    }


    public function reportorder(){
        return $this->belongsTo('App\Model\Orders','oid','id')->where('status',3);
    }
}
