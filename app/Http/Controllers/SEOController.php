<?php

namespace App\Http\Controllers;

use App\Model\SEO;
use Illuminate\Http\Request;

class SEOController extends Controller
{
    public function index(Request $request)
    {
        $data=SEO::select('page','title','desc','id')->orderBy('id','asc');
        if($request->name){
            $data=$data->where('name','LIKE','%'.$request->name.'%');
        }
        $data=$data->paginate(20);
        return view('Admin.SEO.list',['data'=>$data]);
    }
    public function show($id,Request $request)
    {
        try {
            $data = SEO::find(decrypt($id));
            if($data){
                return view('Admin.SEO/view',['data'=>$data]);
            }
            else{
                $request->session()->flash('error', 'Sorry SEO not found');
            }
        }
        catch (DecryptException $e) {
            $request->session()->flash('error', 'Please refresh page');
        }
        return redirect('/admin/seo');
    }
    public function edit($name,Request $request)
    {
            $data = SEO::where('page',$name)->first();
            if($data){
                return view('Admin.SEO/edit',['data'=>$data]);
            }
            else{
                return redirect('/admin/seo');
            }

    }
    public function update(Request $request,$name)
    {
        // return $request;
        $data=SEO::where('page',$name)->first();
        $data->title=$request->title;
        $data->desc=$request->desc;
        $data->save();
        $request->session()->flash('status', 'Edited Succesfully');
        return redirect('/admin/seo');

    }
    public function destroy(Request $request,$id)
    {
        $data=SEO::find(decrypt($id));
        File::delete($data->loc);
        $data->delete();
        $request->session()->flash('status', 'Deleted Succesfully');
        return redirect('/admin/seo');
    }
}
