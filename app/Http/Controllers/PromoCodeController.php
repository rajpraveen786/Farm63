<?php

namespace App\Http\Controllers;

use App\Model\PromoCode;
use Illuminate\Http\Request;
use App\Model\Category;
use App\Model\Logger;
use App\Model\Orders;
use App\Model\Products;


use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;
use Illuminate\Support\Facades\Auth;

class PromoCodeController extends Controller
{
    public function index(Request $request)
    {
        $data = PromoCode::select('name', 'id','status', 'loc')->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        $data = $data->paginate(20);
        // return $data;
        return view('Admin.Discount/PromoCode/list', ['data' => $data]);
    }

    public function create(Request $request)
    {

        if (Auth::user()->permission->general->promocodeadd) {

            $category = Category::select('id', 'name')->with('subcategory')->get();
            $products = Products::select('id', 'name')->get();
            return view('Admin.Discount/PromoCode/add', [
                'category' => $category,
                'products' => $products,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/discounts/promocode');
        }
    }
    public function store(Request $request)
    {

        if (Auth::user()->permission->general->promocodeadd) {

            // return $request;
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'code' => 'required|unique:promo_codes,code|min:6',
                'type' => 'required',
                'subtype' => 'required',
                'startdate' => 'required',
                'enddate' => 'nullable',
                'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ], [
                'name.required' => 'Name is Required',
                'type.required' => 'Type of Discount is Required',
                'code.unique' => 'Code is already taken',
                'code.required' => 'Code is Required',
                'code.min' => 'Minimum length of Code is 6',
                'subtype.required' => 'Applies to field is Required',
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
            $data = new PromoCode();

            $data->name = $request->name;
            $data->oneuse = $request->oneuse ? $request->oneuse : 0;
            $data->noofuse = $request->noofuse;
            $data->code = $request->code;
            $data->type = $request->type;
            $data->value = $request->value;
            $data->subtype = $request->subtype;
            $data->optid = $request->optid;
            $data->subdata = $request->subdata;
            $data->startdate = $request->startdate;
            $data->enddate = $request->enddate;

            $data->minreq = $request->minreq;
            $data->minreqdata = $request->minreqdata;
            while (1) {
                $strrand = Str::random(16);
                if (!$data->loc) {
                    if (!Storage::disk('public')->has('discount/promocode/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                        $image = $request->file('loc');
                        $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                        Storage::disk('public')->put('discount/promocode/' . $newfilename, File::get($image));
                        $data->loc = 'storage/discount/promocode/' . $newfilename;
                    }
                }
                if ($data->loc) {
                    break;
                }
            }
            $data->save();

            $logdata = new Logger();
            $logdata->addLog(0, 'PromoCode', null, $data);


            $request->session()->flash('status', 'Added Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/promocode/view/' . encrypt($data->id));
    }

    public function show($id, Request $request)
    {
        if (Auth::user()->permission->general->promocodeview) {

            try {
                $data = PromoCode::find(decrypt($id));
                if ($data) {
                    $id = explode(',', $data->optid);

                    $order = Orders::select('id', 'total', 'pid', 'uid')->orderBy('id', 'desc');

                    $order = $order->paginate(10);
                    return view('Admin.Discount/PromoCode/view', ['data' => $data, 'order' => $order]);
                } else {
                    $request->session()->flash('error', 'Sorry PromoCode not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/promocode');
    }
    public function edit($id, Request $request)
    {

        if (Auth::user()->permission->general->promocodeedit) {

            $data = PromoCode::find(decrypt($id));
            $category = Category::select('id', 'name')->with('subcategory')->get();
            $products = Products::select('id', 'name')->get();
            return view('Admin.Discount/PromoCode/edit', [
                'category' => $category,
                'data' => $data,
                'products' => $products,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/discounts/promocode');
        }
    }
    public function update(Request $request, $id)
    {

        if (Auth::user()->permission->general->promocodeedit) {

            // return $request;
            $validate = Validator::make($request->all(), [
                'name' => 'required',
                'type' => 'required',
                'subtype' => 'required',
                'startdate' => 'required',
                'enddate' => 'nullable',
                'loc' => 'nullable|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ], [
                'name.required' => 'Name is Required',
                'type.required' => 'Type of Discount is Required',
                'subtype.required' => 'Applies to field is Required',
                'startdate.required' => 'Start Date is Required',
                'enddate.required' => 'End Date is Required',

                'loc.required' => 'Please upload the image',
                'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            $data = PromoCode::find(decrypt($id));
            $olddata=$data;

            $data->name = $request->name;
            $data->oneuse = $request->oneuse ? $request->oneuse : 0;
            $data->noofuse = $request->noofuse;
            $data->code = $request->code;
            $data->value = $request->value;
            if (!$request->optid) {
                $ids = Products::pluck('id')->toArray();
                $data->optid = implode(",", $ids);
            } else {
                $data->optid = $request->optid;
            }
            $data->subdata = $request->subdata;
            $data->startdate = $request->startdate;
            $data->enddate = $request->enddate;

            if ($request->loc) {
                while (1) {
                    $strrand = Str::random(16);
                    if (!Storage::disk('public')->has('discount/promocode/' . $strrand . '.' . $request->file('loc')->getClientOriginalExtension())) {
                        File::delete($data->loc);
                        $image = $request->file('loc');
                        $newfilename = $strrand . "." . $request->file('loc')->getClientOriginalExtension();
                        Storage::disk('public')->put('discount/promocode/' . $newfilename, File::get($image));
                        $data->loc = 'storage/discount/promocode/' . $newfilename;
                        break;
                    }
                }
            }
            $data->save();


            if ($data->getChanges()) {
                $logdata = new Logger();
                $logdata->addLog(1, 'PromoCode', $olddata, json_encode($data->getChanges()));
            }

            $request->session()->flash('status', 'Edited Succesfully');
            return redirect('/admin/discounts/netdiscount');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/promocode/view/' . encrypt($data->id));
    }
    public function destroy(Request $request, $id)
    {

        if (Auth::user()->permission->general->promocodedel) {

            $data = PromoCode::find(decrypt($id));
            $logdata = new Logger();
            $logdata->addLog(2, 'PromoCode', null, $data);
            File::delete($data->loc);
            $data->delete();
            $request->session()->flash('status', 'Deleted Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/discounts/promocode');
    }
}
