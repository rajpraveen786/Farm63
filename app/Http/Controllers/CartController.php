<?php

namespace App\Http\Controllers;

use App\Mail\NewOrder;
use App\Model\Address;
use App\Model\Cart;
use App\Model\OrderManage;
use App\Model\Orders;
use App\Model\OrdersSub;
use App\Model\PinCode;
use App\Model\Products;
use App\Model\PromoCode;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Illuminate\Support\Facades\Mail;

class CartController extends Controller
{
    public function index()
    {

        $pid = Cart::where('uid', Auth::user()->id)->pluck('pid');
        $data = Products::


        select(
            'products.id as id',
            'name',
            'urlslug',
            'products.created_at as created_at',
            'fpricewtas',
            'cid',
            'scid',
            'products.status as status',
            'products.bid as bid',
            'stock',
            'disp',
            'fpricebefdis',
            'disp',
            'disa',
            'packingid',
            'tags',
            'taxp',
            'taxa',
            'weight',
            'length',
            'width',
            'oosc',
            'trackqty',
            'products.status as status',
            )->with('image')
            ->with('category')

            ->with(['cart' => function ($query) {
                    $query->where('uid', Auth::user()->id);
            }])
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhere('oosc', 1);
            })->where('status',1)->whereIn('id', $pid)->with('discounts')->get();
        // return $data;


        $buyagain = OrdersSub::where('uid', Auth::user()->id)->pluck('pid');
        $buyagain = Products::with(['cart' => function ($query) {
                $query->where('uid', Auth::user()->id);
            }])->with('image')->where('status',1)->select('id', 'name', 'disid', 'bid', 'cid','status','fpricebefdis','fprice', 'taxa', 'taxp', 'disp', 'disa', 'fpricewtas', 'weight', 'wgunit', 'oosc', 'stock')
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhere('oosc', 1);
            })->whereIn('id', $buyagain)->with('discounts')->get();

        return view('Profile/cart', ['data' => $data, 'buyagain' => $buyagain]);
    }

    public function checkout(Request $request){
        // return $request;
        $datax=[];
        $datax['qty']=explode(",",$request->qty);
        $datax['id']=explode(",",$request->id);
        $datax['name']=explode(",",$request->name);
        $datax['disid']=explode(",",$request->disid);
        $datax['disp']=explode(",",$request->disp);
        $datax['disa']=explode(",",$request->disa);
        $datax['fpricewtas']=explode(",",$request->fpricewtas);
        $datax['fpricebefdis']=explode(",",$request->fpricebefdis);
        $datax['taxp']=explode(",",$request->taxp)??[0];
        $datax['taxa']=explode(",",$request->taxa)??[0];
        $datax['weight']=explode(",",$request->weight)??[0];
        $datax['length']=explode(",",$request->length)??[0];
        $datax['width']=explode(",",$request->width)??[0];
        $datax['breadth']=explode(",",$request->breadth)??[0];
        $datax['qtotal']=explode(",",$request->qtotal)??[0];
        $datax['mrptotal']=$request->mrptotal??0;
        $datax['discounttotal']=$request->discounttotal??0;
        $datax['weighttotal']=$request->weighttotal??0;
        $datax['nettotal']=$request->nettotal;
        // return $request;

        // return $datax;
        $address=Address::orderBy('default','desc')->where('uid',Auth::user()->id)->get();
        return view('Profile.checkout',[
            'address'=>$address,
            'datax'=>$datax,
        ]);
    }


      /**
     * @group Product
     * Add to Cart
     * @bodyParam uid string User id
     * @bodyParam pid string Product id
     * @bodyParam qty string Quantity
     * @response 200 {
     *  "success": true,
     *  "title": "",
     *  "message": "",
     *  "data": {}
     *
     * }
     * @response 400 {
     *  "success": false,
     *  "title": "",
     *  "message": "",
     *  "data": {}
     * }
     */

    public function store(Request $request)
    {
        $user=Auth::user();
        $title='';
        $message='';
        $success='';
        if ($user) {
            $data = Cart::where('uid', $user->id)->where('pid', $request->pid)->first();

            if ($data) {
                $data->qty=$data->qty+1;
                $data->save();
                $title='Oopss';
                $message='Already '.$data->qty.' items are in cart';
                $success=false;
            } else {
                $data = new Cart;
                $data->uid = $user->id;
                $data->pid = $request->pid;
                $data->qty = $request->qty;
                $data->save();
                $title='Hurrey';
                $message='Added to Cart Successfully';
                $success=true;
            }
        }
        $cart=session('cart');
        $cartc=count($cart);
        if(!in_array($request->pid,$cart)){
            $request->session()->push('cart', $request->pid);
            $cartc=count($cart)+1;
            if(strlen($title)<=0){
                $title='Hurrey';
                $message='Added to Cart Successfully';
                $success=true;
            }
        }



        if(strlen($title)<=0){
            $title='Oops';
            $message='Item Already present in cart';
            $success=false;
        }

        $count=$cartc;
        return response()->json([
            'success' => $success,
            'title' => $title,
            'message' => $message,
            'count'=>$count,
        ], 200);
    }

    public function save(Request $request)
    {
        $seladdress=json_decode($request->seladdress);
        $cart=json_decode($request->cart);
        $promocode=json_decode($request->promocode);

        // return $request;


        $id=$cart->id;

        $qty=$cart->qty;
        $disid=$cart->disid;
        $taxp=$cart->taxp;

        $name=$cart->name;

        $disp=$cart->disp;
        $disa=$cart->disa;
        $fpricewtas=$cart->fpricewtas;
        $fpricebefdis=$cart->fpricebefdis;
        $taxa=$cart->taxa;

        $weight=$cart->weight;
        $length=$cart->length;
        $breadth=$cart->breadth;
        $width=$cart->width;
        // return $request;
        $weighttotal=$cart->weighttotal;
        $qtotal=$cart->qtotal;
        $mrptotal=$cart->mrptotal;
        $discounttotal=$cart->discounttotal;
        $nettotal=$cart->nettotal;


        $addressid=null;
        if($seladdress->custom==0){
            $addressid=$seladdress->id;
        }
        else{
            $pincode=PinCode::where('pincode',$seladdress->pincode)->first();
            $address = new Address;
            $address->uid = Auth::user()->id;
            $address->pid = $pincode->id;
            $address->name = $seladdress->name;
            $address->phno = $seladdress->phno;
            $address->pincode = $seladdress->pincode;
            $address->country = $seladdress->country;
            $address->state = $seladdress->state;
            $address->city = $seladdress->city;
            $address->houseno = $seladdress->houseno;
            $address->area = $seladdress->area;
            $address->landmark = $seladdress->landmark;
            $address->default = 0;
            $address->save();
            $addressid=$address->id;
        }

        $promocodeid=0;
        if($promocode){
            $promo=PromoCode::find($promocode->id);
            if($promo->id){
                $promocodeid=$promo->id;
            }
        }

        // return $name;
        $add = Address::find($addressid);
        $pincode=PinCode::where('pincode',$add->pincode)->first();
        $data = new Orders();
        $data->uid = Auth::user()->id;
        $data->aid = $addressid;
        $data->pid = $promocodeid ? $promocodeid : 0;
        $data->pincodeid = $add->pincode ?? 0;
        $data->storeid = $pincode->store ?? 0;
        $data->subcost = $request->subcost;
        $data->discount = $discounttotal;
        $data->shipping = $request->shipping;
        $data->subtotal =  floatval($data->subcost)+floatval($data->discount)+floatval($data->shipping);
        $data->promocodeval = $request->promocodeval;
        $data->total = $request->total;
        $data->weight = $weighttotal;
        $data->address = $add;
        // return $data;
        $data->status = 0;
        $data->paystatus = 0;
        $data->paytype = $request->paytype;

        $data->save();

        $data->invno=date('Y').date('m').date('d').date('gi').str_pad($data->id, 2, "0", STR_PAD_LEFT);
        $data->save();


        for ($i = 0; $i < count($id); $i++) {
            $prod = Products::find($id[$i]);
            $datax = new OrdersSub();
            $datax->oid = $data->id;
            $datax->uid = $data->uid;
            $datax->pid = $prod->id;
            $datax->catid = $prod->cid;
            $datax->subcatid = $prod->scid;
            $datax->brandid = $prod->bid;

            $datax->disid = $disid[$i];
            $datax->disp = $disp[$i];
            $datax->taxp = $taxp[$i];

            $datax->weight = $weight[$i];
            $datax->length = $length[$i];
            $datax->width = $width[$i];
            $datax->breadth = $breadth[$i];

            $datax->name = $prod->name;
            $datax->singlecost = $fpricewtas[$i];
            $datax->subcost = round($fpricewtas[$i]*$qty[$i],2);
            $datax->qty = $qty[$i];
            $datax->discount = round($disa[$i]*$qty[$i],2)??0;
            $datax->final = $qtotal[$i];
            $datax->save();
            if ($prod->trackqty) {
                $prod->stock -= $qty[$i];
                $prod->save();
            }
        }
        // return $datax;
        OrderManage::insert($data->id,0);
        session(['cart'=>[]]);
        // \Slack::to('#farm63')->send('New Order - #'.$data->id);
        Cart::whereIn('pid', $id)->where('uid', $data->uid)->delete();
        // Mail::to($data->customer->email)->send(new NewOrder($data));

        if ($data->paytype == 1) {
            return redirect('/profile/orders/' . encrypt($data->id));
        } else {
            return redirect('/profile/orders/pay/' . encrypt($data->id));
        }
        return $request;
    }

    public function destroy(Request $request)
    {
        $data=Cart::where('pid', $request->pid)->where('uid', Auth::user()->id)->first();
        if($data){
            $data->delete();
            $cart=session('cart');
            $pos=array_search($request->pid, $cart);
            unset($cart[$pos]);
            session(['cart'=>array_values($cart)]);
        }
        return count(session('cart'));

    }
}
