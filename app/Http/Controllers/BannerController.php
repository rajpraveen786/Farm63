<?php

namespace App\Http\Controllers;

use App\Model\Banner;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Logger;
use App\Model\Products;
use Illuminate\Http\Request;


use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class BannerController extends Controller
{
    public function index(Request $request)
    {
        $data = Banner::select('name','status', 'loc', 'link', 'id')->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if (!is_null($request->status) && $request->status>=0) {
            $data = $data->where('status',$request->status);
        }
        $data = $data->paginate(20);
        return view('Admin.Banner.list', ['data' => $data]);
    }

    public function create(Request $request)
    {
        $category = Category::select('id', 'name')->get();
        $brand = Brand::select('id', 'name')->get();
        $products = Products::select('id', 'name','urlslug')->get();
        return view('Admin.Banner/add', [
            'category' => $category,
            'brand' => $brand,
            'products' => $products,
        ]);
    }
    public function store(Request $request)
    {
        // return $request;
        $validate = Validator::make($request->all(), [
            'name' => 'nullable|max:255',
            'desc' => 'nullable',
            'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'name.nullable' => 'Please enter the Name',
            'loc.required' => 'Please upload the image',
            'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }


        $data = new Banner;
        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->linkt = $request->linkt;
        $data->optsel = $request->optsel;
        $data->link = $request->link;
        $data->status=$request->status?1:0;
        while (1) {
            $strrand = Str::random(16);
            if (!$data->loc) {
                if (!Storage::disk('public')->has('banner/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('banner/' . $newfilename, File::get($image));
                    $data->loc = 'storage/banner/' . $newfilename;
                }
            }
            if ($data->loc) {
                break;
            }
        }

        $data->save();




        $logdata = new Logger();
        $logdata->addLog(0, 'Banner', null, $data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/banner');
    }

    public function show($id, Request $request)
    {
        try {
            $data = Banner::find(decrypt($id));
            if ($data) {
                return view('Admin.Banner.view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Banner not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/banner');
    }
    public function edit($id, Request $request)
    {
        $data = Banner::find(decrypt($id));
        $category = Category::select('id', 'name')->get();
        $brand = Brand::select('id', 'name')->get();
        $products = Products::select('id', 'name','urlslug')->get();
        return view('Admin.Banner/edit', [
            'data' => $data,
            'category' => $category,
            'products' => $products,
            'brand' => $brand,
        ]);
    }
    public function update(Request $request, $id)
    {

        $validate = Validator::make($request->all(), [
            'name' => 'nullable|max:255',
            'desc' => 'nullable',
            'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
        ], [
            'name.nullable' => 'Please enter the Name',
            'loc.required' => 'Please upload the image',
            'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            'loc.max' => 'Image Size Mus be maximum 5 mb',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }


        $data = Banner::find(decrypt($id));
        $olddata = $data;

        $data->name = $request->name;
        $data->desc = $request->desc;
        $data->linkt = $request->linkt;
        $data->optsel = $request->optsel;
        $data->link = $request->link;
        $data->status=$request->status?1:0;
        if ($request->loc) {
            while (1) {
                $strrand = Str::random(16);
                if (!Storage::disk('public')->has('banner/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    File::delete($data->loc);
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('banner/' . $newfilename, File::get($image));
                    $data->loc = 'storage/banner/' . $newfilename;
                    break;
                }
            }
        }
        $data->save();


        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'Banner', $olddata, json_encode($data->getChanges()));
        }



        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/banner');
    }
    public function destroy(Request $request, $id)
    {
        $data = Banner::find(decrypt($id));
        $logdata = new Logger();
        $logdata->addLog(2, 'Banner', null, $data);
        File::delete($data->loc);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/banner');
    }
}
