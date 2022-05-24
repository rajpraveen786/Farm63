<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class PinCode extends Model
{

    protected $casts = [
        'generaldata' => 'object'
    ];

    public function storedata(){
        return $this->belongsTo('App\Model\Store','store','id');
    }
}
