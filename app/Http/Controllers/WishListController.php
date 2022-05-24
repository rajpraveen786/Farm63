<?php

namespace App\Http\Controllers;

use App\Model\OrdersSub;
use App\Model\Products;
use App\Model\WishList;
use Illuminate\Http\Request;
use Auth;
use Illuminate\Support\Facades\Auth as FacadesAuth;

class WishListController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('Profile/wishlist');
    }
    public function filter(Request $request)
    {
        $uid = Auth::user()->id;
        $data = WishList::where('uid', $uid)->pluck('pid');
        $products = Products::select('id', 'urlslug', 'name', 'bid', 'fpricewtas', 'fpricebefdis', 'created_at', 'cid', 'bid', 'status', 'oosc', 'stock')
            ->whereHas('wishlist', function ($q) use ($uid) {
                $q->where('uid', $uid);
            })
            ->where(function ($q) {
                $q->where('stock', '>', 0)
                    ->orWhere('oosc', 1);
            })->with('brand')
            ->where('status', 1)->with('category')->with('brand')->with('wishlist')->with('image')->whereIn('id', $data);
        $products = $products->paginate(20);
        return $products;
        return $products;
    }



    /**
     * @group Product
     * Add to Wishlist
     * @bodyParam uid string User id
     * @bodyParam pid string Product id
     * @response 200 {
     *  "success": true,
     *  "title": "Hurrey",
     *  "message": "Added to wishlist successfully",
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

    public function store(Request $request)
    {
        $user = FacadesAuth::user();
        $title = '';
        $message = '';
        $success = '';
        if ($user) {
            $data = WishList::where('uid', $user->id)->where('pid', $request->pid)->count();
            $title = '';
            $message = '';
            $success = '';
            if ($data > 0) {
                $title = 'Oopss';
                $message = 'Product Already in Wishlist';
                $success = false;
            } else {
                $data = new WishList;
                $data->uid =$user->id;
                $data->pid = $request->pid;
                $data->save();
                $title = 'Hurrey';
                $message = 'Added to Wishlist Successfully';
                $success = true;
            }
        }
        $wishlist = session('wishlist');
        $wishlistc = count($wishlist);
        if (!in_array($request->pid, $wishlist)) {
            $request->session()->push('wishlist', $request->pid);
            $wishlistc = count($wishlist) + 1;
            if (strlen($title) <= 0) {
                $title = 'Hurrey';
                $message = 'Added to Wishlist Successfully';
                $success = true;
            }
        }



        if (strlen($title) <= 0) {
            $title = 'Oops';
            $message = 'Item Already present in Wishlist';
            $success = false;
        }


        $count = $wishlistc;
        return response()->json([
            'success' => $success,
            'title' => $title,
            'message' => $message,
            'count' => $count,
        ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function show(WishList $wishList)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function edit(WishList $wishList)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, WishList $wishList)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\WishList  $wishList
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request)
    {

        $data=WishList::find($request->pid);
        if($data){
            $data->delete();
            $wishlist=session('wishlist');
            $pos=array_search($request->pid, $wishlist);
            unset($wishlist[$pos]);
            session(['wishlist'=>array_values($wishlist)]);

        }
        return 0;

        return redirect('/profile/wishlist');
    }
}
