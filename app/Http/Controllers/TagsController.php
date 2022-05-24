<?php

namespace App\Http\Controllers;

use App\Model\Logger;
use App\Model\Tags;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class TagsController extends Controller
{

    public function index(Request $request)
    {
        $data=Tags::select('name','id')->orderBy('id','asc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name.'%');
        }
        $data=$data->paginate(20);
        // return $data;
        return view('Admin.Master/Tags.list',['data'=>$data]);
    }

    public function store(Request $request)
    {
        $data=new Tags;
        $data->name=$request->name;
        $data->save();
        $x['status']=1;
        $x['data']=$data;


        $logdata =new Logger();
        $logdata->addLog(0,'Tags',null,$data);


        return $x;
    }
    public function update(Request $request)
    {
        $data=Tags::find($request->id);
        $olddata=$data;

        $data->name=$request->name;
        $data->save();
        $x['status']=1;
        $x['data']=$data;


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'Tags', $olddata, json_encode($data->getChanges()));
        }

        return $x;
    }
    public function destroy(Request $request)
    {
        $data=Tags::find($request->id);
        $logdata = new Logger();
        $logdata->addLog(2, 'Tags', null, $data);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/attribute');
    }
}
