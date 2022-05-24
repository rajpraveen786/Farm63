<?php

namespace App\Http\Controllers;

use App\Mail\OrderCancelled;
use App\Model\Logger;
use App\Model\Orders;
use App\Model\OrdersSub;
use App\Model\PaymentStatus;
use Illuminate\Http\Request;

use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Razorpay\Api\Api;
use App\Model\OrderManage;
use App\Model\Settings;

class OrdersController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $type = $request->type ?? -1;
        $data = Orders::select('created_at', 'invno', 'total', 'id', 'status', 'paystatus', 'paytype')->with('ordersub')->where('uid', Auth::user()->id)->orderBy('id', 'desc');
        if ($request->orderno) {
            $data = $data->where('invno', 'LIKE', '%' . $request->orderno . '%');
        }

        if (!is_null($request->type) && in_array($request->type, [0, 1, 2, 3, 4, 5, 6, 7])) {
            $data = $data->where('status', $request->type);
        }
        $data = $data->paginate(20);
        // return $data;
        return view('Profile.Orders.list', ['data' => $data, 'type' => $type]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Model\Orders  $orders
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request, $id)
    {
        try {
            $data = Orders::with('ordersub')->where('uid', Auth::user()->id)->find(decrypt($id));
            if ($data) {
                return view('Profile/Orders/view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Order not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/profile/orders');
    }


    public function invoice(Request $request, $id)
    {
        try {
            $data = Orders::with('payment')->with('ordersub')->where('uid', Auth::user()->id)->where('paystatus', 1)->find(decrypt($id));
            $settings = Settings::get();
            return view('Profile.Orders.invoice', ['data' => $data, 'settings' => $settings]);
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/profile/orders');
    }

    public function destroy($id, Request $request)
    {
        try {
            if (Auth::check() && Auth::user()->permission->general->orderdel) {
                $data = Orders::with('ordersubadmin')->find(decrypt($id));
                $logdata = new Logger();
                $logdata->addLog(2, 'Order', null, $data);
                $sub = OrdersSub::where('oid', $data->id)->get();

                $data->delete();
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/orders');
    }

    public function pay(Request $request, $id)
    {
        try {
            $time=Date('Y-m-d H:i:s',strtotime('-10 minutes'));
            // return $time;
            $data = Orders::whereIn('paystatus', [0,2])->whereIn('status',[0,1,2,3])->whereTime('created_at', '>', $time)->find(decrypt($id));
            if ($data) {
                $txn=[];
                $txn['value']=$data->total;
                $txn['currency']="INR";

                $cust=[];
                $cust['mobile']=Auth::user()->phno;
                $cust['email']=Auth::user()->email;
                $cust['firstName']=Auth::user()->name;


                $amount = $data->total;
                $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

                $attributes= $api->order->create(array('amount' => $data->total*100 ,'currency' => 'INR','receipt' => $data->invno,'payment' => array('capture' => 'automatic','capture_options' => array('automatic_expiry_period' => 12,'manual_expiry_period' => 7200,'refund_speed' => 'optimum'))));

                return view('Profile.Orders.Pay', ['data' => $data,'attributes' => $attributes,]);
            } else {
                $request->session()->flash('error', 'Please refresh your page');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/profile/orders');
    }

    public function paymentpost(Request $request, $id)
    {

            $input = $request->all();

        $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));

        $payment = $api->payment->fetch($input['razorpay_payment_id']);
        // return dd($payment);
        $datas = new PaymentStatus();
        $datas->oid = decrypt($id);
        $datas->orderid = $input['razorpay_payment_id'];
        $datas->orderAmount = $payment->amount;

        if (count($input)  && !empty($input['razorpay_payment_id'])) {
            try {
                $response = $api->payment->fetch($input['razorpay_payment_id']);
                // ->capture(array('amount' => $payment['amount']));
                // dd($payment);
                $status = 0;
                $method = 0;
                $refundstatus = 0;

                if ($payment->status == 'created') {
                    $status = 0;
                } else if ($payment->status == 'authorized') {
                    $status = 1;
                } else if ($payment->status == 'captured') {
                    $status = 2;
                } else if ($payment->status == 'refunded') {
                    $status = 3;
                } else if ($payment->status == 'failed') {
                    $status = 4;
                }
                $datas->status = $status;


                if ($payment->method == 'card') {
                    $method = 0;
                } else if ($payment->method == 'netbanking') {
                    $method = 1;
                } else if ($payment->method == 'wallet') {
                    $method = 2;
                } else if ($payment->method == 'emi') {
                    $method = 3;
                } else if ($payment->method == 'upi') {
                    $method = 4;
                }
                $datas->paytype = $method;


                if ($payment->refund_status == 'null') {
                    $refundstatus = 0;
                } else if ($payment->refund_status == 'partial ') {
                    $refundstatus = 1;
                } else if ($payment->refund_status == 'full') {
                    $refundstatus = 2;
                }
                $datas->refundstatus = $refundstatus;
                $datas->amount_refunded = 0;

                if (in_array($status, [0,1, 2])) {
                    Orders::where('id', $datas->oid)
                        ->update(['paystatus' => 1]);
                }

                $request->session()->flash('status', 'Payment Success');
            } catch (\Exception $e) {
                $datas->error = $e->getMessage();
                $request->session()->flash('error', 'Sorry Contact Admin');
            }

            $datas->save();
        }


        return redirect('/profile/orders/' . $id);
    }
    public function cancel(Request $request, $id)
    {

        try {
            $data = Orders::where('uid', Auth::user()->id)->find(decrypt($id));
            if ($data) {
                if (in_array($data->status, [0, 1, 5]) && in_array($data->paytype, [0, 1]) && in_array($data->paystatus, [0, 1, 2])) {
                    $data->status = 6;
                    $data->save();
                    OrderManage::insert($data->id,6);
                    Mail::to($data->customer->email)->send(new OrderCancelled($data));
                    $request->session()->flash('status', 'Order Cancelled Successfully');
                } else {
                    $request->session()->flash('error', 'Sorry Contact Admin');
                }
            } else {
                $request->session()->flash('error', 'Sorry Order not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/profile/orders');
    }
    public function return(Request $request, $id)
    {

        try {
            $data = Orders::where('uid', Auth::user()->id)->find(decrypt($id));
            if ($data) {
                if (in_array($data->status, [3]) && in_array($data->paytype, [0, 1]) && in_array($data->paystatus, [0, 1, 2])) {
                    $data->status = 4;
                    $data->save();
                    OrderManage::insert($data->id,4);
                    $request->session()->flash('status', 'Order Cancelled Successfully');
                } else {
                    $request->session()->flash('error', 'Sorry Contact Admin');
                }
            } else {
                $request->session()->flash('error', 'Sorry Order not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/profile/orders');
    }



    public function paytympay(Request $request)
    {
        // return Auth::user();
        $ord = Orders::where('invno', $request->ORDERID)->first();
        // return $request;
        if ($request->STATUS == 'TXN_SUCCESS') {
            $data = new PaymentStatus();
            $data->oid = $ord->id;
            $data->status = 2; //aceped
            $method = 0;

            $ord->paystatus = 1;
            $ord->save();

            $reqpaytype = $request->paytype;
            if ($reqpaytype == 'CC' || $reqpaytype == 'CC') {
                $method = 0;
            } else if ($reqpaytype == 'NB') {
                $method = 1;
            } else if ($reqpaytype == 'PPI') {
                $method = 2;
            } else if ($reqpaytype == 'emi') {
                $method = 3;
            } else if ($reqpaytype == 'UPI') {
                $method = 4;
            }
            $data->paytype = $method; //aceped
            $data->orderid = $request->TXNID; //aceped
            $data->razorpaymentid = $request->TXNID; //aceped
            $data->orderAmount = $request->TXNID; //aceped
            $data->save();
            $request->session()->flash('status', 'Payment Success');
        } else {
            $request->session()->flash('error', 'Sorry Payment Failed');
        }
        if ($ord) {
            Auth::loginUsingId($ord->uid);
            return redirect('/profile/orders/' . encrypt($ord->id));
        } else {
            $request->session()->flash('error', 'Sorry Contact Admin');
            return redirect('/');
        }
    }
}
