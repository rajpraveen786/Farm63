<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    public function customer()
    {
        return $this->belongsTo('App\User', 'uid', 'id')->select('id','name');
    }
    public function reportby()
    {
        return $this->belongsTo('App\User', 'bid', 'id')->select('id','name');
    }
    public function product()
    {
        return $this->belongsTo('App\Model\Products', 'pid', 'id')->select('id','name');
    }
}
