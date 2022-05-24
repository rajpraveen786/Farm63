<?php

namespace App\Http\Controllers\Api\Profile;

use App\Http\Controllers\Controller;
use App\Model\Orders;
use Illuminate\Http\Request;

class Order extends Controller
{
    public function index(Request $request)
    {
        $data = Orders::select('created_at','total','id','status','paystatus','paytype')->with('ordersub')->where('uid',$request->user()->id)->orderBy('id','desc');
        if($request->orderno){
            $data=$data->where('id','LIKE','%'.$request->orderno.'%');
        }
        if(in_array($request->type, [5,7])){
            $data=$data->where('status',$request->type);
        }
        $data=$data->paginate(20);

        return response()->json([
            'success' => true,
            'message' => 'Fetched Data',
            'data' => $data,
        ], 200);

    }
}
