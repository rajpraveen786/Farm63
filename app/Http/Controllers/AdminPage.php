<?php

namespace App\Http\Controllers;

use App\Model\ContactUs;
use App\Mail\NewRegistrationOTP;
use App\Mail\OrderCancelled;
use App\Mail\OrderDelivered;
use App\Mail\OrderShipped;
use App\Model\Logger;
use App\Model\OrderManage;
use App\Model\Orders;
use App\Model\OrdersSub;
use App\Model\OTP;
use App\Model\PaymentStatus;
use App\Model\Permissions;
use App\Model\Products;
use App\Model\RetCanOrder;
use App\Model\Review;
use App\Model\Settings as ModelSettings;
use App\Model\User;
use Illuminate\Http\Request;

use Carbon\Carbon;

use Mail;

use Validator;
use Storage;
use Str;
use File;
use DB;
use Exception;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Razorpay\Api\Api;
use Settings;

class AdminPage extends Controller
{
    public function pullhours($data,$type,$hourdata){
        if($type==1){
            if($hourdata==0){
                $data=$data->whereDate('created_at', Carbon::today());
            }
            else if($hourdata==1){
                $data=$data->whereDate('created_at', Carbon::now())->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('g A');
                });
            }
        }
        else if($type==2){
            $now = Carbon::now();
            $weekStartDate = $now->startOfWeek()->format('Y-m-d H:i');
            $weekEndDate = $now->endOfWeek()->format('Y-m-d H:i');

            if($hourdata==0){
                $data=$data->whereBetween('created_at', [$weekStartDate, $weekEndDate]);
            }
            else if($hourdata==1){
                $data=$data->whereBetween('created_at', [$weekStartDate, $weekEndDate])->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('D');
                });
            }
        }
        else if($type==3){
            if($hourdata==0){
                $data=$data->whereMonth('created_at', Carbon::now()->month);
            }
            else if($hourdata==1){
                $data=$data->whereMonth('created_at', Carbon::now()->month)->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('d/m/y');
                });
            }
        }
        else if($type==4){
            if($hourdata==0){
                $data=$data->whereYear('created_at', Carbon::now()->year);
            }
            else if($hourdata==1){
                $data=$data->whereYear('created_at', Carbon::now()->year)
                ->get()
                ->groupBy(function ($date) {
                    return Carbon::parse($date->created_at)->format('M');
                });
            }
        }
        return $data;
    }
    public function home(Request $request)
    {
        $type=$request->type;
        $revenue = Orders::select('total', 'created_at')->where('status', 3);
        $netorders = Orders::select('total', 'created_at')->whereNotIn('status', [6, 5, 4, 3]);
        $orders = Orders::select('total', 'created_at');
        $soldproducts = OrdersSub::select(DB::raw('DISTINCT pid, COUNT(*) AS count_pid, COUNT(qty) AS qty'))
            ->groupBy('pid')
            ->orderBy('qty', 'desc')
            ->with('adminproducts')
            ->take(10);

        $soldpincode = Orders::select(DB::raw('DISTINCT pincodeid, COUNT(*) AS count'))
            ->groupBy('pincodeid')
            ->orderBy('count', 'desc')
            ->take(10);

            if($type==1){
                $soldproducts=$soldproducts->whereDate('created_at', Carbon::today());
                $soldpincode=$soldpincode->whereDate('created_at', Carbon::today());
            }
            else if($type==2){
                $soldproducts=$soldproducts->whereDate('created_at','>=',date('Y-m-d', strtotime('-7 days')));
                $soldpincode=$soldpincode->whereDate('created_at','>=',date('Y-m-d', strtotime('-7 days')));
            }
            else if($type==3){
                $soldproducts=$soldproducts->whereMonth('created_at', Carbon::now()->month);
                $soldpincode=$soldpincode->whereMonth('created_at', Carbon::now()->month);
            }
            else if($type==4){
                $soldproducts=$soldproducts->whereYear('created_at', Carbon::now()->year);
                $soldpincode=$soldpincode->whereYear('created_at', Carbon::now()->year);
            }

        if(!$request->type){
            $type=1;
        }

        $revenue=$this->pullhours($revenue,$type,0);
        $orders=$this->pullhours($orders,$type,1);
        $soldproducts=$this->pullhours($soldproducts,$type,0);
        // return $orders;

        $prodcount = Products::count();
        $customercount = User::where('type',0)->count();
        $revenue = $revenue->sum('total');
        $netorders = $netorders->count('id');
        $soldproducts = $soldproducts->get();
        $soldpincode = $soldpincode->get();



        $products = Products::select(DB::raw('count(*) as count, status'))
            ->orderBy('status', 'asc')
            ->groupBy('status')
            ->get();
            // return $products;
        $x=[0,0];
        if ($products->count()>0) {
            if ($products[0]->status == 0) {
                if (count($products) > 1) {
                    $x[0] = $products[0]->count;
                    $x[1] = $products[1]->count;
                } else {
                    $x[0] = $products[0]->count;
                    $x[1] = 0;
                }
            } else {
                $x[1] = $products[0]->count;
                $x[0] = 0;
            }
        }
          $products=$x;
        //   return $products;
        return view('Admin.home', [
            'prodcount' => $prodcount,
            'revenue' => $revenue,
            'netorders' => $netorders,
            'customercount' => $customercount,

            'orders' => $orders,
            'products' => $products,
            'soldproducts' => $soldproducts,
            'soldpincode' => $soldpincode,
        ]);
        // }
        // catch(Exception $e){
        //     echo 'Message: ' .$e->getMessage();
        // }
        return redirect('/admin/products');
    }

    public function orderindex(Request $request)
    {
        $status=$request->status??-1;
        $paystatus=$request->paystatus??-1;
        $data = Orders::select('id','invno', 'status', 'paystatus', 'paytype', 'uid', 'total')->with('customer')->orderBy('id', 'desc');
        if ($request->name) {
            $data = $data->where('invno', 'LIKE', '%' . $request->name . '%');
        }
        if (in_array($status, [0, 1, 2, 3, 4, 5, 6])) {
            $data = $data->where('status', $status);
        }
        if (in_array($paystatus, [0, 1, 2, 3])) {
            $data = $data->where('paystatus', $paystatus);
        }
        $data = $data->paginate(40);
        return view('Admin.Orders.list', [
            'data' => $data,
            'paystatus' => $paystatus,
            'status' => $status,

    ]);
    }

    public function orderquickindex(Request $request)
    {
        $settings=ModelSettings::get();
            $data = Orders::whereIn('status',[0])->with('customer')->orderBy('pincodeid', 'desc')->orderBy('id', 'asc');
        $data = $data->get();
        return view('Admin.Orders.quicklist', [
            'data' => $data,
            'settings' => $settings,
    ]);
    }
    public function orderquickpull(Request $request)
    {
        $data = Orders::where('status',$request->status)->with('customer')->with('payment')->with('ordersub')->orderBy('pincodeid', 'desc')->orderBy('id', 'asc');
        return $data->get();
    }
    public function orderapprove(Request $request)
    {
        Orders::whereIn('id',$request->id)->with('customer')->update(['status'=>1]);
        $data = Orders::whereIn('id',$request->id)->with('payment')->with('ordersub')->get();
        return $data;
    }
    public function orderoutfordel(Request $request)
    {
        return Orders::whereIn('id',$request->id)->with('customer')->update(['status'=>2]);
    }
    public function orderdelivered(Request $request)
    {
        return Orders::whereIn('id',$request->id)->with('customer')->update(['status'=>3]);
    }

    public function ordershow($id, Request $request)
    {
        if (Auth::user()->permission->general->orderedit) {
            try {
                $data = Orders::with('ordersubadmin')->with('ordersmanage')->find($id);
                if ($data) {
                    return view('Admin.Orders/view', ['data' => $data]);
                } else {
                    $request->session()->flash('error', 'Sorry Orders not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/orders');
    }

    public function orderinvoice($id, Request $request)
    {
        try {
            $data =Orders::with('payment')->with('ordersub')->find(decrypt($id));
            if ($data) {
            $settings=ModelSettings::get();
            return view('Admin.Orders.invoice',['data'=>$data,'settings'=>$settings]);
            } else {
                $request->session()->flash('error', 'Sorry Orders not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/orders');
    }

    public function convertpaytype(Request $request, $id)
    {
        if (Auth::user()->permission->general->orderedit) {
            $data =Orders::find(decrypt($id));
            if ($data) {
                $data->paytype=($data->paytype+1)%2;
                $data->save();
                return redirect('/admin/orders/view/'.decrypt($id));
            } else {
                $request->session()->flash('error', 'Sorry Order not found');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/orders');
    }
    public function ordershowsave($id, Request $request)
    {
        // return $request;
        if (Auth::user()->permission->general->orderedit) {
            try {
                $data = Orders::find(decrypt($id));
                if ($data) {
                    $data->status = $request->status;
                    $data->paystatus = $request->paystatus;
                    if ($request->loc) {
                        if ($data->invoice) {
                            File::delete($data->invoice);
                        }
                        if (!Storage::disk('public')->has('orders/' . $data->id . '.' . $request->file('loc')->getClientOriginalExtension())) {
                            $image = $request->file('loc');
                            $newfilename = $data->id . "." . $request->file('loc')->getClientOriginalExtension();
                            Storage::disk('public')->put('orders/' . $newfilename, File::get($image));
                            $data->invoice = 'storage/orders/' . $newfilename;
                        }
                    }

                    if ($data->status == 2) {
                        Mail::to($data->customer->email)->send(new OrderShipped($data));
                    } else if ($data->status == 3) {
                        $data->completed_at= date("Y-m-d H:i:s", strtotime('now'));
                        Mail::to($data->customer->email)->send(new OrderDelivered($data));
                    } else if ($data->status == 6) {
                        Mail::to($data->customer->email)->send(new OrderCancelled($data));
                    }

                    $data->save();

                    OrderManage::insert($data->id,$data->status);
                    $request->session()->flash('status', 'Order Updated');
                } else {
                    $request->session()->flash('error', 'Sorry Orders not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/orders/view/'.$data->id);
    }
    public function orderdestroy(Request $request, $id)
    {
        if (Auth::user()->permission->general->orderdel) {
            $data = Orders::find(decrypt($id));
            OrdersSub::where('oid', $data->id)->delete();
            $data->delete();
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/orders');
    }

    public function returnamt(Request $request, $id)
    {
        if (Auth::user()->permission->general->orderedit) {
            try {
                $data = Orders::find(decrypt($id));
                // return $data->refunddata;
                if (in_array($data->status, [4, 6]) && $data->paystatus == 1 && $data->paytype == 0 && is_null($data->refunddata)) {
                    $paydete = PaymentStatus::where('oid', $data->id)->first();
                    $api = new Api(env('RAZOR_KEY'), env('RAZOR_SECRET'));
                    $ordx = new RetCanOrder();
                    $ordx->type = $data->status;
                    $ordx->oid = $data->id;
                    $ordx->status = 0;
                    $ordx->orderAmount = $request->refundamt;
                    $ordx->payrazorpaymentid = $paydete->orderid;

                    $refund = $api->refund->create(array('payment_id' => $paydete->orderid, 'amount' => $ordx->orderAmount * 100));

                    $ordx->refundrazorpaymentid = $refund->id;
                    $ordx->save();

                    $data->paystatus = 3;
                    $data->save();


                    $request->session()->flash('status', 'Order Updated');
                } else {
                    $request->session()->flash('error', 'Sorry Orders not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/orders');
    }

























    public function custindex(Request $request)
    {
        $data = User::select('name', 'email', 'id', 'phno')
            ->where('type', 0)
            ->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data
                ->where('name', 'LIKE', '%' . $request->name . '%')
                ->orWhere('email', 'LIKE', '%' . $request->name . '%')
                ->orWhere('phno', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->paginate(20);
        return view('Admin.Customer.list', ['data' => $data]);
    }

    public function custcreate(Request $request)
    {

        if (Auth::user()->permission->general->customeradd) {
            return view('Admin.Customer/add');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/customer');
    }
    public function custstore(Request $request)
    {
        if (Auth::user()->permission->general->customeradd) {
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email|email',
                'phno' => 'required|unique:users,phno|numeric|digits:10',
                'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:7',
            ], [
                'name.required' => 'Please enter the Name',

                'email.required' => 'Please enter the Email',
                'email.unique' => 'Email has already been taken',
                'email.email' => 'Please enter a valid Email',

                'phno.unique' => 'Phone Number has already been taken',
                'phno.required' => 'Please enter the Phone Number',
                'phno.numeric' => 'Please enter a valid Phone Number',
                'phno.digits' => 'Phone Number must contain minimum 10 digits',

                'password.required' => 'Please enter the Password',
                'password.required_with' => 'Please enter Confirm Password',
                'password.same' => 'Password do not match',
                'password.min' => 'Password must be of minimum 6 digits',
            ]);
            if ($validate->fails()) {

                return back()->withInput()->withErrors($validate);
            }


            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phno = $request->phno;
            $data->password = Hash::make($request->password);
            $data->save();

            $code = new OTP();
            $code->uid = $data->id;
            $code->type = 0;
            $code->value = $data->email;
            $code->reason = 'Registration';
            while (1) {
                $codex=rand(10000,99999);
                $length = OTP::where('code', $codex)->where('expdate', '>=', date('Y-m-d H:i:s'))->count();
                if ($length == 0) {
                    break;
                }
            }
            $code->code = $codex;
            $code->expdate = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            $code->save();
            Mail::to($data->email)->send(new NewRegistrationOTP($code->code));



            $logdata = new Logger();
            $logdata->addLog(0, 'Customer', null, $data);


            $request->session()->flash('status', 'Added Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }

        return redirect('/admin/customer');
    }

    public function custshow($id, Request $request)
    {
        if (Auth::user()->permission->general->customerview) {
            try {
                $data = User::find($id);
                if ($data) {
                    $orders = Orders::select('id', 'total', 'created_at')->where('uid', $data->id)->orderBy('id', 'desc')->paginate(20);
                    return view('Admin.Customer/view', ['data' => $data, 'orders' => $orders]);
                } else {
                    $request->session()->flash('error', 'Sorry Customer not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/customer');
    }
    public function custedit($id, Request $request)
    {
        if (Auth::user()->permission->general->customeredit) {
            $data = User::find(decrypt($id));
            return view('Admin.Customer/edit', ['data' => $data]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/customer');
        }
    }
    public function custupdate(Request $request, $id)
    {
        if (Auth::user()->permission->general->customeredit) {
            $tid = decrypt($id);
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email,' . $tid . '|email',
                'phno' => 'required|unique:users,phno,' . $tid . '|numeric|digits:10',
            ], [
                'name.required' => 'Please enter the Name',

                'email.required' => 'Please enter the Email',
                'email.unique' => 'Email has already been taken',
                'email.email' => 'Please enter a valid Email',

                'phno.unique' => 'Phone Number has already been taken',
                'phno.required' => 'Please enter the Phone Number',
                'phno.numeric' => 'Please enter a valid Phone Number',
                'phno.digits' => 'Phone Number must contain minimum 10 digits',

                'password.required' => 'Please enter the Password',
                'password.required_with' => 'Please enter Confirm Password',
                'password.same' => 'Password do not match',
                'password.min' => 'Password must be of minimum 6 digits',
            ]);
            if ($validate->fails()) {

                return back()->withInput()->withErrors($validate);
            }
            $data = User::find($tid);
            $olddata = $data;

            $data->name = $request->name;
            $data->email = $request->email;
            $data->phno = $request->phno;
            $data->status = $request->status;
            $data->save();


            if ($data->getChanges()) {
                $logdata = new Logger();
                $logdata->addLog(1, 'Customer', $olddata, json_encode($data->getChanges()));
            }

            $request->session()->flash('status', 'Edited Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/customer');
    }
    public function custdestroy(Request $request, $id)
    {
        if (Auth::user()->permission->general->customerdel) {
            $data = User::find(decrypt($id));
            $logdata = new Logger();
            $logdata->addLog(2, 'Customer', null, $data);
            File::delete($data->loc);
            $data->delete();
            $request->session()->flash('status', 'Deleted Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/customer');
    }









    public function contactindex(Request $request)
    {
        $data = ContactUs::select('name', 'email', 'id', 'phno', 'msg')->orderBy('id', 'desc');

        if ($request->name) {
            $data = $data
                ->where('name', 'LIKE', '%' . $request->name . '%')
                ->orWhere('email', 'LIKE', '%' . $request->name . '%')
                ->orWhere('phno', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->paginate(20);

        return view('Admin.ContactUs.list', ['data' => $data]);
    }
    public function contactdestroy($id, Request $request)
    {
        try {
            $data = ContactUs::find(decrypt($id));

            $logdata = new Logger();
            $logdata->addLog(2, 'Contact', null, $data);
            $request->session()->flash('status', 'Deleted Succesfully');
            $data->delete();
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/contact');
    }


    public function empindex(Request $request)
    {
        $data = User::select('name', 'email', 'id', 'phno')
            ->where('type', 3)
            ->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data
                ->where('name', 'LIKE', '%' . $request->name . '%')
                ->orWhere('email', 'LIKE', '%' . $request->name . '%')
                ->orWhere('phno', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->paginate(20);
        return view('Admin.Employee.list', ['data' => $data]);
    }
    public function empcreate(Request $request)
    {
        if (Auth::user()->permission->general->employeeadd) {


            return view('Admin.Employee.add');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/employee');
        }
    }
    public function empstore(Request $request)
    {
        if (Auth::user()->permission->general->employeeadd) {

            // return $request;
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email|email',
                'phno' => 'required|unique:users,phno|numeric|digits:10',
                'password' => 'required|required_with:password_confirmation|same:password_confirmation|min:7',
            ], [
                'name.required' => 'Please enter the Name',

                'email.required' => 'Please enter the Email',
                'email.unique' => 'Email has already been taken',
                'email.email' => 'Please enter a valid Email',

                'phno.unique' => 'Phone Number has already been taken',
                'phno.required' => 'Please enter the Phone Number',
                'phno.numeric' => 'Please enter a valid Phone Number',
                'phno.digits' => 'Phone Number must contain minimum 10 digits',

                'password.required' => 'Please enter the Password',
                'password.required_with' => 'Please enter Confirm Password',
                'password.same' => 'Password do not match',
                'password.min' => 'Password must be of minimum 6 digits',
            ]);
            if ($validate->fails()) {

                return back()->withInput()->withErrors($validate);
            }


            $data = new User();
            $data->name = $request->name;
            $data->email = $request->email;
            $data->phno = $request->phno;
            $data->type = 3;
            $data->password = Hash::make($request->password);
            $data->save();

            $datax = new Permissions();
            $permission=[];
            $datax->uid = $data->id;
            $permission['category'] = $request->category ?? 0;
            $permission['subcategory'] = $request->subcategory ?? 0;
            $permission['brand'] = $request->brand ?? 0;
            $permission['packing'] = $request->packing ?? 0;
            $permission['uom'] = $request->uom ?? 0;
            $permission['attribute'] = $request->attribute ?? 0;
            $permission['tags'] = $request->tags ?? 0;
            $permission['banner'] = $request->banner ?? 0;
            $permission['cms'] = $request->cms ?? 0;
            $permission['seo'] = $request->seo ?? 0;
            $permission['pincode'] = $request->pincode ?? 0;
            $permission['contactus'] = $request->contactus ?? 0;
            $permission['newsletter'] = $request->newsletter ?? 0;

            //Products
            $permission['productsadd'] = $request->productsadd ?? 0;
            $permission['productsedit'] = $request->productsedit ?? 0;
            $permission['productsview'] = $request->productsview ?? 0;
            $permission['productsdel'] = $request->productsdel ?? 0;

            //Employee
            $permission['employeeadd'] = $request->employeeadd ?? 0;
            $permission['employeeedit'] = $request->employeeedit ?? 0;
            $permission['employeeview'] = $request->employeeview ?? 0;
            $permission['employeedel'] = $request->employeedel ?? 0;

            //Discounts
            $permission['discountsadd'] = $request->discountsadd ?? 0;
            $permission['discountsedit'] = $request->discountsedit ?? 0;
            $permission['discountsview'] = $request->discountsview ?? 0;
            $permission['discountsdel'] = $request->discountsdel ?? 0;

            //Store
            $permission['storeadd'] = $request->storeadd ?? 0;
            $permission['storeedit'] = $request->storeedit ?? 0;
            $permission['storeview'] = $request->storeview ?? 0;
            $permission['storedel'] = $request->storedel ?? 0;

            //Promocode
            $permission['promocodeadd'] = $request->promocodeadd ?? 0;
            $permission['promocodeedit'] = $request->promocodeedit ?? 0;
            $permission['promocodeview'] = $request->promocodeview ?? 0;
            $permission['promocodedel'] = $request->promocodedel ?? 0;


            //Customer
            $permission['customeradd'] = $request->customeradd ?? 0;
            $permission['customeredit'] = $request->customeredit ?? 0;
            $permission['customerview'] = $request->customerview ?? 0;
            $permission['customerdel'] = $request->customerdel ?? 0;


            //Order
            $permission['orderedit'] = $request->orderedit ?? 0;
            $permission['orderview'] = $request->orderview ?? 0;
            $permission['orderdel'] = $request->orderdel ?? 0;

            //review
            $permission['reviewedit'] = $request->reviewedit ?? 0;
            $permission['reviewdel'] = $request->reviewdel ?? 0;

            $datax->general=$permission;
            $datax->save();

            $code = new OTP();
            $code->uid = $data->id;
            $code->type = 0;
            $code->value = $data->email;
            $code->reason = 'Registration';
            while (1) {
                $codex=rand(10000,99999);
                $length = OTP::where('code', $codex)->where('expdate', '>=', date('Y-m-d H:i:s'))->count();
                if ($length == 0) {
                    break;
                }
            }
            $code->code = $codex;
            $code->expdate = date('Y-m-d H:i:s', strtotime('+15 minutes'));
            $code->save();
            Mail::to($data->email)->send(new NewRegistrationOTP($code->code));
            // return $data->getAttributes();

            $datax = User::with('permission')->find($data->id);
            $logdata = new Logger();
            $logdata->addLog(0, 'Employee', null, $datax);

            $request->session()->flash('status', 'Added Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/employee');
    }

    public function empshow($id, Request $request)
    {
        if (Auth::user()->permission->general->employeeview) {

            try {
                $data = User::find(decrypt($id));
                if ($data) {
                    $orders = Orders::select('id', 'total', 'created_at')->where('uid', $data->id)->orderBy('id', 'desc')->paginate(20);
                    return view('Admin.Employee/view', ['data' => $data, 'orders' => $orders]);
                } else {
                    $request->session()->flash('error', 'Sorry Employee not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/employee');
    }
    public function empedit($id, Request $request)
    {
        if (Auth::user()->permission->general->employeeedit) {
            $data = User::with('permission')->find(decrypt($id));
            // return $data;
            return view('Admin.Employee/edit', ['data' => $data]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/employee');
        }
    }
    public function empupdate(Request $request, $id)
    {
        if (Auth::user()->permission->general->employeeedit) {

            $tid = decrypt($id);
            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'email' => 'required|unique:users,email,' . $tid . '|email',
                'phno' => 'required|unique:users,phno,' . $tid . '|numeric|digits:10',
            ], [
                'name.required' => 'Please enter the Name',

                'email.required' => 'Please enter the Email',
                'email.unique' => 'Email has already been taken',
                'email.email' => 'Please enter a valid Email',

                'phno.unique' => 'Phone Number has already been taken',
                'phno.required' => 'Please enter the Phone Number',
                'phno.numeric' => 'Please enter a valid Phone Number',
                'phno.digits' => 'Phone Number must contain minimum 10 digits',

                'password.required' => 'Please enter the Password',
                'password.required_with' => 'Please enter Confirm Password',
                'password.same' => 'Password do not match',
                'password.min' => 'Password must be of minimum 6 digits',
            ]);
            if ($validate->fails()) {

                return back()->withInput()->withErrors($validate);
            }
            $data = User::find($tid);
            $olddata = User::find($tid)->with('permission');

            $data->name = $request->name;
            $data->email = $request->email;
            $data->phno = $request->phno;
            $data->status = $request->status;
            $data->save();


            $datax = Permissions::where('uid', $data->id)->first();
            $permission=$datax->general;
            $permission->uid = $data->id;
            $permission->category = $request->category ?? 0;
            $permission->subcategory = $request->subcategory ?? 0;
            $permission->brand = $request->brand ?? 0;
            $permission->packing = $request->packing ?? 0;
            $permission->uom = $request->uom ?? 0;
            $permission->attribute = $request->attribute ?? 0;
            $permission->tags = $request->tags ?? 0;
            $permission->banner = $request->banner ?? 0;
            $permission->cms = $request->cms ?? 0;
            $permission->seo = $request->seo ?? 0;
            $permission->pincode = $request->pincode ?? 0;
            $permission->contactus = $request->contactus ?? 0;
            $permission->newsletter = $request->newsletter ?? 0;

            //Products
            $permission->productsadd = $request->productsadd ?? 0;
            $permission->productsedit = $request->productsedit ?? 0;
            $permission->productsview = $request->productsview ?? 0;
            $permission->productsdel = $request->productsdel ?? 0;

            //Employee
            $permission->employeeadd = $request->employeeadd ?? 0;
            $permission->employeeedit = $request->employeeedit ?? 0;
            $permission->employeeview = $request->employeeview ?? 0;
            $permission->employeedel = $request->employeedel ?? 0;


            //Discounts
            $permission->discountsadd = $request->discountsadd ?? 0;
            $permission->discountsedit = $request->discountsedit ?? 0;
            $permission->discountsview = $request->discountsview ?? 0;
            $permission->discountsdel = $request->discountsdel ?? 0;


            //Promocode
            $permission->promocodeadd = $request->promocodeadd ?? 0;
            $permission->promocodeedit = $request->promocodeedit ?? 0;
            $permission->promocodeview = $request->promocodeview ?? 0;
            $permission->promocodedel = $request->promocodedel ?? 0;

            //Store
            $permission->storeadd = $request->storeadd ?? 0;
            $permission->storeedit = $request->storeedit ?? 0;
            $permission->storeview = $request->storeview ?? 0;
            $permission->storedel = $request->storedel ?? 0;

            //Customer
            $permission->customeradd = $request->customeradd ?? 0;
            $permission->customeredit = $request->customeredit ?? 0;
            $permission->customerview = $request->customerview ?? 0;
            $permission->customerdel = $request->customerdel ?? 0;


            //Order
            $permission->orderedit = $request->orderedit ?? 0;
            $permission->orderview = $request->orderview ?? 0;
            $permission->orderdel = $request->orderdel ?? 0;

            //review
            $permission->reviewedit = $request->reviewedit ?? 0;
            $permission->reviewdel = $request->reviewdel ?? 0;
            $datax->general=$permission;
            $datax->save();

            $data = User::find($tid)->with('permission');

            if ($data->getChanges()) {
                $logdata = new Logger();
                $logdata->addLog(1, 'Banner', $olddata, json_encode($data->getChanges()));
            }

            $request->session()->flash('status', 'Edited Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/employee');
    }
    public function empdestroy(Request $request, $id)
    {
        if (Auth::user()->permission->general->employeedel) {

            $data = User::with('permission')->find(decrypt($id));
            $logdata = new Logger();
            $logdata->addLog(2, 'Employee', null, $data);
            Permissions::where('uid', $data->id)->delete();
            $data->delete();
            $request->session()->flash('status', 'Deleted Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/employee');
    }











    public function logsindex(Request $request)
    {
        if (Auth::user()->type == 2) {
            $data = Logger::orderBy('id', 'desc');

            if ($request->name) {
                $data = $data
                    ->where('name', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('email', 'LIKE', '%' . $request->name . '%')
                    ->orWhere('phno', 'LIKE', '%' . $request->name . '%');
            }
            $data = $data->paginate(20);
            return view('Admin.Logs.list', ['data' => $data]);
        }
        return redirect('/admin');
    }
    public function logsdestroy($id, Request $request)
    {
        if (Auth::user()->type == 2) {
            try {
                $data = Logger::find(decrypt($id));
                $request->session()->flash('status', 'Deleted Succesfully');
                $data->delete();
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        }
        return redirect('/admin/logs');
    }

    public function logshow($id, Request $request)
    {
        if (Auth::user()->type == 2) {

            try {
                $data = Logger::find(decrypt($id));
                if ($data) {
                    return view('Admin.Logs/view', ['data' => $data]);
                } else {
                    $request->session()->flash('error', 'Sorry Logs not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin');
    }

    public function reviewsindex(Request $request)
    {
        $data = Review::orderBy('id', 'desc');
        if ($request->status && $request->status>=0) {
            $data = $data->where('status',$request->status);
        }
        $data = $data->paginate(20);
        return view('Admin.Review.list', ['data' => $data]);
        return redirect('/admin');
    }
    public function reviewsdestroy($id, Request $request)
    {
        if (Auth::user()->permission->general->reviewdel) {
            try {
                $data = Review::find(decrypt($id));
                $logdata = new Logger();
                $logdata->addLog(2, 'Review', null, $data);
                $request->session()->flash('status', 'Deleted Succesfully');
                $data->delete();
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        }
        return redirect('/admin/reviews');
    }

    public function reviewshow($id, Request $request)
    {
        try {
            $data = Review::find(decrypt($id));
            if ($data) {
                return view('Admin.Review/view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Logs not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin');
    }


    public function reviewsedit($id, Request $request)
    {
        // return 1;
        if (Auth::user()->permission->general->reviewedit) {
            try {
                $data = Review::find(decrypt($id));
                $olddata = $data;
                $data->status=$request->status;
                if ($data->getChanges()) {
                    $logdata = new Logger();
                    $logdata->addLog(1, 'Banner', $olddata, json_encode($data->getChanges()));
                }
                $request->session()->flash('status', 'Edited Succesfully');
                $data->save();
                // return $data;
                return redirect('/admin/reviews/view/'.$id);

            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        }
        return redirect('/admin/reviews');
    }
}
