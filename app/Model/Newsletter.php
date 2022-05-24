<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Newsletter extends Model
{

    protected $casts = [
        'type' => 'array'
    ];
}
