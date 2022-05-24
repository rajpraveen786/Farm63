<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use DB;
use Illuminate\Support\Facades\DB as FacadesDB;

class Products extends Model
{

    protected $casts = [
        'tags' => 'array'
    ];
    public function category()
    {
        return $this->belongsTo('App\Model\Category', 'cid', 'id')->select('id', 'name');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Model\SubCategory', 'scid', 'id')->select('id', 'name');
    }
    public function brand()
    {
        return $this->belongsTo('App\Model\Brand', 'bid', 'id')->select('id', 'name');
    }
    public function packing()
    {
        return $this->belongsTo('App\Model\Packing', 'packingid', 'id')->select('id', 'name');
    }
    public function uom()
    {
        return $this->belongsTo('App\Model\UOM', 'uomid', 'id')->select('id', 'name');
    }
    public function images()
    {
        return $this->hasMany('App\Model\ProductImage', 'pid', 'id')->select('id', 'pid', 'loc');
    }
    public function image()
    {
        return $this->hasOne('App\Model\ProductImage', 'pid', 'id')->select('id', 'pid', 'loc');
    }
    public function discounts()
    {
        return $this->belongsTo('App\Model\Discounts', 'disid', 'id');
    }

    public function cart()
    {
        return $this->hasOne('App\Model\Cart', 'pid', 'id')->select('id', 'qty', 'uid', 'pid');
    }
    public function wishlist()
    {
        return $this->hasOne('App\Model\WishList', 'pid', 'id')->select('id', 'uid', 'pid','created_at');
    }

    public function prodsold()
    {
        return $this->hasMany('App\Model\OrdersSub', 'pid', 'id')->select('id', 'created_at', 'pid',);
    }


    public function prodsoldadmin()
    {
        return $this->hasMany('App\Model\OrdersSub', 'pid', 'id')
        ->whereHas('reportorder', function($q){
            $q->where('status', 3);
        });
    }

    public function prodreport()
    {
        return $this->hasMany('App\Model\OrdersSub', 'pid', 'id')->where('status',3);
    }

    public function custreview()
    {
        return $this->hasMany('App\Model\Review', 'pid', 'id')->with('customer')->orderBy('id','desc');
    }
    public function review()
    {
        return $this->hasMany('App\Model\Review', 'pid', 'id')->with('customer')->orderBy('id','desc')->where('status',1);
    }

    public function sinrev()
    {
        return $this->hasMany('App\Model\Review', 'pid', 'id')->orderBy('id','desc')->where('status',1)->select('id','pid',DB::raw('round(AVG(reviews.rating),1) as avgrating'));
    }
}
