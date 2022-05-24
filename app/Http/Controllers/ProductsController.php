<?php

namespace App\Http\Controllers;

use App\Model\Attribute;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Logger;
use App\Model\Packing;
use App\Model\ProductImage;
use App\Model\Products;
use App\Model\Tags;
use App\Model\UOM;
use Illuminate\Http\Request;

use Auth;

use Validator;
use Storage;
use Str;
use File;
use Illuminate\Contracts\Encryption\DecryptException;


class ProductsController extends Controller
{
    public function index(Request $request)
    {

        $status=$request->status??-1;
        $data = Products::select('name', 'id','status', 'fpricewtas')->orderBy('id', 'asc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE','%'.$request->name.'%');
        }
        // return $data->get();
        if ($status>=0) {
            $data = $data->where('status',$status);
        }

        $data = $data->paginate(20);
        return view('Admin.Products.list', ['data' => $data,'status'=>$status]);
    }

    public function create(Request $request)
    {
        if (Auth::user()->permission->general->productsadd) {

            $category = Category::select('id', 'name')->with('subcategory')->get();
            $brand = Brand::where('status',1)->select('id', 'name')->get();
            $tags = Tags::pluck('name');
            $uom = UOM::select('id', 'name')->get();
            $attribute = Attribute::select('id', 'name')->get();
            $packing = Packing::select('id', 'name')->get();
            return view('Admin.Products/add', [
                'category' => $category,
                'brand' => $brand,
                'tags' => $tags,
                'uom' => $uom,
                'attribute' => $attribute,
                'packing' => $packing,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/products');
        }
    }
    public function store(Request $request)
    {
        // return ;
        if (Auth::user()->permission->general->productsadd) {

            $validate = Validator::make($request->all(), [
                'cid' => 'nullable',
                'scid' => 'nullable',
                'bid' => 'nullable',
                'uomid' => 'nullable',

                'name' => 'required|max:255',
                'desc' => 'nullable',
                'attribute' => 'nullable',
                'tags' => 'nullable',

                'sku' => 'nullable',
                'barcode' => 'nullable',
                'trackqty' => 'nullable|boolean',
                'oosc' => 'nullable|boolean',

                'length' => 'nullable|numeric',
                'width' => 'nullable|numeric',
                'breadth' => 'nullable|numeric',
                'weight' => 'nullable|numeric',
                // |min:0.5
                'cpi' => 'nullable',
                'fprice' => 'nullable',
                'margin' => 'nullable',
                'profit' => 'nullable|',
                'taxp' => 'nullable',
                'disp' => 'nullable',
                'fpricewtas' => 'nullable',

                'stock' => 'nullable|numeric',

                'seo_title' => 'nullable',
                'seo_desc' => 'nullable',

                'loc' => 'required|mimes:jpeg,png,jpg,gif,svg,webp|max:5120',
            ], [
                'cid.required' => 'Category is Required',
                'bid.required' => 'Brand is Required',
                'uomid.required' => 'Unit of Measure is Required',
                'name.required' => 'Please enter the Name',

                'length.required' => 'Please enter the Length',
                'width.required' => 'Please enter the Width',
                'breadth.required' => 'Please enter the Breadth',
                'weight.required' => 'Please enter the Weight',

                'length.min' => 'Minimum value of Length is 0.5',
                'width.min' => 'Minimum value of Width is 0.5',
                'breadth.min' => 'Minimum value of Breadth is 0.5',
                'weight.min' => 'Minimum value of Weight is 0.5',

                'length.numeric' => 'Length must be a integer',
                'width.numeric' => 'Width must be a integer',
                'breadth.numeric' => 'Breadth must be a integer',
                'weight.numeric' => 'Weight must be a integer',

                'name.required' => 'Please enter the Name',
                'sku.required' => 'Please enter the SKU',
                'trackqty.boolean' => 'Track QTY must be a option',
                'oosc.boolean' => 'Continue after out of stock must be a option',


                'cpi.numeric' => 'Cost per item must be a number',
                'fprice.numeric' => 'Cost per item must be a number',
                'margin.numeric' => 'Margin must be a number',
                'profit.numeric' => 'Profit must be a number',
                'taxp.numeric' => 'Tax % must be a number',
                'disp.numeric' => 'Discount % must be a number',
                'fpricewtas.numeric' => 'Final Price must be a number',
                'stock.numeric' => 'Stock must be a number',

                'loc.required' => 'Please upload the image',
                'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
                'loc.max' => 'Image Size Mus be maximum 5 mb',
            ]);

            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }
            // return $request;

            $data = new Products;
            $data->bid = $request->bid ?? 0;
            $data->cid = $request->cid ?? 0;
            $data->scid = $request->scid ?? 0;
            $data->uomid = $request->uomid ?? 0;
            $data->packingid = $request->packingid ?? 0;
            $data->name = $request->name;
            $data->urlslug =implode('-',explode(' ',$request->name));
            $data->desc = $request->desc;
            $data->shortdesc=$request->shortdesc;
            $data->attribute = $request->attribute;
            $data->tags = json_decode($request->tags);

            $data->sku = $request->sku;
            $data->barcode = $request->barcode;
            $data->trackqty = $request->trackqty ?? 0;
            $data->oosc = $request->oosc ?? 0;

            $data->cpi = $request->cpi ?? 0;
            $data->fprice = $request->price;
            $data->taxp = $request->taxp;
            $data->margin = $request->margin??0;
            $data->profit = $request->profit??0;
            $data->taxp = $request->taxp??0;
            $data->taxa = $request->taxa??0;
            $data->disp = $request->disp??0;
            $data->disa = $request->disa??0;
            $data->actualprice=$request->actualprice;
            $data->fpricewtas=$request->fpricewtas;
            $data->fpricebefdis=$request->fpricebefdis;


            if($request->disp>0){
                $data->disid=-1;
            }


            $data->length = $request->length;
            $data->width = $request->width;
            $data->breadth = $request->breadth;
            $data->lunit = $request->lunit;

            $data->weight = $request->weight;
            $data->wgunit = $request->wgunit;
            $data->stock = $request->stock;
            $data->minstock = $request->minstock??0;
            $data->seo_title = $request->seo_title;
            $data->seo_desc = $request->seo_desc;
            $data->status = $request->status;
            $data->save();
            $xdata = new ProductImage();
            $xdata->pid = $data->id;
            while (1) {
                $strrand = Str::random(16);
                if (!$xdata->loc) {
                    $image = $request->file('loc');
                    $clext = $image->getClientOriginalExtension();
                    if (!Storage::disk('public')->has('products/' . $strrand . '.' . $clext)) {
                        $newfilename = $data->id . '/' . $strrand . "." . $clext;
                        Storage::disk('public')->put('products/' . $newfilename, File::get($image));
                        $xdata->loc = 'storage/products/' . $newfilename;
                    }
                }
                if ($xdata->loc) {
                    break;
                }
            }
            $xdata->save();




            $logdata = new Logger();
            $logdata->addLog(0, 'Products', null, $data);

            $request->session()->flash('status', 'Added Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/products/view/' . encrypt($data->id));
    }

    public function storephoto(Request $request, $id)
    {

        $xdata = new ProductImage();
        $pid = decrypt($id);
        $xdata->pid = $pid;
        while (1) {
            $strrand = Str::random(16);
            if (!$xdata->loc) {
                $image = $request->file('file');
                $clext = $image->getClientOriginalExtension();
                if (!Storage::disk('public')->has('products/' . $strrand . '.' . $clext)) {
                    $newfilename = $pid . '/' . $strrand . "." . $clext;
                    Storage::disk('public')->put('products/' . $newfilename, File::get($image));
                    $xdata->loc = 'storage/products/' . $newfilename;
                }
            }
            if ($xdata->loc) {
                break;
            }
        }
        $xdata->save();
        return response()->json(['success' => 'You have successfully upload file.']);
    }

    public function deletephoto(Request $request)
    {

        $data = ProductImage::find($request->id);
        File::delete($data->loc);
        $data->delete();
        return 1;
    }

    public function show($id, Request $request)
    {
        if (Auth::user()->permission->general->productsview) {

            try {
                $data = Products::find(decrypt($id));
                if ($data) {
                    return view('Admin.Products/view', ['data' => $data]);
                } else {
                    $request->session()->flash('error', 'Sorry Products not found');
                }
            } catch (DecryptException $e) {
                $request->session()->flash('error', 'Please refresh page');
            }
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/products');
    }
    public function edit($id, Request $request)
    {
        if (Auth::user()->permission->general->productsedit) {
            $data = Products::find(decrypt($id));
            $category = Category::select('id', 'name')->with('subcategory')->get();
            $brand = Brand::where('status',1)->select('id', 'name')->get();
            $tags = Tags::pluck('name');
            $uom = UOM::select('id', 'name')->get();
            $attribute = Attribute::select('id', 'name')->get();
            $packing = Packing::select('id', 'name')->get();
            return view('Admin.Products/edit', [
                'category' => $category,
                'data' => $data,
                'brand' => $brand,
                'tags' => $tags,
                'uom' => $uom,
                'attribute' => $attribute,
                'packing' => $packing,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
            return redirect('/admin/products');
        }
    }
    public function update(Request $request, $id)
    {
        // return $request;
        if (Auth::user()->permission->general->productsedit) {

            $validate = Validator::make($request->all(), [
                'cid' => 'nullable',
                'scid' => 'nullable',
                'bid' => 'nullable',
                'uomid' => 'nullable',

                'name' => 'required|max:255',
                'desc' => 'nullable',
                'attribute' => 'nullable',
                'tags' => 'nullable',

                'sku' => 'nullable',
                'barcode' => 'nullable',
                'trackqty' => 'nullable|boolean',
                'oosc' => 'nullable|boolean',

                'length' => 'nullable|numeric',
                'width' => 'nullable|numeric',
                'breadth' => 'nullable|numeric',
                'weight' => 'nullable|numeric',
                // |min:0.5
                'cpi' => 'nullable',
                'fprice' => 'nullable',
                'margin' => 'nullable',
                'profit' => 'nullable|',
                'taxp' => 'nullable',
                'fpricewtas' => 'nullable',

                'stock' => 'nullable|numeric',

                'seo_title' => 'nullable',
                'seo_desc' => 'nullable',

            ], [
                'cid.required' => 'Category is Required',
                'bid.required' => 'Brand is Required',
                'uomid.required' => 'Unit of Measure is Required',
                'name.required' => 'Please enter the Name',

                'length.required' => 'Please enter the Length',
                'width.required' => 'Please enter the Width',
                'breadth.required' => 'Please enter the Breadth',
                'weight.required' => 'Please enter the Weight',

                'length.min' => 'Minimum value of Length is 0.5',
                'width.min' => 'Minimum value of Width is 0.5',
                'breadth.min' => 'Minimum value of Breadth is 0.5',
                'weight.min' => 'Minimum value of Weight is 0.5',

                'length.numeric' => 'Length must be a integer',
                'width.numeric' => 'Width must be a integer',
                'breadth.numeric' => 'Breadth must be a integer',
                'weight.numeric' => 'Weight must be a integer',

                'name.required' => 'Please enter the Name',
                'sku.required' => 'Please enter the SKU',
                'trackqty.boolean' => 'Track QTY must be a option',
                'oosc.boolean' => 'Continue after out of stock must be a option',


                'cpi.numeric' => 'Cost per item must be a number',
                'fprice.numeric' => 'Cost per item must be a number',
                'margin.numeric' => 'Margin must be a number',
                'profit.numeric' => 'Profit must be a number',
                'taxp.numeric' => 'Tax % must be a number',
                'fpricewtas.numeric' => 'Final Price must be a number',
                'stock.numeric' => 'Stock must be a number',

                'loc.required' => 'Please upload the image',
                'loc.mimes' => 'Please upload the image as jpeg,png,jpg,gif,svg,webp',
                'loc.max' => 'Image Size Mus be maximum 5 mb',
            ]);
            if ($validate->fails()) {
                return back()->withInput()->withErrors($validate);
            }


            $data = Products::find(decrypt($request->id));

            $olddata=$data;
            $data->bid = $request->bid ?? 0;
            $data->cid = $request->cid ?? 0;
            $data->scid = $request->scid ?? 0;
            $data->packingid = $request->packingid ?? 0;
            $data->uomid = $request->uomid ?? 0;

            $data->shortdesc=$request->shortdesc;
            $data->name = $request->name;
            $data->urlslug =implode('-',explode(' ',$request->name));
            $data->desc = $request->desc;
            $data->attribute = $request->attribute;
            $data->tags = json_decode($request->tags);

            $data->sku = $request->sku;
            $data->barcode = $request->barcode;
            $data->trackqty = $request->trackqty ?? 0;
            $data->oosc = $request->oosc ?? 0;

            $data->cpi = $request->cpi ?? 0;
            $data->fprice = $request->price;
            $data->taxp = $request->taxp;
            $data->margin = $request->margin??0;
            $data->profit = $request->profit??0;
            $data->taxp = $request->taxp??0;
            $data->taxa = $request->taxa??0;
            $data->disp = $request->disp??0;
            $data->disa = $request->disa??0;
            $data->actualprice=$request->actualprice;
            $data->fpricewtas=$request->fpricewtas;
            $data->fpricebefdis=$request->fpricebefdis;


            if($request->disp>0 && $data->disid==0){
                $data->disid=-1;
            }
            else if($data->disid==-1 && $request->disp==0){
                $data->disid=0;
            }


            $data->length = $request->length;
            $data->width = $request->width;
            $data->breadth = $request->breadth;
            $data->lunit = $request->lunit;

            $data->weight = $request->weight;
            $data->wgunit = $request->wgunit;
            $data->stock = $request->stock;
            $data->minstock = $request->minstock??0;
            $data->seo_title = $request->seo_title;
            $data->seo_desc = $request->seo_desc;
            $data->status = $request->status;
            $data->save();


            if ($data->getChanges()) {
                $logdata = new Logger();
                $logdata->addLog(1, 'Products', $olddata, json_encode($data->getChanges()));
            }


            $request->session()->flash('status', 'Edited Succesfully');
        } else {
            $request->session()->flash('error', 'Sorry you dont have permission');
        }
        return redirect('/admin/products/view/' . encrypt($data->id));
    }
    public function destroy(Request $request, $id)
    {
        if (Auth::user()->permission->general->productsdel) {

            $data = Products::find(decrypt($id));
            $logdata = new Logger();
            $logdata->addLog(2, 'Products', null, $data);

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
        return redirect('/admin/products');
    }

    public function inventory(Request $request)
    {
        $data = Products::select('id', 'name', 'stock', 'trackqty', 'oosc');
        if ($request->name) {
            $data = $data->where('name', 'LIKE', '%' . $request->name . '%');
        }
        if ($request->selected = 1) {
            $data = $data->orderBy('stock', 'asc');
        } else if ($request->selected = 2) {
            $data = $data->orderBy('stock', 'desc');
        }
        $data = $data->get();
        return view('Admin.Products/inventory', [
            'data' => $data
        ]);
    }
    public function bulkupdatecreate(){
        $data=Products::select('id','name','stock','fpricewtas','taxp')->orderBy('name','asc')->get();
        return view('Admin.Products.bulkstock',['data'=>$data]);
    }
    public function bulkupdatestore(Request $request){
        // return $request;
        $prodid=explode(',',$request->prodid);
        $stock=explode(',',$request->stock);
        $price=explode(',',$request->price);

        for($i=0;$i<count($prodid);$i++){
            $data=Products::find($prodid[$i]);
            $data->stock=$stock[$i];

            $tempprice = round(($price[$i]*100)/(100+$data->taxp),2);



            if ($data->disp > 0) {
                $dispval = round($tempprice * $data->disp / 100, 2);
                $data->disa = $dispval;
                $tempprice = $tempprice - $dispval;
            }
            $profit = $tempprice - $data->cpi;
            if($tempprice){
                $margin = round(($profit / $tempprice) * 100, 2);
            }
            else{
                $margin=0;
            }

            $taxdisa = round(($tempprice * $data->taxp) / 100, 2);
            $taxa = round(($data->fprice * $data->taxp) / 100, 2);

            $data->margin = $margin;
            $data->profit = $profit;

            $data->taxa = $taxdisa;
            $data->fpricewtas = $tempprice = $price[$i]; - $data->disa;
            if($data->disp==0){
                $data->fpricebefdis = 0;
            }
            else{
                $data->fpricebefdis = $data->fprice + $taxa;
            }
            $data->actualprice=$tempprice = $price[$i];;

            $data->save();
        }
            $request->session()->flash('status', 'Updated Succesfully');
            return redirect('/admin/products/bulkupdate');
    }
}
