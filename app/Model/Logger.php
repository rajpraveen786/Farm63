<?php

namespace App\Model;
use Auth;
use Illuminate\Database\Eloquent\Model;

class Logger extends Model
{
    public function addLog($type,$page,$olddata,$newdata){
        $data=new Logger();
        $data->uid=Auth::user()->id;
        $data->type=$type;
        $data->page=$page;
        $data->olddata=$olddata??null;
        $data->newdata=$newdata??null;
        $data->save();

    }

    public function user(){
        return $this->belongsTo('App\Model\User', 'uid', 'id')->select('id','name');
    }
}
