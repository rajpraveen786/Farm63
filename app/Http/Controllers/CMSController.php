<?php

namespace App\Http\Controllers;

use App\Model\CMS;
use App\Model\Discounts;
use App\Model\Logger;
use Illuminate\Http\Request;

class CMSController extends Controller
{
    public function index(Request $request)
    {
        $data = CMS::get();
        return view('Admin.CMS.list');
    }
    public function create(Request $request,$name)
    {
        $data = CMS::where('name',$name)->first();
        if($data){
            return view('Admin.CMS.add', [
                'data' => $data,
                'name'=>$name
            ]);
        }
    }
    public function store(Request $request,$name)
    {
        $data = CMS::where('name',$name)->first();
        $olddata = $data;
        $data->desc = $request->value;
        $data->save();

        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'CMS - '.$name, $olddata, json_encode($data->getChanges()));
        }

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/cms');
    }

    public function show($id, Request $request)
    {
        try {
            $data = Discounts::find(decrypt($id));
            if ($data) {
                return view('Admin.CMS/view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Discounts not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/discounts/netdiscount');
    }
    public function edit($id, Request $request)
    {
        $data = Discounts::find(decrypt($id));
        return view('Admin.CMS/edit', [
            'data' => $data,
        ]);
    }
    public function update(Request $request, $id)
    {


        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/discounts/netdiscount/view/' . encrypt($data->id));
    }
    public function destroy(Request $request, $id)
    {
        $data = Discounts::find(decrypt($id));

        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/discounts/netdiscount');
    }
}
