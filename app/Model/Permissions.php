<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{

    protected $casts = [
        'general' => 'object'
    ];
}
