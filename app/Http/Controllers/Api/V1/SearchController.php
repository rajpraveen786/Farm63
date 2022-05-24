<?php

namespace App\Http\Controllers\Api\V1;

use App\CustomerInteraction;
use App\Http\Controllers\Controller;
use App\Model\Brand;
use App\Model\Category;
use App\Model\Products;
use App\Model\SubCategory;
use Illuminate\Http\Request;

class SearchController extends Controller
{



    public function productinitreview()
    {
        $data = Products::with('review')->select(
                'products.id as id',
                'name',
                'products.created_at as created_at',
                'fpricewtas',
                'cid',
                'scid',
                'products.status as status',
                'products.bid as bid',
                'stock',
                'disp',
                'fpricebefdis',
                'disa',
                'packingid',
                'tags',
                'oosc',
                'trackqty',
                'products.status as status',
            )->with('image')
            ->with('category')
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhere('oosc', 1);
            })
            ->where('products.status', 1)
            ->whereNotNull('products.id')
            ->distinct('products.id');

        return $data;
    }
    /**
     * @group Search
     * Search Request
     * @bodyParam name string NAme to be searched
     * @response 200 {
     *  "success": true,
     *  "data": [],
     *  "brand": [],
     *  "category": [],
     *
     */

    public function subcatsearch($name){
        return SubCategory::where('name', 'LIKE', '%' . $name . '%')->select('id', 'name', 'cid')->get();
    }
    public function catsearch($name,$sub){
        $data= Category::select('id', 'name')->with('subcategory')
                ->where('name', 'LIKE', '%' . $name . '%')
                ->orWhereIn('id', $sub)->get();
            return $data;
    }
    public function brandsearch($name){
        return Brand::where('status',1)->where('name', 'LIKE', '%' . $name . '%')->get();
    }
    public function search(Request $request)
    {
        $subcat =$this->subcatsearch($request->name);
        $category =$this->catsearch($request->name,$subcat->pluck('id')??[]);
        $brand = $this->brandsearch($request->name);
        if ($request->user()) {
            $uid = $request->user()->id;
            $new = new CustomerInteraction();
            $new->data = $request->name;
            $new->type = 'search';
            $new->uid = $uid;
            $new->save();
        }
        $name=explode(' ',$request->name);
        $data = BasicController::productwithreview()
        ->orderBy('name','asc')
            ->where(function ($q) use ($name){
                foreach($name as $taags){
                    $q->where('name', 'LIKE', '%' . $taags . '%')
                    ->orwhere('tags', 'LIKE', '%' . $taags . '%');
                }

            })
            ->orWhereIn('cid', $category->pluck('id'))
            ->orWhereIn('scid', $subcat->pluck('id'))
            ->orWhereIn('products.bid', $brand->pluck('id'));

        $category=Category::select('id', 'name')->orderBy('name','asc')->with('subcategory')->whereIn('id',$data->pluck('cid'))->get();
        $brand=Brand::where('status',1)->orderBy('name','asc')->select('id', 'name')->whereIn('id',$data->pluck('bid'))->get();


        $data = $data->take(15)->get();
        return response()->json([
            'success' => true,
            'title' => 'Success',
            'message' => '',
            'data' => $data,
            'category' => $category,
            'brand' => $brand,
            'searchname' => $request->name,
        ], 200);
    }





    /**
     * @group Search
     * Brand Request
     * @bodyParam name string NAme to be searched
     * @response 200 {
     *  "success": true,
     *  "data": [],
     *  "brand": [],
     *  "category": [],
     *
     */
    public function brand(Request $request)
    {
        $brand = Brand::where('status',1)->where('name', $request->name)->first();
        if ($brand) {
            $data = $this->productwithreview()
            ->orderBy('name','asc')
            ->where('bid',$brand->id)
            ->paginate(20);
            $category = Category::whereIn('id', $data->pluck('cid'))->orderBy('name','asc')->with('subcategory')->get();
            if ($request->user()) {
                $uid = $request->user()->id;
                $new = new CustomerInteraction();
                $new->data = $request->name;
                $new->type = 'search';
                $new->uid = $uid;
                $new->save();
            }

            return response()->json([
                'success' => true,
                'title' => 'Success',
                'message' => '',
                'data' => $data,
                'category' => $category,
                'brand' => $brand,
                'searchname' => $request->name,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'title' => 'Success',
                'message' => '',
                'data' => [],
                'category' => [],
                'brand' => [],
                'searchname' => [],
            ], 200);
        }
    }


    /**
     * @group Search
     * Category Request
     * @bodyParam name string NAme to be searched
     * @response 200 {
     *  "success": true,
     *  "data": [],
     *  "brand": [],
     *  "category": [],
     *
     */
    public function category(Request $request)
    {
        $category=Category::with('subcategory')->find($request->id);
        if ($category) {

            $data = BasicController::productwithreview()
            ->where('cid',$category->id);

            if ($request->newarrival >= 1 && $request->newarrival == 1) {
                $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-30days')));
            } else if ($request->newarrival >= 1 && $request->newarrival == 2) {
                $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-60days')));
            }


            if ($request->pricerange >= 1) {
                $this->pricerangefilter($data,$request->pricerange);
            }

            if ($request->todaydeal) {
                $data = $data->where('fpricewtas', '>', 0);
            }
            if (in_array('id',$request->orderfil??[])) {
                $data = $data->orderby($request->orderfil['id']??'id',$request->orderfil['ordby']??'desc');
            }

            $data = $data->paginate(20);

            if ($request->user()) {
                $uid = $request->user()->id;
                $new = new CustomerInteraction();
                $new->data = $request->name;
                $new->type = 'category';
                $new->uid = $uid;
                $new->save();
            }

            return response()->json([
                'success' => true,
                'title' => 'Success',
                'message' => '',
                'data' => $data,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'title' => 'Success',
                'message' => '',
                'data' => [],
                'category' => [],
                'brand' => [],
                'searchname' => [],
            ], 200);
        }
    }





    /**
     * @group Search
     * Hot Deals Request
     * @bodyParam name string NAme to be searched
     * @response 200 {
     *  "success": true,
     *  "data": [],
     *  "brand": [],
     *  "category": [],
     *
     */
    public function hotdeals(Request $request)
    {
        $data = BasicController::productwithreview()->where('disid','!=',0)
        ->orderBy('name','asc');
        $category=Category::select('id', 'name')->orderBy('name','asc')->with('subcategory')->whereIn('id',$data->pluck('cid'))->get();
        $brand=Brand::where('status',1)->orderBy('name','asc')->select('id', 'name')->whereIn('id',$data->pluck('bid'))->get();
        $data = $data->take(15)->get();

            return response()->json([
                'success' => true,
                'title' => 'Success',
                'message' => '',
                'data' => $data,
                'category' => $category,
                'brand' => $brand,
                'searchname' => $request->name,
            ], 200);
    }
}
