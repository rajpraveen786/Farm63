<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Orders extends Model
{
    public function ordersub(){
        return $this->hasMany('App\Model\OrdersSub','oid','id')->with('image');
    }
    public function payment(){
        return $this->hasOne('App\Model\PaymentStatus','oid','id');
    }
    public function ordersubadmin(){
        return $this->hasMany('App\Model\OrdersSub','oid','id')->with('image');
    }
    public function ordersublist(){
        return $this->hasMany('App\Model\OrdersSub','oid','id')->with('image');
    }
    public function customer(){
        return $this->belongsTo('App\User','uid','id')->select('name','id','phno','email');
    }
    public function store(){
        return $this->belongsTo('App\Model\Store','uid','id');
    }
    public function refunddata(){
        return $this->hasone('App\Model\RetCanOrder','oid','id');
    }

    public function adminpincode(){
        return $this->belongsTo('App\Model\PinCode','id','pincodeid');
    }
    public function ordersmanage(){
        return $this->hasMany('App\Model\OrderManage','oid','id')->orderBy('created_at','desc');
    }
}
