<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Logger;
use Illuminate\Http\Request;


use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class BrandController extends Controller
{
    public function index(Request $request)
    {
        $data=Brand::select('name','status','loc','id')->orderBy('id','asc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name.'%');
        }
        if (!is_null($request->status) && $request->status>=0) {
            $data = $data->where('status',$request->status);
        }
        $data=$data->paginate(20);
        return view('Admin.Master/Brand.list',['data'=>$data]);
    }

    public function create(Request $request)
    {
        return view('Admin.Master/Brand/add');
    }
    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'desc' => 'nullable',
            'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'bannerimg' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ],[
             'name.required'=>'Please enter the Name',
            'loc.required'=>'Please upload the image',
            'loc.mimes'=>'Please upload the image as jpeg,png,jpg,gif,svg,webp',

            'bannerimg.required'=>'Please upload the banner image',
            'bannerimg.mimes'=>'Please upload the banner image as jpeg,png,jpg,gif,svg,webp',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }


        $data=new Brand;
        $data->name=$request->name;
        $data->desc=$request->desc;
        $data->seo_title=$request->seotitle;
        $data->homebanner=$request->homebanner??0;
        $data->seo_desc=$request->seodesc;
        $data->status=$request->status?1:0;
        while(1){
            $strrand=Str::random(16);
            if(!$data->loc){
                if(!Storage::disk('public')->has('brand/'.$strrand.'.'.$request->file('loc')->getClientOriginalExtension())){
                    $image = $request->file('loc');
                    $newfilename = $strrand.".".$request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('brand/' . $newfilename, File::get($image));
                    $data->loc='storage/brand/'.$newfilename;
                }
            }
            if($data->loc){
                break;
            }
        }

        while(1){
            $strrand=Str::random(16);
            if(!$data->banner){
                if(!Storage::disk('public')->has('brand/'.$strrand.'.'.$request->file('bannerimg')->getClientOriginalExtension())){
                    $image = $request->file('bannerimg');
                    $newfilename = $strrand.".".$request->file('bannerimg')->getClientOriginalExtension();
                    Storage::disk('public')->put('brand/' . $newfilename, File::get($image));
                    $data->banner='storage/brand/'.$newfilename;
                }
            }
            if($data->banner){
                break;
            }
        }

        $data->save();


        $logdata =new Logger();
        $logdata->addLog(0,'Brand',null,$data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/master/brand');
    }

    public function show($id,Request $request)
    {
        try {
            $data = Brand::find(decrypt($id));
            if($data){
                return view('Admin.Master/Brand/view',['data'=>$data]);
            }
            else{
                $request->session()->flash('error', 'Sorry Brand not found');
            }
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/master/brand');
    }
    public function edit($id,Request $request)
    {
            $data = Brand::find(decrypt($id));
            return view('Admin.Master/Brand/edit',['data'=>$data]);
    }
    public function update(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'desc' => 'nullable',
            'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'bannerimg' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ],[
            'name.required'=>'Please enter the Name',
            'loc.required'=>'Please upload the image',
            'loc.mimes'=>'Please upload the image as jpeg,png,jpg,gif,svg,webp',

            'bannerimg.required'=>'Please upload the banner image',
            'bannerimg.mimes'=>'Please upload the banner image as jpeg,png,jpg,gif,svg,webp',

        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=Brand::find(decrypt($id));
        $olddata=$data;

        $data->name=$request->name;
        $data->desc=$request->desc;
        $data->seo_title=$request->seotitle;
        $data->homebanner=$request->homebanner??0;
        $data->seo_desc=$request->seodesc;
        $data->status=$request->status?1:0;
        if($request->loc){
            while(1){
                $strrand=Str::random(16);
                if(!Storage::disk('public')->has('brand/'.$strrand.'.'.$request->file('loc')->getClientOriginalExtension())){
                    File::delete($data->loc);
                    $image = $request->file('loc');
                    $newfilename = $strrand.".".$request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('brand/' . $newfilename, File::get($image));
                    $data->loc='storage/brand/'.$newfilename;
                    break;
                }
            }
        }


        if($request->bannerimg){
            while(1){
                $strrand=Str::random(16);
                if(!Storage::disk('public')->has('brand/'.$strrand.'.'.$request->file('bannerimg')->getClientOriginalExtension())){
                    File::delete($data->banner);
                    $image = $request->file('bannerimg');
                    $newfilename = $strrand.".".$request->file('bannerimg')->getClientOriginalExtension();
                    Storage::disk('public')->put('brand/' . $newfilename, File::get($image));
                    $data->banner='storage/brand/'.$newfilename;
                    break;
                }
            }
        }

        $data->save();


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'Brand', $olddata, json_encode($data->getChanges()));
        }



        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/master/brand');

    }
    public function destroy(Request $request,$id)
    {
        $data=Brand::find(decrypt($id));
        $logdata = new Logger();
        $logdata->addLog(2, 'Brand', null, $data);
        File::delete($data->loc);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/brand');
    }
}
