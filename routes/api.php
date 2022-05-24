<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['prefix' => 'v1'], function () {
    Route::get('/welcome', 'Api\V1\BasicController@welcome');
    Route::get('/getcost', 'Pages@getcost');
    Route::post('/quicksearch', 'Pages@quicksearch');

    Route::post('/getarea', 'Customer@getarea');
    Route::post('/checkpincode', 'Customer@checkpincode');
    Route::post('/getpromocode', 'Customer@getpromocode');
    Route::post('/contactus', 'Pages@contactus');

    Route::post('/login', 'Api\V1\AuthController@login');
    Route::post('/register', 'Api\V1\AuthController@register');

    Route::get('/comboproducts', 'Api\V1\BasicController@comboproducts');
    Route::get('/newproducts', 'Api\V1\BasicController@newproducts');
    Route::get('/trendingproducts', 'Api\V1\BasicController@trendingproducts');
    Route::get('/topselling', 'Api\V1\BasicController@topselling');

    Route::get('/category', 'Api\V1\BasicController@category');
    Route::get('/brand', 'Api\V1\BasicController@brand');

    Route::post('/search', 'Api\V1\SearchController@search');
    Route::post('/searchdata', 'Pages@mssearchdata');

    Route::post('/searchbrand', 'Api\V1\SearchController@brand');
    Route::post('/branddata', 'Pages@msbranddata');

    Route::post('/searchcategory', 'Api\V1\SearchController@category');
    Route::post('/categorydata', 'Pages@mscategorydata');

    Route::post('/searchhotdeals', 'Api\V1\SearchController@hotdeals');
    Route::post('/hotdealsdata', 'Pages@mshotdealsdata');


    //
    Route::middleware('auth:api')->group(function () {

        Route::get('/products/{name}', 'Api\V1\BasicController@productsview');
        Route::post('/refresh-token', 'Api\V1\AuthController@refreshtoken');
        Route::post('/logout', 'Api\V1\AuthController@logout');

        Route::post('/postreview', 'Customer@postreview');

        Route::group(['prefix' => 'cart'], function () {
            Route::post('/', 'Api\V1\BasicController@cartlist');
            Route::post('/new', 'Api\V1\BasicController@cartsave');
            Route::post('/delete', 'Api\V1\BasicController@destroy');
        });
        Route::group(['prefix' => 'address'], function () {
            Route::post('/', 'Api\V1\ProfileController@addresslist');
            Route::post('/view', 'Api\V1\ProfileController@addressview');
            Route::post('/new', 'Api\V1\ProfileController@addressadd');
            Route::post('/edit', 'Api\V1\ProfileController@addressupdate');
            Route::post('/delete', 'Api\V1\ProfileController@addressdestroy');
        });

        Route::group(['prefix' => 'wishlist'], function () {
            Route::post('/', 'Api\V1\BasicController@wishlist');
            Route::post('/new', 'WishListController@store');
            Route::post('/delete', 'WishListController@destroy');
        });
        Route::group(['prefix' => 'orders'], function () {
            Route::post('/', 'Api\V1\ProfileController@ordersindex');
            Route::post('/view', 'Api\V1\ProfileController@ordersshow');
            Route::get('/pay/{id}', 'Api\V1\ProfileController@orderspay');
            Route::get('/cancel/{id}', 'Api\V1\ProfileController@orderscancel');
            Route::get('/return/{id}', 'Api\V1\ProfileController@ordersreturn');
            Route::get('/invoice/{id}', 'Api\V1\ProfileController@ordersinvoice');
        });

        Route::post('/getpromocode', 'Api\V1\BasicController@getpromocode');
        Route::post('/getaddress', 'Api\V1\BasicController@getaddress');

        Route::post('/otpverify', 'Api\V1\AuthController@loginotpverifypost');
        Route::post('/otpresend', 'Api\V1\AuthController@loginresentotp');
        Route::post('/logout', 'Api\V1\AuthController@logout');
    });


    Route::get('/termsandcondition', 'Api\V1\BasicController@termsandcondition');
    Route::get('/shippingpolicy', 'Api\V1\BasicController@shippingpolicy');
    Route::get('/refundpolicy', 'Api\V1\BasicController@refundpolicy');
    Route::get('/privacypolicy', 'Api\V1\BasicController@privacypolicy');
    Route::get('/faq', 'Api\V1\BasicController@faq');
    Route::get('/returnpolicy', 'Api\V1\BasicController@returnpolicy');
    Route::get('/aboutus', 'Api\V1\BasicController@aboutus');









});
