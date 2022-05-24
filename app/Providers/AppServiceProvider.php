<?php

namespace App\Providers;

use App\CustomerInteraction;
use App\Model\Address;
use App\Model\Brand;
use App\Model\Cart;
use App\Model\Category;
use App\Model\OrdersSub;
use App\Model\Products;
use App\Model\WishList;
use DB;
use Auth;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{

    public function productwithreview(){
        $data= Products::
        with('review')->
        select(
            'products.id as id',
            'name',
            'urlslug',
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

    public function register()
    {

        view()->composer(['layouts.app','layouts.subfooter'], function ($view) {
            $categorieslist=Category::where('status',1)->select('name','id')->get();
            $view->with('categorieslist', $categorieslist);
            $brandlist=Brand::where('status',1)->select('name','id')->get();
            $view->with('brandlist', $brandlist);

            // $address=[];
            // if(Auth::check()){
            //     $address=Address::select('id','pincode')->where('uid',Auth::user()->id)->get();
            // }
            // $view->with('address', $address);

            if(session('cart')){
                $cartcount = count(session('cart'));
            }
            else{
                session(['cart' => []]);
                $cartcount=0;
            }


            if(session('wishlist')){
                $wishcount = count(session('wishlist'));
            }
            else{
                session(['wishlist' => []]);
                $wishcount=0;
            }


            // $cartcount=Auth::user() ? Cart::where('uid',Auth::user()->id)->count():0;
            // $wishcount=Auth::user() ? WishList::where('uid',Auth::user()->id)->count():0;
            $view->with('cartcount', $cartcount);
            $view->with('wishcount', $wishcount);


        });


        view()->composer(['Pages.welcome','newproducts','Pages.Productview','noproductfound'], function ($view) {


            $custinter=CustomerInteraction::where('type','prodview')->distinct('data')->orderBy('created_at','desc')->pluck('data');
            $trendingproducts=$this->productwithreview()
            ->whereIn('products.id', $custinter)
            ->take(7)
            ->get();
            $view->with('trendingproducts', $trendingproducts);


            $datasub = OrdersSub::select('pid', DB::raw('count(*) as total'))
            ->groupBy('pid')->orderBy('total', 'desc')->pluck('pid');

            $topselling=$this->productwithreview()
            ->whereIn('products.id', $datasub)
            ->take(7)
            ->get();
            $view->with('topselling', $topselling);

            $newproducts = $this->productwithreview()
                ->orderBy('products.created_at', 'desc')
                ->take(10)->get();
            $topdeals=$this->productwithreview()->
                where('disid','!=',0)->
                orderBy('disp','desc')->get();

            $view->with('newproducts', $newproducts);
            $view->with('topdeals', $topdeals);

        });
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        if (env('APP_ENV') !== 'local') {
            \URL::forceScheme('https');
        }
    }
}
