<?php

namespace App\Http\Controllers;

use App\Model\Brand;
use App\Model\Category;
use App\Model\Logger;
use App\Model\Products;
use App\PagesCollections;
use Validator;
use Str;
use Illuminate\Http\Request;

use Storage;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class PagesCollectionsController extends Controller
{
    public function subbannerindex(Request $request,$pagename)
    {
        $data = PagesCollections::where('name',$pagename);
        $data = $data->get();
        return view('Admin.PagesCollection/SubBanner.list', ['data' => $data]);
    }

    public function subbannercreate(Request $request,$pagename)
    {
        $category = Category::select('id', 'name')->get();
        $brand = Brand::select('id', 'name')->get();
        $products = Products::select('id', 'name')->get();
        return view('Admin.PagesCollection/SubBanner/add', [
            'pagename' => $pagename,
            'category' => $category,
            'brand' => $brand,
            'products' => $products,
        ]);
    }
    public function subbannerstore(Request $request,$pagename)
    {
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

        $data=PagesCollections::where('name',$pagename)->first();
        $temp=json_decode($data->banner);
        if(count($temp)<=0) {
            $tempdata=[];
        }
        else{
            $tempdata=$temp;
        }
        $check=0;
        $strrand=1;
        while (1) {
            $strrand = Str::random(16);
            for($i=0;$i<count($tempdata);$i++){
                if( $strrand==$tempdata[$i]->id){
                    $check=1;
                    break;
                }
            }
            if(!$check){
                break;
            }
        }
        $xtemp['id']=$strrand;
        $xtemp['name']=$request->name;
        $xtemp['desc']=$request->desc;
        $xtemp['linkt']=$request->linkt;
        $xtemp['optsel']=$request->optsel;
        $xtemp['link']=$request->link;
        $xtemp['status']=$request->status;
        $xtemp['loc']='';

        while (1) {
            $strrand = Str::random(16);
            if (!$xtemp['loc']) {
                if (!Storage::disk('public')->has('Pages/'.$pagename.'/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('Pages/'.$pagename.'/' . $newfilename, File::get($image));
                    $xtemp['loc']= 'storage/Pages/'.$pagename.'/' . $newfilename;
                }
            }
            if ($xtemp['loc']!='') {
                break;
            }
        }
        array_push($tempdata, $xtemp);
        $data->banner=json_encode($tempdata);
        $data->save();

        $logdata = new Logger();
        $logdata->addLog(0, 'PagesCollection-SubBanner', null, $data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/pages/view/'.encrypt($data->id));
    }

    public function subbannershow(Request $request, $id,$pagename)
    {
        try {
            $data = PagesCollections::find(decrypt($id));
            if ($data) {
                return view('Admin.PagesCollection/SubBanner/view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry Sub banner not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/pages/view/'.$pagename);
    }
    public function subbanneredit(Request $request,$pagename, $id)
    {
        $data=PagesCollections::where('name',$pagename)->first();
        $temp=json_decode($data->banner);
        for($i=0;$i<count($temp);$i++){
            if($temp[$i]->id==$id){
                $data=$temp[$i];
                break;
            }
        }

        $category = Category::select('id', 'name')->get();
        $brand = Brand::select('id', 'name')->get();
        $products = Products::select('id', 'name')->get();
        return view('Admin.PagesCollection/SubBanner/edit', [
            'data' => $data,
            'pagename' => $pagename,
            'category' => $category,
            'products' => $products,
            'brand' => $brand,
        ]);
    }
    public function subbannerupdate(Request $request,$pagename, $id)
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
        $data=PagesCollections::where('name',$pagename)->first();
        $temp=json_decode($data->banner);
        $index=0;
        $tempdata=$temp;
        for($i=0;$i<count($tempdata);$i++){
            if($id==$tempdata[$i]->id){
                $index=$i;
                break;
            }
        }


        $xtemp=$tempdata[$index];
        $xtemp->name=$request->name;
        $xtemp->desc=$request->desc;
        $xtemp->linkt=$request->linkt;
        $xtemp->optsel=$request->optsel;
        $xtemp->link=$request->link;
        $xtemp->status=$request->status;

        if ($request->loc) {
            while (1) {
                $strrand = Str::random(16);
                if (!Storage::disk('public')->has('Pages/'.$pagename.'/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                    File::delete($xtemp->loc);
                    $image = $request->file('loc');
                    $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                    Storage::disk('public')->put('Pages/'.$pagename.'/' . $newfilename, File::get($image));
                    $xtemp->loc = 'storage/Pages/'.$pagename.'/' . $newfilename;
                    break;
                }
            }
        }

        $tempdata[$index]=$xtemp;
        $data->banner=json_encode($temp);

        $data->save();


        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/pages/view/'.encrypt($data->id));
    }
    public function subbannerdestroy(Request $request,$pagename, $id)
    {
        $data=PagesCollections::where('name',$pagename)->first();
        $temp=json_decode($data->banner);
        $index=0;
        for($i=0;$i<count($temp);$i++){
            if($id==$temp[$i]->id){
                $index=$i;
                break;
            }
        }
        File::delete($temp[$i]->loc);
        unset($temp[$index]);
        $temp=array_values($temp);
        $data->banner=json_encode($temp);
        $data->save();


        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/pages/view/'.encrypt($data->id));
    }




    public function index(Request $request){
        $data=PagesCollections::get();
        return view('Admin.PagesCollection.list',['data'=>$data]);
    }
    public function create(Request $request)
    {
        return view('Admin.PagesCollection.add');
    }
    public function store(Request $request)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ], [
            'name.required' => 'Please enter the Name',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }

        $data = new PagesCollections;
        $data->name = $request->name;
        $data->banner = json_encode([]);
        $data->categorybanner = json_encode([]);
        $data->brandbanner = json_encode([]);
        $data->save();

        $logdata = new Logger();
        $logdata->addLog(0, 'PagesCollection', null, $data);

        $request->session()->flash('status', 'Added Succesfully');
        return redirect('/admin/pages');
    }

    public function show($id, Request $request)
    {
        try {
            $data = PagesCollections::find(decrypt($id));
            if ($data) {
                return view('Admin.PagesCollection.view', ['data' => $data]);
            } else {
                $request->session()->flash('error', 'Sorry PagesCollection not found');
            }
        } catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/pages');
    }
    public function edit($id, Request $request)
    {
        $data = PagesCollections::find(decrypt($id));
        return view('Admin.PagesCollection.edit', ['data' => $data]);
    }
    public function update(Request $request, $id)
    {
        $validate = Validator::make($request->all(), [
            'name' => 'required|max:255',
        ], [
            'name.required' => 'Please enter the Name',
        ]);
        if ($validate->fails()) {
            return back()->withInput()->withErrors($validate);
        }
        $data = PagesCollections::find(decrypt($id));
        $data->name = $request->name;
        $data->save();

        if ($data->getChanges()) {
            $logdata = new Logger();
            $logdata->addLog(1, 'PagesCollection', null, json_encode($data->getChanges()));
        }

        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/pages');
    }
    public function destroy(Request $request, $id)
    {
        $data = PagesCollections::find(decrypt($id));

        $logdata = new Logger();
        $logdata->addLog(2, 'PagesCollection', null, $data);

        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/pages');
    }
}
