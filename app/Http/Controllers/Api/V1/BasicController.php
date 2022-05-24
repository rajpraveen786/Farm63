<?php

namespace App\Http\Controllers\Api\V1;

use App\CustomerInteraction;
use App\Http\Controllers\Controller;
use App\Mail\NewRegistrationOTP;
use App\Model\Address;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\CMS as ModelCMS;
use App\Model\CustomerProductView;
use App\Model\Orders;
use App\Model\OrdersSub;
use App\Model\OTP;
use App\Model\Products;
use App\Model\PromoCode;
use App\Model\SubCategory;
use App\Model\WishList;
use App\PagesCollections;
use Illuminate\Http\Request;
use Validator;
use DB;
use Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Str;

class BasicController extends Controller
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

    public static function productwithreview(){
        $data= Products::
        with('review')->
        select(
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
    public function basicproducts()
    {
        $data = Products::select(
            'id',
            'name',
            'created_at',
            'disp',
            'disa',
            'fpricewtas',
            'fpricebefdis',
            'status',
            'oosc',
            'stock'
        )
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhere('oosc', 1);
            })
            ->where('status', 1)
            ->with('image');

        return $data;
    }
    public function brandinit()
    {
        $data = Brand::where('status', 1)->select('id', 'name', 'loc');
        return $data;
    }
    public function categoryinit()
    {
        $data = Category::where('status', 1)->select('id', 'name', 'loc');
        return $data;
    }

    public function subcatsearch($name)
    {
        return SubCategory::where('name', 'LIKE', '%' . $name . '%')->select('id', 'name', 'cid')->get();
    }
    public function catsearch($name, $sub)
    {
        $data = Category::select('id', 'name')->with('subcategory')
            ->where('name', 'LIKE', '%' . $name . '%')
            ->orWhereIn('id', $sub)->get();
        return $data;
    }
    public function brandsearch($name)
    {
        return Brand::where('status', 1)->where('name', 'LIKE', '%' . $name . '%')->get();
    }



    /**
     * @group General
     * Welcome Page
     * @response 200 {
     *  "success": true,
     *  "message": "Fetched Data",
     *  "data": {
     *      banner:[
     *          {
     *              name:'',
     *              desc:'',
     *              name:'',
     *              name:'',
     *          }
     *      ],
     *      category:[],
     *      brand:[]
     *      topselling:[],
     *
     *      trendingproducts:[],
     * },
     * @response 401 {
     *  "success": false,
     *  "message": "Unable to Logout",
     * }
     */
    public function welcome()
    {
        $xdata = [];
        $xdata['banner'] = Banner::select('name', 'desc', 'link', 'loc')->get();
        $xdata['category'] = $this->categoryinit()->with('subcategory')->take(7)->get();
        $xdata['brand'] = $this->brandinit()->withCount('products')->orderBy('products_count', 'desc')->take(8)->get();
        $xdata['combo'] = $this->productinitreview()->where('name','LIKE','%combo%')->take(7)->get();;
        $xdata['pagescollection'] = PagesCollections::where('name','Home Page')->first();
        // $datasub = OrdersSub::select('pid', DB::raw('count(*) as total'));
        // $xdata['topselling']=$this->productwithreview()
        // ->whereIn('products.id', $datasub)
        // ->take(7)
        // ->get();

        $custinter=CustomerInteraction::where('type','prodview')->distinct('data')->orderBy('created_at','desc')->pluck('data');
        $xdata['trendingproducts']=$this->productwithreview()
        ->whereIn('products.id', $custinter)
        ->take(7)
        ->get();

        $xdata['topdeals']=$this->productwithreview()->
        where('disid','!=',0)->
        take(10)->
        orderBy('disp','desc')->get();


        $xdata['catprod']=Category::select('id','name')->withCount('products')->orderBy('products_count', 'DESC')->with('products')->where('homebanner',1)->get();

        $custinter=CustomerInteraction::where('type','prodview')->distinct('data')->orderBy('created_at','desc')->pluck('data');
        $xdata['trendingproducts']=$this->productwithreview()
            ->whereIn('products.id', $custinter)
            ->take(7)
            ->get();
        return response()->json([
            'success' => true,
            'message' => 'Fetched Data',
            'data' => $xdata,
        ], 200);
    }

    /**
     * @group Product
     * Product View
     * @response 401 {
     *  "success": false,
     *  "message": "No Product Found",
     * }
     */
    public function productsview(Request $request, $name)
    {
        $data = $this->productinitreview()->addSelect(
            'desc',
            'attribute',
            'uomid',
            'fpricebefdis',
            'weight',
            'length','width','breadth','taxp','disid',
            'shortdesc',
            'seo_title',
            'seo_Desc',
            )
            ->with('images')
        ->with('brand')
        ->with('uom')
        ->with('category')
        ->with('subcategory')
        ->where('name', $name)
        ->first();;
        $opd = OrdersSub::where('pid', $data->id)->pluck('uid');
            $prods = OrdersSub::whereIn('uid', $opd)->whereNotIn('pid', [$data->id])->orderBy('id', 'desc')->take(24)->pluck('pid');
            $customeralsobought = $this->productinitreview()->whereIn('id', $prods)->get();
        $newproducts = $this->productinitreview()->take(9)->orderBy('created_at', 'desc')->get();
        $productrelatedtoitem = $this->productinitreview()->where('cid', $data->cid)->where('id', '!=', $data->id)->take(12)->get();
        $xdata=[];
        $xdata['customeralsobought'] = $customeralsobought;
        $xdata['newproducts'] = $newproducts;
        $xdata['productrelatedtoitem'] = $productrelatedtoitem;

        if ($data) {
            if ($request->user()) {
                $uid = $request->user()->id;
                $new = CustomerProductView::where('pid', $data->id)->where('uid', $uid)->first();
                if (!$new) {
                    $new = new CustomerProductView();
                    $new->pid = $data->id;
                    $new->uid = $uid;
                    $new->count = 1;
                } else {
                    $new->increment('count');
                }
                $new->save();
            }

            //customer who also bought this Item Also
            $opd = OrdersSub::where('pid', $data->id)->pluck('uid');
            $prods = OrdersSub::whereIn('uid', $opd)->whereNotIn('pid', [$data->id])->orderBy('id', 'desc')->take(24)->pluck('pid');

            $xdata['data'] = $data;
            return response()->json([
                'success' => true,
                'message' => 'Fetched Data',
                'data' => $xdata,
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'No Product Found',
                'data' => $xdata,
            ], 401);
        }
    }




    /**
     * @group Product
     * New Product
     */
    public function newproducts(Request $request)
    {
        $data =  $this->productinitreview()
            ->orderBy('products.created_at', 'desc')
            ->take(20)->get();
        return $data;
    }
    /**
     * @group Product
     * Combo Product
     */
    public function comboproducts(Request $request)
    {
        $data =  $this->productinitreview()
            ->where('name','LIKE','%combo%')
            ->take(20)->get();
        return $data;
    }

    /**
     * @group Product
     * Trending Product
     */
    public function trendingproducts(Request $request)
    {
        $custinter = CustomerInteraction::where('type', 'prodview')->distinct('data')->orderBy('created_at', 'desc')->pluck('data');
        $data =  $this->productinitreview()
            ->whereIn('products.id', $custinter)
            ->orderBy('created_at', 'desc')
            ->take(20)->get();
        return $data;
    }

    /**
     * @group Product
     * Top Selling
     */
    public function topselling(Request $request)
    {

        $datasub = OrdersSub::select('pid', DB::raw('count(*) as total'))
            ->groupBy('pid')->orderBy('total', 'desc')->get();
        $data = $this->productinitreview()
            ->orderBy(
                'created_at',
                'desc'
            )
            ->whereIn('id', $datasub->pluck('pid'))
            ->take(20)->get();
        return $data;
    }

    /**
     * @group General
     * Brand
     */
    public function brand(Request $request){
        return $this->brandinit()->get();
    }

    /**
     * @group General
     * Category
     */
    public function category(Request $request){
        return $this->categoryinit()->get();
    }
    /**
     * @group Profile - Cart
     * List
     */
    public function cartlist(Request $request){
        $pid = Cart::where('uid', $request->user()->id)->pluck('pid');
        $datax['data'] = Products::
        select(
            'products.id as id',
            'name',
            'fpricewtas',
            'fprice',
            'cid',
            'products.status as status',
            'products.bid as bid',
            'stock',
            'disp',
            'fpricebefdis',
            'disid',
            'disa',
            'taxp',
            'taxa',
            'oosc',
            'trackqty',
            )->with('image')
            ->with('category')
            ->with(['cart' => function ($query) use($request) {
                    $query->where('uid', $request->user()->id);
            }])
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhere('oosc', 1);
            })->where('status',1)->whereIn('id', $pid)->with('discounts')->get();


            $buyagain = OrdersSub::where('uid', $request->user()->id)->pluck('pid');
            $datax['buyagain'] = Products::with(['cart' => function ($query) use($request) {
                    $query->where('uid', $request->user()->id);
                }])->with('image')->where('status',1)->select('id', 'name', 'disid', 'bid', 'cid','status','fprice', 'taxa', 'taxp', 'disp', 'disa', 'fpricewtas', 'weight', 'wgunit', 'oosc', 'stock','fpricebefdis')
                ->where(function ($q) {
                    $q->where('stock', '>', 0)
                        ->orWhere('oosc', 1);
                })->whereIn('id', $buyagain)->with('discounts')->get();



        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $datax,
        ], 200);
    }


      /**
     * @group Profile - Cart
     * Add to Cart
     * @bodyParam uid string User id
     * @bodyParam pid string Product id
     * @bodyParam qty string Quantity
     * @response 200 {
     *  "success": true,
     *  "title": "",
     *  "message": "",
     *  "data": {}
     *
     * }
     * @response 400 {
     *  "success": false,
     *  "title": "",
     *  "message": "",
     *  "data": {}
     * }
     */

    public function cartsave(Request $request)
    {
        $uid=$request->user()->id;
        $data = Cart::where('uid', $uid)->where('pid', $request->pid)->first();

        if ($data) {
            $data->qty=$data->qty+1;
            $data->save();
            return response()->json([
                'success' => false,
                'title' => 'Oopss',
                'message' => 'Already '.$data->qty.' items are in cart',
            ], 200);
        }
        else {
            $data = new Cart;
            $data->uid = $uid;
            $data->pid = $request->pid;
            $data->qty = $request->qty;
            $data->save();

            return response()->json([
                'success' => true,
                'title' => 'Hurrey',
                'message' => 'Added to Cart Successfully.',
            ], 200);
        }
        return 0;
    }
    /**
   * @group Profile - Cart
   * Remove from cart
   * @bodyParam uid string User id
   * @bodyParam pid string Product id
   * @bodyParam qty string Quantity
   * @response 200 {
   *  "success": true,
   *  "title": "",
   *  "message": "",
   *  "data": {}
   *
   * }
   * @response 400 {
   *  "success": false,
   *  "title": "",
   *  "message": "",
   *  "data": {}
   * }
   */



    public function destroy(Request $request)
    {
        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => Cart::where('pid', $request->pid)->where('uid', $request->user()->id)->delete()
        ], 200);
    }
    /**
     * @group Profile - Wishlist
     * List
     */
    public function wishlist(Request $request){
        $uid=$request->user()->id;
        $data = WishList::where('uid', $uid)->pluck('pid');

        $wishlist = Products::select('id', 'name','bid', 'fpricewtas', 'fpricebefdis', 'created_at', 'cid', 'bid', 'status', 'oosc', 'stock')
        ->whereHas('wishlist', function($q) use($uid){
            $q->where('uid', $uid);
        })
        ->where(function ($q) {
            $q->where('stock', '>', 0)
                ->orWhere('oosc', 1);
        })->with('brand')
        ->where('status', 1)->with('category')->with('brand')->with('wishlist')->with('image')->whereIn('id', $data)->paginate(20);



        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $wishlist,
        ], 200);
    }
    /**
     * @group Checkout
     * PromoCode
     * @bodyParam name string PromoCode
     * @response 200 {
     *  "success": true,
     *  "title": "Hurrey",
     *  "message": "We are there to service",
     *  "data": {}
     * }
     * @response 200 {
     *  "success": false,
     *  "title": "Sorry",
     *  "message": "We dont serve the selected pincode.",
     *  "data": {}
     * }
     */
    public function getpromocode(Request $request){
        $data=PromoCode::where('code',$request->name)
        ->where('status',1)
        ->orderBy('id','desc')
        ->first();

        $x=[];
        $x['success']=1;
        if($data){
            if($data->oneuse){
                $csub=Orders::where('pid',$data->id)->where('uid',$request->user()->id)->count();
                if($csub!=0){
                    $x['success']=0;
                    $x['title']='Already Used';
                    $x['messsage']='PromoCode already used';
                    return $x;
                }
            }
            if($data->noofuse>0){
                $csub=Orders::where('pid',$data->id)->count();
                if($csub>=$data->noofuse){
                    $x['success']=0;
                    $x['title']='PromoCode Expired';
                    $x['message']='PromoCode has expired';
                    return $x;
                }
            }
            $x['data']=$data;
        }
        else{
            $x['success']=0;
            $x['title']='Invalid PromoCode';
            $x['message']='Sorry No Valid PromoCode';
        }
        return $x;
    }


    /**
     * @group Checkout
     * Address
     */
    public function getaddress(Request $request){
        $data=Address::where('uid',$request->user()->id)->with('costaddress')->get();
        $x=[];
        $x['success']=1;
        $x['title']='';
        $x['message']='';
        $x['data']=$data;
        return $x;
    }




    /**
     * @group Policies
     * Terms and Condition
     */
    public function termsandcondition(Request $request){
        $data = ModelCMS::where('name', 'tandc')->first();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }
    /**
     * @group Policies
     * Shipping
     */
    public function shippingpolicy(Request $request){
        $data = ModelCMS::where('name', 'shipping')->first();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }
    /**
     * @group Policies
     * Refund Policy
     */
    public function refundpolicy(Request $request){
        $data = ModelCMS::where('name', 'refund')->first();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }
    /**
     * @group Policies
     * Privacy Policy
     */
    public function privacypolicy(Request $request){
        $data = ModelCMS::where('name', 'privacy')->first();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }
    /**
     * @group Policies
     * FAQ
     */
    public function faq(Request $request){
        $data = ModelCMS::where('name', 'faq')->first();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }
    /**
     * @group Policies
     * About Us
     */
    public function aboutus(Request $request){
        $data = ModelCMS::where('name', 'aboutus')->first();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }
    /**
     * @group Policies
     * Return Policy
     */
    public function returnpolicy(Request $request){
        $data = ModelCMS::where('name', 'return')->first();
        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ], 200);
    }





}
