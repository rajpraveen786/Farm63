<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    public function subcategory(){
        return $this->hasMany('App\Model\SubCategory','cid','id')->select('id','cid','name');
    }



    public function products(){
        return $this->hasMany('App\Model\Products','cid','id')
        ->select(
            'id as id',
            'name',
            'created_at as created_at',
            'fpricewtas',
            'cid',
            'urlslug',
            'scid',
            'status as status',
            'bid as bid',
            'stock',
            'disp',
            'fpricebefdis',
            'disa',
            'oosc',
            'trackqty',
            'status as status',
        )->with('image')
        ->with('category')
        ->where(function ($q) {
            $q->where('stock', '>', 0)
                ->orWhere('oosc', 1);
        })
        ->where('status', 1);
    }
}
