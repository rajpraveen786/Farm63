<?php

namespace App\Http\Controllers;

use App\Model\Logger;
use Illuminate\Http\Request;

use App\Model\Store;

use Validator;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class StoreController extends Controller
{
    public function index(Request $request)
    {

        $status=$request->status??-1;
        $data = Store::select('name', 'id','status')->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE','%'.$request->name.'%');
        }

        if ($status>=0) {
            $data = $data->where('status',$status);
        }

        $data = $data->paginate(20);
        return view('Admin.Store.list', ['data' => $data,'status'=>$status]);
    }

    public function create(Request $request)
    {
        if (Auth::user()->permission->general->productsadd) {
            return view('Admin.Store.add', [
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/store');
        }
    }
    public function store(Request $request)
    {
        // return ;
        if (Auth::user()->permission->general->productsadd) {

            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'location' => 'nullable|max:255',
            ], [
                'name.required' => 'Please enter the Name',
                'location.required' => 'Please enter the Location',
            ]);

            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            // return $request;

            $data = new Store;
            $data->name = $request->name;

            $storedet=[];
            $storedet['location']=$request->location;
            $data->general=$storedet;
            $data->save();
            $request->session()->flash('status', 'Added Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/store/view/' . encrypt($data->id));
    }
    public function show($id, Request $request)
    {
        if (Auth::user()->permission->general->productsview) {

            try {
                $data = Store::find(decrypt($id));
                if ($data) {
                    return view('Admin.Store.view', ['data' => $data]);
                } else {
                    $request->session()->flash('error', 'Sorry Store not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/store');
    }
    public function edit($id, Request $request)
    {
        if (Auth::user()->permission->general->productsedit) {
            $data = Store::find(decrypt($id));
            return view('Admin.Store.edit', [
                'data' => $data,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/store');
        }
    }
    public function update(Request $request, $id)
    {
        // return $request;
        if (Auth::user()->permission->general->productsedit) {

            $validate = Validator::make($request->all(), [
                'name' => 'required|max:255',
                'location' => 'nullable|max:255',
            ], [
                'name.required' => 'Please enter the Name',
                'location.required' => 'Please enter the Location',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }


            $data = Store::find(decrypt($request->id));
            $olddata=$data;
            $datax=$data->general??[];
            $datax->location=$request->location;
            $data->general=$datax;
            $data->save();


            if ($data->getChanges()) {
                $logdata = new Logger();
                $logdata->addLog(1, 'Store', $olddata, json_encode($data->getChanges()));
            }


            $request->session()->flash('status', 'Edited Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/store/view/' . encrypt($data->id));
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->permission->general->productsdel) {

            $data = Store::find(decrypt($id));
            $logdata = new Logger();
            $logdata->addLog(2, 'Store', null, $data);

            $img = ProductImage::where('pid', $data->id)->pluck('id');
            for ($i = 0; $i < count($img); $i++) {
                $datax = ProductImage::find($img[$i]);
                File::delete($datax->loc);
                $datax->delete();
            }

            $data->delete();
            $request->session()->flash('status', 'Deleted Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/store');
    }

}
