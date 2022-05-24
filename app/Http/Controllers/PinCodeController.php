<?php

namespace App\Http\Controllers;

use App\Imports\PincodeImport;
use App\Model\Logger;
use App\Model\PinCode;
use App\Model\Store;
use Illuminate\Http\Request;
use Excel;
use Illuminate\Support\Facades\Auth;
use Validator;

class PinCodeController extends Controller
{
    public function index(Request $request)
    {
        $data=PinCode::with('storedata')->select('country','pincode','store','state','city','cost','deldays','status','id')->orderBy('id','asc');
        if($request->country){
            $data=$data->where('country','LIKE','%'.$request->country.'%');
        }
        if($request->state){
            $data=$data->where('state','LIKE','%'.$request->state.'%');
        }
        if($request->city){
            $data=$data->where('city','LIKE','%'.$request->city.'%');
        }
        if($request->pincode){
            $data=$data->where('pincode','LIKE','%'.$request->pincode.'%');
        }
        if($request->status&&$request->status>=0){
            $data=$data->where('status',$request->status);
        }

        if($request->store&&$request->store>=0){
            $data=$data->where('store',$request->store);
        }
        $data=$data->paginate(20);
        $stores=Store::get();
        return view('Admin.PinCode.list',['data'=>$data,'stores'=>$stores]);
    }

    public function store(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'cost'=>'required|integer',
            'deldays'=>'required|integer',
            'pincode' => 'required|unique:pin_codes,pincode|max:255',
        ],[
            'country.required'=>'Please enter the Country',
            'state.required'=>'Please enter the State',
            'city.required'=>'Please enter the City',
            'cost.required'=>'Please enter the Cost',
            'cost.integer'=>'Cost must be an Integer',
            'deldays.integer'=>'Days must be an Integer',
            'deldays.required'=>'Please enter the Days',
            'pincode.required'=>'Please enter the PinCode',
            'pincode.unique'=>'PinCode already taken',
        ]);
        $x['errors']=0;
        if ($validate->fails()) {
            $x['errorstat']=1;
            $x['errors']=$validate->errors();
            return $x;
        }
        $data=new PinCode;
        $data->country=$request->country;
        $data->state=$request->state;
        $data->city=$request->city;
        $data->pincode=$request->pincode;
        $data->status=$request->status;
        $data->cost=$request->cost;
        $data->deldays=$request->deldays;
        $data->store=$request->store;
        $gendata=[];
        $data->generaldata=$gendata;
        $data->save();


        $logdata = new Logger();
        $logdata->addLog(0, 'Pincode', null, $data);

        $data=Pincode::with('storedata')->find($data->id);
        $x['errorstat']=0;
        $x['data']=$data;
        return $x;
    }
    public function update(Request $request)
    {
        $validate = Validator::make($request->all(),[
            'country' => 'required|max:255',
            'state' => 'required|max:255',
            'city' => 'required|max:255',
            'cost'=>'required|integer',
            'deldays'=>'required|integer',
            'pincode' => 'required|unique:pin_codes,pincode,'.$request->id.'|max:255',
        ],[
            'country.required'=>'Please enter the Country',
            'state.required'=>'Please enter the State',
            'city.required'=>'Please enter the City',
            'cost.required'=>'Please enter the Cost',
            'cost.integer'=>'Cost must be an Integer',
            'deldays.integer'=>'Days must be an Integer',
            'deldays.required'=>'Please enter the Days',
            'pincode.required'=>'Please enter the PinCode',
            'pincode.unique'=>'PinCode already taken',
        ]);
        $x['errors']=0;
        if ($validate->fails()) {
            $x['errorstat']=1;
            $x['errors']=$validate->errors();
            return $x;
        }
        $data=PinCode::find($request->id);
        $olddata=$data;
        $data->country=$request->country;
        $data->state=$request->state;
        $data->city=$request->city;
        $data->pincode=$request->pincode;
        $data->status=$request->status;
        $data->cost=$request->cost;
        $data->deldays=$request->deldays;
        $data->store=$request->store;
        $gendata=$data->generaldata??[];
        $data->generaldata=$gendata;
        $data->save();


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'PinCode', $olddata, json_encode($data->getChanges()));
        }
        $data=Pincode::with('storedata')->find($data->id);

        $x['errorstat']=0;
        $x['data']=$data;
        return $x;
    }
    public function destroy(Request $request)
    {
        $data=PinCode::find($request->id);
        $logdata = new Logger();
        $logdata->addLog(2, 'Pincode', null, $data);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/PinCode');
    }

    public function import(Request $request){
        $validate = Validator::make($request->all(),[
            'file'=>'required|max:50000'
        ],[
            'file.mimes'=>'Sorry Please Check the Format',
            'file.max'=>'Maximum Size is 50 MB'
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $file=$request->file('file');
        Excel::import(new PincodeImport, $file);
        $request->session()->flash('status', 'Imported Succesfully');
        return redirect('/admin/pincode');
    }

}
