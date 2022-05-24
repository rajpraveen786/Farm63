<?php

namespace App\Http\Controllers;

use App\Model\Category;
use App\Model\Logger;
use Illuminate\Http\Request;



use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class CategoryController extends Controller
{
    public function index(Request $request)
    {
        $data = Category::select('name','status', 'loc', 'id')->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if (!is_null($request->status) && $request->status>=0) {
            $data = $data->where('status',$request->status);
        }
        $data = $data->paginate(20);
        return view('Admin.Master/Category.list', ['data' => $data]);
    }

    public function create(Request $request)
    {
        return view('Admin.Master/Category/add');
    }
    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'desc' => 'nullable',
            'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'bannerimg' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'name.required' => 'Please enter the Name',
            'loc.required' => 'Please upload the image',
            'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max' => 'Image Size Mus be maximum 5 mb',
            'bannerimg.required'=>'Please upload the banner image',
            'bannerimg.mimes'=>'Please upload the banner image as jpeg,png,jpg,gif,svg,webp',
            'bannerimg.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data = new Category;
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->seo_title = $request->seotitle;
        $data->seo_desc = $request->seodesc;
        $data->homebanner=$request->homebanner??0;
        $data->status=$request->status?1:0;
        while (1) {
            $strrand = Str::random(16);
            if (!$data->loc) {
                if (!Storage::disk('public')->has('category/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('category/' . $newfilename, File::get($image));
                    $data->loc = 'storage/category/' . $newfilename;
                }
            }
            if ($data->loc) {
                break;
            }
        }

        while(1){
            $strrand=Str::random(16);
            if(!$data->banner){
                if(!Storage::disk('public')->has('category/'.$strrand.'.'.$request->file('bannerimg')->getClientOriginalExtension())){
                    $image = $request->file('bannerimg');
                    $newfilename = $strrand.".".$request->file('bannerimg')->getClientOriginalExtension();
                    Storage::disk('public')->put('category/' . $newfilename, File::get($image));
                    $data->banner='storage/category/'.$newfilename;
                }
            }
            if($data->banner){
                break;
            }
        }
        $data->save();

        $logdata = new Logger();
        $logdata->addLog(0, 'Category', null, $data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/master/category');
    }

    public function show($id, Request $request)
    {
        try {
            $data = Category::find(decrypt($id));
            if ($data) {
                return view('Admin.Master/Category.view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Category not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/master/category');
    }
    public function edit($id, Request $request)
    {
        $data = Category::find(decrypt($id));
        return view('Admin.Master/Category/edit', ['data' => $data]);
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
            'desc' => 'nullable',
            'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            'bannerimg' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'name.required' => 'Please enter the Name',
            'loc.required' => 'Please upload the image',
            'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max' => 'Image Size Mus be maximum 5 mb',
            'bannerimg.required'=>'Please upload the banner image',
            'bannerimg.mimes'=>'Please upload the banner image as jpeg,png,jpg,gif,svg,webp',
            'bannerimg.max' => 'Image Size Mus be maximum 5 mb',

        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data = Category::find(decrypt($id));
        $olddata = $data;
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->seo_title = $request->seotitle;
        $data->seo_desc = $request->seodesc;
        $data->homebanner=$request->homebanner??0;
        $data->status=$request->status?1:0;
        if ($request->loc) {
            while (1) {
                $strrand = Str::random(16);
                if (!Storage::disk('public')->has('category/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    File::delete($data->loc);
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('category/' . $newfilename, File::get($image));
                    $data->loc = 'storage/category/' . $newfilename;
                    break;
                }
            }
        }

        if($request->bannerimg){
            while(1){
                $strrand=Str::random(16);
                if(!Storage::disk('public')->has('category/'.$strrand.'.'.$request->file('bannerimg')->getClientOriginalExtension())){
                    File::delete($data->banner);
                    $image = $request->file('bannerimg');
                    $newfilename = $strrand.".".$request->file('bannerimg')->getClientOriginalExtension();
                    Storage::disk('public')->put('category/' . $newfilename, File::get($image));
                    $data->banner='storage/category/'.$newfilename;
                    break;
                }
            }
        }
        // return $data;
        $data->save();

        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'Category', $olddata, json_encode($data->getChanges()));
        }

        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/master/category');
    }
    public function destroy(Request $request, $id)
    {
        $data = Category::find(decrypt($id));

        $logdata = new Logger();
        $logdata->addLog(2, 'Category', null, $data);


        File::delete($data->loc);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/master/category');
    }
}
