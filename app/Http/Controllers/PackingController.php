<?php

namespace App\Http\Controllers;

use App\Model\Packing;
use App\Model\Logger;
use Illuminate\Http\Request;

class PackingController extends Controller
{
    public function index(Request $request)
    {
        $data=Packing::select('name','id')->orderBy('id','asc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name.'%');
        }
        $data=$data->paginate(20);
        // return $data;
        return view('Admin.Master/Packing/list',['data'=>$data]);
    }

    public function store(Request $request)
    {
        $data=new Packing;
        $data->name=$request->name;
        $data->save();
        $x['status']=1;
        $x['data']=$data;


        $logdata =new Logger();
        $logdata->addLog(0,'Packing',null,$data);



        return $x;
    }
    public function update(Request $request)
    {
        $data=Packing::find($request->id);
        $olddata=$data;
        $data->name=$request->name;
        $data->save();
        $x['status']=1;
        $x['data']=$data;


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'Packing', $olddata, json_encode($data->getChanges()));
        }
        return $x;
    }
    public function destroy(Request $request)
    {
        $data=Packing::find($request->id);
        $logdata = new Logger();
        $logdata->addLog(2, 'Packing', null, $data);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/packing');
    }
}
