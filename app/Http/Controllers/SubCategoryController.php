<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Logger;
use App\Model\SubCategory;
use Illuminate\Http\Request;
use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class SubCategoryController extends Controller
{
    public function index(Request $request)
    {
        $data=SubCategory::select('name','status','loc','id','cid')->orderBy('id','asc')->with('category');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name.'%');
        }
        if (!is_null($request->status) && $request->status>=0) {
            $data = $data->where('status',$request->status);
        }
        $data=$data->paginate(20);
        // return $data;
        return view('Admin.Master/SubCategory.list',['data'=>$data]);
    }

    public function create(Request $request)
    {
        $category=Category::select('id','name')->get();
        return view('Admin.Master/SubCategory/add',['category'=>$category]);
    }
    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'cid' => 'required|max:255',
            'desc' => 'nullable',
            'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'bannerimg' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ],[
            'name.required'=>'Please enter the Name',
            'cid.required'=>'Please enter the Name',
            'loc.required'=>'Please upload the image',
            'loc.mimes'=>'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max'=>'Image Size Mus be maximum 5 mb',
            'bannerimg.required'=>'Please upload the banner image',
            'bannerimg.mimes'=>'Please upload the banner image as jpeg,png,jpg,gif,svg,webp',
            'bannerimg.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }


        $data=new SubCategory;
        $data->cid=$request->cid;
        $data->name=$request->name;
        $data->desc=$request->desc;
        $data->seo_title=$request->seotitle;
        $data->seo_desc=$request->seodesc;
        $data->status=$request->status?1:0;
        while(1){
            $strrand=Str::random(16);
            if(!$data->loc){
                if(!Storage::disk('public')->has('subcategory/'.$strrand.'.'.$request->file('loc')->getClientOriginalExtension())){
                    $image = $request->file('loc');
                    $newfilename = $strrand.".".$request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('subcategory/' . $newfilename, File::get($image));
                    $data->loc='storage/subcategory/'.$newfilename;
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
        $logdata->addLog(0,'Sub Category',null,$data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/master/subcategory');
    }

    public function show($id,Request $request)
    {
        try {
            $data = SubCategory::find(decrypt($id));
            if($data){
                return view('Admin.Master/SubCategory/view',['data'=>$data]);
            }
            else{
                $request->session()->flash('error', 'Sorry SubCategory not found');
            }
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/master/subcategory');
    }
    public function edit($id,Request $request)
    {
            $data = SubCategory::find(decrypt($id));
            $category=Category::select('id','name')->get();
            return view('Admin.Master/SubCategory/edit',['data'=>$data,'category'=>$category]);
    }
    public function update(Request $request,$id)
    {
        $validate = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'cid' => 'required|max:255',
            'desc' => 'nullable',
            'bannerimg' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ],[
            'name.required'=>'Please enter the Name',
            'cid.required'=>'Please enter the Name',
            'loc.required'=>'Please upload the image',
            'loc.mimes'=>'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max'=>'Image Size Mus be maximum 5 mb',
            'bannerimg.required'=>'Please upload the banner image',
            'bannerimg.mimes'=>'Please upload the banner image as jpeg,png,jpg,gif,svg,webp',
            'bannerimg.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data=SubCategory::find(decrypt($id));
        $olddata=$data;


        $data->cid=$request->cid;
        $data->name=$request->name;
        $data->desc=$request->desc;
        $data->seo_title=$request->seotitle;
        $data->seo_desc=$request->seodesc;
        $data->status=$request->status?1:0;
        if($request->loc){
            while(1){
                $strrand=Str::random(16);
                if(!Storage::disk('public')->has('subcategory/'.$strrand.'.'.$request->file('loc')->getClientOriginalExtension())){
                    File::delete($data->loc);
                    $image = $request->file('loc');
                    $newfilename = $strrand.".".$request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('subcategory/' . $newfilename, File::get($image));
                    $data->loc='storage/subcategory/'.$newfilename;
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
            $logdata->addLog(1, 'Sub Category', $olddata, json_encode($data->getChanges()));
        }


        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/master/subcategory');

    }
    public function destroy(Request $request,$id)
    {
        $data=SubCategory::find(decrypt($id));
        $logdata = new Logger();
        $logdata->addLog(2, 'Sub Category', null, $data);

        File::delete($data->loc);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/subcategory');
    }
}
