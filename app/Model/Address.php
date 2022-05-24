<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    public function costaddress(){
        return $this->belongsto('App\Model\PinCode','pincode','pincode')->select('pincode','cost');

    }
}
