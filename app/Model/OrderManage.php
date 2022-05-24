<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class OrderManage extends Model
{

    protected $casts = [
        'data' => 'object'
    ];
    public function orders(){
        return $this->belongsTo('App\Model\Orders','oid','id');
    }


    public static function insert($id,$status){
        $data=new OrderManage();
        $data->oid=$id;
        $data->status=$status;
        $data->data=[];
        $data->save();
    }

}
