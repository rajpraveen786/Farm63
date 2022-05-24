<?php

namespace App\Http\Controllers;

use App\Model\Attribute;
use App\Model\Logger;
use Illuminate\Http\Request;

use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class AttributeController extends Controller
{
    public function index(Request $request)
    {
        $data=Attribute::select('name','id')->orderBy('id','asc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name.'%');
        }
        $data=$data->paginate(20);
        // return $data;
        return view('Admin.Master/Attribute/list',['data'=>$data]);
    }

    public function store(Request $request)
    {
        $data=new Attribute;
        $data->name=$request->name;
        $data->save();
        $x['status']=1;
        $x['data']=$data;


        $logdata =new Logger();
        $logdata->addLog(0,'Attribute',null,$data);



        return $x;
    }
    public function update(Request $request)
    {
        $data=Attribute::find($request->id);
        $olddata=$data;
        $data->name=$request->name;
        $data->save();
        $x['status']=1;
        $x['data']=$data;


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'Attribute', $olddata, json_encode($data->getChanges()));
        }
        return $x;
    }
    public function destroy(Request $request)
    {
        $data=Attribute::find($request->id);
        $logdata = new Logger();
        $logdata->addLog(2, 'Attribute', null, $data);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/attribute');
    }
}
