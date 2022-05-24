<?php

namespace App\Http\Controllers;

use App\CustomerInteraction;
use App\Model\Banner;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\CMS;
use App\Model\ContactUs as ModelContactUs;
use App\Model\Discounts;
use App\Model\OrdersSub;
use App\Model\PinCode;
use App\Model\Products;
use App\Model\SEO;
use App\Model\SubCategory;
use App\PagesCollections;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\DB;

use Artesaos\SEOTools\Facades\SEOTools;
use Illuminate\Support\Facades\Auth as FacadesAuth;
use Mpociot\Reflection\DocBlock\Tag\ReturnTag;
use Razorpay\Api\Api;

class Pages extends Controller
{
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
    public function mssearch(Request $request)
    {
        $subcat = $this->subcatsearch($request->searchname);
        $category = $this->catsearch($request->searchname, $subcat->pluck('id') ?? []);
        $brand = $this->brandsearch($request->searchname);


        $cat = $request->category ?? [];
        $subcat = $request->subcategory ?? [];
        $brandsel = $request->brand ?? [];


        if (Auth::check()) {
            $uid = Auth::user()->id;
            $new = new CustomerInteraction;
            $new->data = $request->searchname;
            $new->type = 'search';
            $new->uid = $uid;
            $new->save();
        }
        $name = explode(' ', $request->searchname);
        $data = $this->productwithreview()
            ->orderBy('name', 'asc');
        if ($request->searchname) {
            $data = $data->where(function ($q) use ($name) {
                foreach ($name as $taags) {
                    $q->where('name', 'LIKE', '%' . $taags . '%');
                }
            });
            if (count($category) > 0) {
                $data = $data->orWhereIn('cid', $category->pluck('id'));
            }
            if (count($subcat) > 0) {
                $data = $data->orWhereIn('scid', $subcat->pluck('id'));
            }
            if (count($brand) > 0) {
                $data = $data->orWhereIn('bid', $brand->pluck('id'));
            }
        }

        if ($request->tags) {
            $data = $data->where('tags', 'LIKE', '%' . $request->tags . '%');
        }
        $category = Category::select('id', 'name')->with('subcategory')->orderBy('name', 'asc')->whereIn('id', $data->pluck('cid'))->get();
        $brand = Brand::where('status', 1)->select('id', 'name')->orderBy('name', 'asc')->whereIn('id', $data->pluck('bid'))->get();




        if (count($cat) > 0) {
            $data = $data->whereIn('cid', $cat);
        }
        if (count($brandsel) > 0) {
            $data = $data->whereIn('bid', $brandsel);
        }

        if ($request->newarrival >= 1 && $request->newarrival == 1) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-30days')));
        } else if ($request->newarrival >= 1 && $request->newarrival == 2) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-60days')));
        }

        if ($request->pricerange >= 1) {
            $this->pricerangefilter($data, $request->pricerange);
        }
        if ($request->discountrange >= 1) {
            $this->discountrangefilter($data, $request->discountrange);
        }

        if ($request->todaydeal) {
            $data = $data->where('fpricewtas', '>', 0);
        }
        $data = $data->orderby($request->orderfil['id'] ?? 'id', $request->orderfil['ordby'] ?? 'desc');


        $data = $data->paginate(20);
        // return $request->apidata;
        if ($request->api) {
            return $data;
        }
        return view('Pages/search', [
            'data' => $data,
            'category' => $category,
            'brand' => $brand,
            'searchname' => $request->searchname,
        ]);
    }


    /**
     * @group Search Data
     *  Search Data
     * @bodyParam brand array selected brand
     * @bodyParam category array selected category
     * @bodyParam subcategory array selected subcategory
     * @bodyParam newarrival integer  New Arrival 1 - 30 days and 2 - 60 days
     * @response 200 {
     *  "success": true,
     *  "message": "Fetched Data",
     *  "data": [{
     *              Products ....
     *          }]
     *      * },
     * @response 401 {
     *  "success": false,
     *  "message": "Sorry",
     * }
     */
    public function mssearchdata(Request $request)
    {

        $subcat = $this->subcatsearch($request->searchname);
        $category = $this->catsearch($request->searchname, $subcat->pluck('id') ?? []);
        $brand = $this->brandsearch($request->searchname);


        $cat = $request->category ?? [];
        $subcat = $request->subcategory ?? [];
        $brandsel = $request->brand ?? [];


        if (Auth::check()) {
            $uid = Auth::user()->id;
            $new = new CustomerInteraction;
            $new->data = $request->searchname;
            $new->type = 'search';
            $new->uid = $uid;
            $new->save();
        }
        $name = explode(' ', $request->searchname);
        $data = $this->productwithreview()
            ->orderBy('name', 'asc');
        if ($request->searchname) {
            $data = $data->where(function ($q) use ($name) {
                foreach ($name as $taags) {
                    $q->where('name', 'LIKE', '%' . $taags . '%');
                }
            });
            if (count($category) > 0) {
                $data = $data->orWhereIn('cid', $category->pluck('id'));
            }
            if (count($subcat) > 0) {
                $data = $data->orWhereIn('scid', $subcat->pluck('id'));
            }
            if (count($brand) > 0) {
                $data = $data->orWhereIn('bid', $brand->pluck('id'));
            }
        }

        if ($request->tags) {
            $data = $data->where('tags', 'LIKE', '%' . $request->tags . '%');
        }

        if (count($cat) > 0) {
            $data = $data->whereIn('cid', $cat);
        }
        if (count($brandsel) > 0) {
            $data = $data->whereIn('bid', $brandsel);
        }

        if ($request->newarrival >= 1 && $request->newarrival == 1) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-30days')));
        } else if ($request->newarrival >= 1 && $request->newarrival == 2) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-60days')));
        }

        if ($request->pricerange >= 1) {
            $this->pricerangefilter($data, $request->pricerange);
        }
        if ($request->discountrange >= 1) {
            $this->discountrangefilter($data, $request->discountrange);
        }

        if ($request->todaydeal) {
            $data = $data->where('fpricewtas', '>', 0);
        }
        $data = $data->orderby($request->orderfil['id'] ?? 'id', $request->orderfil['ordby'] ?? 'desc');


        $data = $data->paginate(20);
        return $data;
    }


    public function mshotdeals(Request $request)
    {
        $data = $this->productwithreview()->where('disid', '!=', 0)
            ->orderBy('name', 'asc');

        $category = Category::select('id', 'name')->with('subcategory')->orderBy('name', 'asc')->whereIn('id', $data->pluck('cid'))->get();
        $brand = Brand::where('status', 1)->select('id', 'name')->orderBy('name', 'asc')->whereIn('id', $data->pluck('bid'))->get();

        $data = $data->paginate(15);
        return view('Pages.Hotdeals', [
            'data' => $data,
            'category' => $category,
            'brand' => $brand,
            'searchname' => $request->searchname,
        ]);
    }
    public function mshotdealsdata(Request $request)
    {
        $cat = $request->category ?? [];
        $subcat = $request->subcategory ?? [];
        $brandsel = $request->brand ?? [];


        $data = $this->productwithreview()->where('disid', '!=', 0);

        if (count($cat) > 0) {
            $data = $data->whereIn('cid', $cat);
        }

        if (count($brandsel) > 0) {
            $data = $data->whereIn('bid', $brandsel);
        }

        if ($request->newarrival >= 1 && $request->newarrival == 1) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-30days')));
        } else if ($request->newarrival >= 1 && $request->newarrival == 2) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-60days')));
        }


        if ($request->pricerange >= 1) {
            $this->pricerangefilter($data, $request->pricerange);
        }
        if ($request->discountrange >= 1) {
            $this->discountrangefilter($data, $request->discountrange);
        }

        if ($request->todaydeal) {
            $data = $data->where('fpricewtas', '>', 0);
        }
        $data = $data->orderby($request->orderfil['id'], $request->orderfil['ordby'])->paginate(20);
        return $data;
    }

    public function msbrand(Request $request, $name)
    {

        $brand = Brand::where('status', 1)->where('name', $name)->first();
        $this->setSEO($brand->seo_title ?? '', $brand->seo_desc ?? '', '');

        if ($brand) {
            $data = $this->productwithreview()
                ->orderBy('name', 'asc')
                ->where('bid', $brand->id)
                ->paginate(20);
            $category = Category::whereIn('id', $data->pluck('cid'))->with('subcategory')->orderBy('name', 'asc')->get();
            if (Auth::check()) {
                $uid = Auth::user()->id;
                $new = new CustomerInteraction;
                $new->data = $request->searchname;
                $new->type = 'search';
                $new->uid = $uid;
                $new->save();
            }

            return view('searchh', [
                'data' => $data,
                'category' => $category,
                'brand' => $brand,
                'searchname' => $request->searchname,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry Category not found');
        }
        return redirect('/');
    }


    /**
     * @group Search Data
     * Brand Search
     * @response 200 {
     *  "success": true,
     *  "message": "Fetched Data",
     *  "data": [{
     *              Products ....
     *          }]
     *      * },
     * @response 401 {
     *  "success": false,
     *  "message": "Sorry",
     * }
     */
    public function msbranddata(Request $request)
    {
        $cat = $request->category ?? [];
        $subcat = $request->category ?? [];
        $brandsel = $request->mainid ?? [];


        if (count($subcat) <= 0) {
            $subcat = $this->subcatsearch($request->searchname)->pluck('id');
        }
        if (count($cat) <= 0) {
            $cat = $this->catsearch($request->searchname, $subcat)->pluck('id');
        }

        $name = $request->searchname;
        $data = $this->productwithreview()
            ->where('bid', $brandsel);
        if (count($cat) > 0) {
            $data = $data->whereIn('cid', $cat);
        }


        if ($request->newarrival >= 1 && $request->newarrival == 1) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-30days')));
        } else if ($request->newarrival >= 1 && $request->newarrival == 2) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-60days')));
        }


        if ($request->pricerange >= 1) {
            $this->pricerangefilter($data, $request->pricerange);
        }
        if ($request->discountrange >= 1) {
            $this->discountrangefilter($data, $request->discountrange);
        }

        if ($request->todaydeal) {
            $data = $data->where('fpricewtas', '>', 0);
        }
        $data = $data->orderby($request->orderfil['id'], $request->orderfil['ordby'])->paginate(20);
        return $data;
    }




    public function mscategory(Request $request, $name)
    {
        $category = Category::where('name', $name)->with('subcategory')->first();
        $this->setSEO($category->seo_title ?? '', $category->seo_desc ?? '', '');

        if ($category) {
            $data = $this->productwithreview()
                ->orderBy('name', 'asc')
                ->where('cid', $category->id)
                ->paginate(20);
            $brand = Brand::where('status', 1)->select('id', 'name')->orderBy('name', 'asc')->whereIn('id', $data->pluck('bid'))->get();
            if (Auth::check()) {
                $uid = Auth::user()->id;
                $new = new CustomerInteraction;
                $new->data = $request->searchname;
                $new->type = 'search';
                $new->uid = $uid;
                $new->save();
            }
            return view('Pages.Category.Category', [
                'data' => $data,
                'category' => $category,
                'brand' => $brand,
                'searchname' => $category->name,
            ]);
        } else {
            $request->session()->flash('error', 'Sorry Category not found');
        }
        return redirect('/');
    }

    /**
     * @group Search Data
     * Category Search
     * @response 200 {
     *  "success": true,
     *  "message": "Fetched Data",
     *  "data": [{
     *              Products ....
     *          }]
     *      * },
     * @response 401 {
     *  "success": false,
     *  "message": "Sorry",
     * }
     */
    public function mscategorydata(Request $request)
    {

        $cat = $request->mainid ?? [];
        $subcat = $request->category ?? [];
        $brandsel = $request->brand ?? [];

        $data = $this->productwithreview()
            ->where('cid', $cat);

        if (count($subcat) > 0) {
            $data = $data->whereIn('scid', $subcat);
        }

        if (count($brandsel) > 0) {
            $data = $data->whereIn('bid', $brandsel);
        }

        if ($request->newarrival >= 1 && $request->newarrival == 1) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-30days')));
        } else if ($request->newarrival >= 1 && $request->newarrival == 2) {
            $data = $data->where('created_at', '>=', date('Y-m-d', strtotime('-60days')));
        }


        if ($request->pricerange >= 1) {
            $this->pricerangefilter($data, $request->pricerange);
        }
        if ($request->discountrange >= 1) {
            $this->discountrangefilter($data, $request->discountrange);
        }

        if ($request->todaydeal) {
            $data = $data->where('fpricewtas', '>', 0);
        }
        $data = $data->orderby($request->orderfil['id'], $request->orderfil['ordby'])->paginate(20);
        return $data;
    }




    public function setSEO($title, $desc, $link)
    {
        SEOTools::setTitle($title);
        SEOTools::setDescription($desc);
        SEOTools::opengraph()->setUrl(config('app.url') . $link);
        SEOTools::setCanonical(config('app.url') . $link);
        SEOTools::opengraph()->addProperty('type', 'ecommerce');
        SEOTools::jsonLd()->addImage(config('app.url') . '/storage/logo.jpg');
    }

    public function pricerangefilter($data, $pricerange)
    {
        if ($pricerange == 1) {
            $data = $data->where('fpricewtas', '>=', 0)->where('fpricewtas', '<', 100);
        } else if ($pricerange == 2) {
            $data = $data->where('fpricewtas', '>=', 100)->where('fpricewtas', '<', 300);
        } else if ($pricerange == 3) {
            $data = $data->where('fpricewtas', '>=', 300)->where('fpricewtas', '<', 500);
        } else if ($pricerange == 4) {
            $data = $data->where('fpricewtas', '>=', 500)->where('fpricewtas', '<', 1000);
        } else if ($pricerange == 5) {
            $data = $data->where('fpricewtas', '>=', 1000);
        }
        return $data;
    }
    public function discountrangefilter($data, $discountrange)
    {
        if ($discountrange == 1) {
            $data = $data->where('disp', '>', 0)->where('disp', '<', 5);
        } else if ($discountrange == 2) {
            $data = $data->where('disp', '>=', 5)->where('disp', '<', 10);
        } else if ($discountrange == 3) {
            $data = $data->where('disp', '>=', 10)->where('disp', '<', 15);
        } else if ($discountrange == 4) {
            $data = $data->where('disp', '>=', 15)->where('disp', '<', 25);
        } else if ($discountrange == 5) {
            $data = $data->where('disp', '>=', 25);
        }
        return $data;
    }

    public function productwithreview()
    {
        $data = Products::with('review')->select(
            'products.id as id',
            'urlslug',
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
            'disp',
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
            'urlslug',
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

    public function welcome(Request $request)
    {



        $banner = Banner::select('name', 'desc', 'link', 'loc')->get();
        $category = Category::select('banner', 'name', 'loc', 'id')->withCount('products')->with('subcategory')->take(7)->get();
        $brand = Brand::where('status', 1)->select('banner', 'id', 'name', 'loc')->withCount('products')->orderBy('products_count', 'desc')->take(10)->get();

        $pagescollection = PagesCollections::where('name', 'Home Page')->first();
        $cms = CMS::where('name', 'footer')->first();
        $discounts = Discounts::select('name', 'loc', 'status', 'id')->where('status', 1)->take(7)->get();
        $array = [8, 2, 4];
        $ids_ordered = implode(',', $array);

        $catprod = Category::select('id', 'name')->withCount('products')->where('homebanner', 1)->with('products')->take(4)->get();
        // return $catprod;->whereIn('id', $array)->orderByRaw('FIELD(id,'.$ids_ordered.')')


        $seo = SEO::where('page', 'Home')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '');

        return view('Pages.welcome', [
            'banner' => $banner,
            'category' => $category,
            'pagescollection' => $pagescollection,
            'brand' => $brand,
            'cms' => $cms,
            'discounts' => $discounts,
            'catprod' => $catprod,
        ]);
    }

    public function productsview(Request $request, $name)
    {
        $data =  $this->productwithreview()
            ->leftjoin('reviews', 'products.id', '=', 'reviews.pid')
            ->addSelect(
                'desc',
                'attribute',
                'uomid',
                'fpricebefdis',
                'weight',
                'length',
                'width',
                'breadth',
                'taxp',
                'disid',
                'shortdesc',
                'seo_title',
                'seo_Desc',
                db::raw('round(avg(rating),1) as avgrating')
            )
            ->with('images')
            ->with('brand')
            ->with('uom')
            ->with('category')
            ->with('subcategory')
            ->where('urlslug', $name)
            ->first();
        // return $data;
        if ($data->id) {
            if (Auth::check()) {
                $uid = Auth::user()->id;
                $new = new CustomerInteraction;
                $new->data = $data->id;
                $new->type = 'prodview';
                $new->uid = $uid;
                $new->save();
            }

            // //customer who also bought this Item Also
            $opd = OrdersSub::where('pid', $data->id)->pluck('uid');
            $prods = OrdersSub::whereIn('uid', $opd)->whereNotIn('pid', [$data->id])->orderBy('id', 'desc')->take(24)->pluck('pid');

            $customeralsobought = $this->productwithreview()
                ->whereIn('products.id', $prods)
                ->get();

            // //Customer Bought Togheter
            $this->setSEO($data->seo_title ?? '', $data->seo_desc ?? '', '');

            $productrelatedtoitem = $this->basicproducts()
                ->where('cid', $data->cid)
                ->where('id', '!=', $data->id)
                ->take(12)
                ->get();

            return view('Pages.Productview', [
                'data' => $data,
                'customeralsobought' => $customeralsobought,
                'productrelatedtoitem' => $productrelatedtoitem,
            ]);
        } else {
            return redirect('/noproduct');
        }
    }
    public function noproductfound(Request $request)
    {
        return view('noproductfound');
    }




    /**
     * @group Checkout
     * Shipping Cost
     * @bodyParam pincode string Pincode
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

    public function getcost(Request $request)
    {
        $data = PinCode::where('pincode', $request->pincode)->first();
        if ($data) {
            return response()->json([
                'success' => true,
                'title' => '',
                'message' => '',
                'data' => $data->cost,
            ], 200);
        } else {

            return response()->json([
                'success' => false,
                'title' => 'Area not in Service',
                'message' => 'Sorry we dont serve the selected area',
                'data' => 0,
            ], 400);
        }
    }

    public function quicksearch(Request $request)
    {

        $name = $request->named;
        $data = $this->productwithreview()
            ->where('name', 'LIKE', '%' . $name . '%');
        $data = $data->take(5)->get();

        return response()->json([
            'success' => true,
            'title' => '',
            'message' => '',
            'data' => $data,
        ]);
    }

    public function category(Request $request)
    {
        $data = Category::where('status', 1)->select('id', 'name', 'banner')->with('subcategory')->get();

        $seo = SEO::where('page', 'Category')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/category');

        return view('Pages.Category.List', ['data' => $data]);
    }



    public function brand(Request $request)
    {
        $data = Brand::where('status', 1)->select('id', 'banner', 'name')->get();
        $seo = SEO::where('page', 'Category')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/brand');
        return view('Pages.Brand.List', ['data' => $data]);
    }





    public function allproducts(Request $request)
    {
        $data =  $this->productwithreview()
            ->orderBy('created_at', 'desc')
            ->paginate(30);
        $seo = SEO::where('page', 'AllProducts')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/allproducts');
        return view('Pages.allgenproductpage', ['data' => $data, 'title' => 'Products']);
    }

    public function trendingproducts(Request $request)
    {
        $custinter = CustomerInteraction::where('type', 'prodview')->distinct('data')->orderBy('created_at', 'desc')->pluck('data');

        $data =  $this->productwithreview()
            ->whereIn('products.id', $custinter)
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get();
        $seo = SEO::where('page', 'TrendingProducts')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/trendingproducts');
        return view('Pages.genproductpage', ['data' => $data, 'title' => 'Trending Products']);
    }


    public function newproducts(Request $request)
    {
        $data =  $this->productwithreview()
            ->where('created_at', '>=', date('Y-m-d', strtotime('-30days')))
            ->orderBy('created_at', 'desc')
            ->take(30)
            ->get();
        $seo = SEO::where('page', 'NewProducts')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/newproducts');
        return view('Pages.genproductpage', ['data' => $data, 'title' => 'New Products']);
    }

    public function topselling(Request $request)
    {

        $datasub = OrdersSub::select('pid', DB::raw('count(*) as total'))
            ->groupBy('pid')->orderBy('total', 'desc')->get();
        $data = $this->productwithreview()
            ->orderBy(
                'created_at',
                'desc'
            )
            ->whereIn('id', $datasub->pluck('pid'))
            ->get();
        $seo = SEO::where('page', 'TopSelling')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/topselling');

        return view('Pages.genproductpage', ['data' => $data, 'title' => 'Top Selling']);
    }
    public function termsandcondition(Request $request)
    {
        $data = CMS::where('name', 'tandc')->first();
        $seo = SEO::where('page', 'Terms&Cond')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/termsandcondition');

        return view('Pages.general', ['title' => 'Terms And Condition', 'data' => $data]);
    }
    public function shippingpolicy(Request $request)
    {
        $data = CMS::where('name', 'shipping')->first();
        $seo = SEO::where('page', 'ShippingPolicy')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/shippingpolicy');
        return view('Pages.general', ['title' => 'Shipping Policy', 'data' => $data]);
    }
    public function refundpolicy(Request $request)
    {
        $data = CMS::where('name', 'refund')->first();
        $seo = SEO::where('page', 'RefundPolicy')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/refundpolicy');

        return view('Pages.general', ['title' => 'Refund policy', 'data' => $data]);
    }
    public function privacypolicy(Request $request)
    {
        $data = CMS::where('name', 'privacy')->first();
        $seo = SEO::where('page', 'PrivacyPolicy')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/privacypolicy');
        return view('Pages.general', ['title' => 'Privacy Policy', 'data' => $data]);
    }
    public function aboutus(Request $request)
    {
        $data = CMS::where('name', 'aboutus')->first();
        $seo = SEO::where('page', 'AboutUS')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/aboutus');

        return view('Pages.general', ['title' => 'About Us', 'data' => $data]);
    }
    public function faq(Request $request)
    {
        $data = CMS::where('name', 'faq')->first();
        $seo = SEO::where('page', 'FAQ')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/faq');

        return view('Pages.general', ['title' => 'FAQ', 'data' => $data]);
    }
    public function returnpolicy(Request $request)
    {
        $data = CMS::where('name', 'return')->first();
        $seo = SEO::where('page', 'ReturnPolicy')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/returnpolicy');
        return view('Pages.general', ['title' => 'Return Policy', 'data' => $data]);
    }




    public function contactusview(Request $request)
    {
        $seo = SEO::where('page', 'ContactUs')->first();
        $this->setSEO($seo->title ?? '', $seo->desc ?? '', '/contactus');

        return view('contactus');
    }

    /**
     * @group General
     * Contact US
     * @bodyParam name string Name
     * @bodyParam email string Email
     * @bodyParam phno string Phone number
     * @bodyParam msg string Message
     * @response 200 {
     *  "success": true,
     *  "title": "Hurrey",
     *  "message": "We will get back to you shortly",
     *  "data": {}
     *
     * }
     * @response 200 {
     *  "success": false,
     *  "title": "Sorry",
     *  "message": "Please Contact Admin",
     *  "data": {}
     * }
     */
    public function contactus(Request $request)
    {
        $data = new ModelContactUs();
        $data->name = $request->name;
        $data->email = $request->email;
        $data->phno = $request->phno;
        $data->msg = $request->msg;
        $data->save();
        return response()->json([
            'success' => true,
            'title' => 'Hurrey',
            'message' => 'We will get back to you shortly',
        ], 200);
    }

    public function userdeletion(Request $request)
    {
        return 1;
    }
}
