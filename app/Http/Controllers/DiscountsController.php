<?php

namespace App\Http\Controllers;

use App\Model\Discounts;
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

class DiscountsController extends Controller
{
    public function index(Request $request)
    {
        $data = Discounts::select('name', 'id','status', 'loc')->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if (!is_null($request->status) && $request->status>=0) {
            $data = $data->where('status',$request->status);
        }
        $data = $data->paginate(20);
        // return $data;
        return view('Admin.Discount/NetDiscount.list', ['data' => $data]);
    }

    public function create(Request $request)
    {

        if (Auth::user()->permission->general->discountsadd) {
            $category = Category::select('id', 'name')->with('subcategory')->get();
            $products = Products::select('id', 'name')->get();
            return view('Admin.Discount/NetDiscount/add', [
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/discounts/netdiscount');
        }
    }
    public function store(Request $request)
    {

        if (Auth::user()->permission->general->discountsadd) {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'discounttype' => 'required',
                'appliesfor' => 'required',
                'value' => 'required',
                'startdate' => 'required',
                'enddate' => 'nullable',
                'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ], [
                'name.required' => 'Name is Required',
                'discounttype.required' => 'Type of Discount is Required',
                'value.required' => 'Value is Required',
                'appliesfor.required' => 'Applies to field is Required',
                'startdate.required' => 'Start Date is Required',
                'enddate.required' => 'End Date is Required',

                'loc.required' => 'Please upload the image',
                'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            ]);
            // return $validate->errors();
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            // return $request;
            $data = new Discounts();

            $data->name = $request->name;
            $data->discounttype = $request->discounttype;
            $data->value = $request->value;
            $data->appliesfor = $request->appliesfor;

            if (!$request->optid) {
                $ids = Products::pluck('id')->toArray();
                $data->optid = json_encode($ids);
            } else {
                $data->optid = json_encode($request->optid);
                $ids = explode(',', $request->optid);
            }

            $data->optid = $request->optid;
            $data->startdate = $request->startdate;
            $data->enddate = $request->enddate;


            while (1) {
                $strrand = Str::random(16);
                if (!$data->loc) {
                    if (!Storage::disk('public')->has('discount/netdiscount/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                        $image = $request->file('loc');
                        $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                        Storage::disk('public')->put('discount/netdiscount/' . $newfilename, File::get($image));
                        $data->loc = 'storage/discount/netdiscount/' . $newfilename;
                    }
                }
                if ($data->loc) {
                    break;
                }
            }

            $data->save();

            $logdata = new Logger();
            $logdata->addLog(0, 'Discounts', null, $data);

            $request->session()->flash('status', 'Added Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/netdiscount/view/' . encrypt($data->id));
    }

    public function show($id, Request $request)
    {



        if (Auth::user()->permission->general->discountsview) {
            try {
                $data = Discounts::find(decrypt($id));
                if ($data) {
                    $id = $data->optid;
                    $products = Products::select('id', 'name', 'cid', 'fpricewtas', 'fprice', 'disa')->where('disid', $data->id);
                    if ($request->appliesfor == 1) {
                        $products = $products->whereIn('cid', $id);
                    } else if ($request->appliesfor == 2) {
                        $products = $products->whereIn('id', $id);
                    }
                    $products = $products->get();
                    // return $products;
                    return view('Admin.Discount/NetDiscount/view', ['data' => $data, 'products' => $products]);
                } else {
                    $request->session()->flash('error', 'Sorry Discounts not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/netdiscount');
    }
    public function edit($id, Request $request)
    {

        if (Auth::user()->permission->general->discountsedit) {

            $data = Discounts::find(decrypt($id));
            $category = Category::select('id', 'name')->with('subcategory')->get();
            $products = Products::select('id', 'name')->get();
            return view('Admin.Discount/NetDiscount/edit', [
                'category' => $category,
                'data' => $data,
                'products' => $products,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/discounts/netdiscount');
        }
    }
    public function update(Request $request, $id)
    {

        if (Auth::user()->permission->general->discountsedit) {
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required',
                'appliesfor' => 'required',
                'startdate' => 'required',
                'enddate' => 'nullable',
                'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ], [
                'name.required' => 'Name is Required',
                'type.required' => 'Type of Discount is Required',
                'appliesfor.required' => 'Applies to field is Required',
                'startdate.required' => 'Start Date is Required',
                'enddate.required' => 'End Date is Required',


                'loc.required' => 'Please upload the image',
                'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            $data = Discounts::find(decrypt($id));
            $olddata=$data;
            $oldvalue = $data->value;

            $ids = $request->optid ? explode(',', $request->optid) : [];

            $data->name = $request->name;
            $data->value = $request->value;


            if (!$request->optid) {
                $ids = Products::pluck('id');
                $data->optid = json_encode($ids);
            } else {
                $data->optid = json_encode($request->optid);
            }
            $data->subdata = $request->subdata;
            $data->startdate = $request->startdate;
            $data->enddate = $request->enddate;

            if ($request->loc) {
                while (1) {
                    $strrand = Str::random(16);
                    if (!Storage::disk('public')->has('discount/netdiscount/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                        File::delete($data->loc);
                        $image = $request->file('loc');
                        $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                        Storage::disk('public')->put('discount/netdiscount/' . $newfilename, File::get($image));
                        $data->loc = 'storage/discount/netdiscount/' . $newfilename;
                        break;
                    }
                }
            }
            $data->save();

            if ($data->getChanges()) {
                $logdata = new Logger();
                $logdata->addLog(1, 'Discounts', $olddata, json_encode($data->getChanges()));
            }


            $request->session()->flash('status', 'Edited Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/discounts/netdiscount');
        }
        return redirect('/admin/discounts/netdiscount/view/' . encrypt($data->id));
    }
    public function destroy(Request $request, $id)
    {

        if (Auth::user()->permission->general->discountsdel) {
            $discountdata = Discounts::find(decrypt($id));
            $logdata = new Logger();
            $logdata->addLog(2, 'Dicounts', null, $discountdata);
            File::delete($discountdata->loc);
            $prodid = [];
            $prodid=Products::where('disid',$discountdata->id)->pluck('id');
            if(count($prodid)>0){
                for($j=0;$j<count($prodid);$j++){
                    $data=Products::find($prodid[$j]);
                    $data->disid=0;
                    $data->da=0;
                    $data->disp=0;
                    $data->disa=0;
                    $difvalue=$data->fprice-$data->disa;
                    $profit=$data->fprice-$data->cpi;
                    $margin=round($profit/$difvalue,2);
                    $data->margin=$margin;
                    $data->profit=$profit;
                    $data->taxa=round(($difvalue*$data->taxp)/100,2);
                    $data->fpricebefdis=0;
                    $data->fpricewtas=$data->taxa+$data->fprice-$data->disa;
                    $data->save();
                }
            }
            $discountdata->status=0;
            $discountdata->save();

            $discountdata->delete();
            $request->session()->flash('status', 'Deleted Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/netdiscount');
    }
}
