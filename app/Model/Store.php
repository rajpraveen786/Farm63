<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Store extends Model
{
    protected $casts = [
        'general' => 'object'
    ];
}
