<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/unsubscribe/{data}', 'Customer@unsubscribe');
Route::post('/getcost', 'Pages@getcost');
Route::post('/quicksearch', 'Pages@quicksearch');

Route::post('/pay/verify', 'OrdersController@paytympay');


Route::post('/getarea', 'Customer@getarea')->name('getarea');
Route::post('/checkpincode', 'Customer@checkpincode')->name('checkpincode');


Route::get('login/{provider}', 'SocialLogin@redirect')->where('social', 'twitter|facebook|linkedin|google|github|bitbucket');
Route::get('login/{provider}/callback', 'SocialLogin@Callback');

Route::get('/contactus', 'Pages@contactusview');
Route::post('/contactus', 'Pages@contactus');


Route::post('/cart/new', 'CartController@store');
Route::post('/profile/wishlist/new', 'WishListController@store');

Auth::routes();

Route::group(['middleware' => ['emptycart']], function () {

    Route::get('/', 'Pages@welcome')->name('welcome');
    Route::get('/noproduct', 'Pages@noproductfound');
    Route::get('/newproducts', 'Pages@newproducts');
    Route::get('/trendingproducts', 'Pages@trendingproducts');
    Route::get('/topselling', 'Pages@topselling');
    Route::get('/allproducts', 'Pages@allproducts');

    Route::get('/search', 'Pages@mssearch');
    Route::post('/searchdata', 'Pages@mssearchdata');

    Route::get('/category', 'Pages@category');
    Route::get('/category/{name}', 'Pages@mscategory');
    Route::post('/categorydata', 'Pages@mscategorydata');

    // Route::get('/brand', 'Pages@brand');
    // Route::get('/brand/{name}', 'Pages@msbrand');
    // Route::post('/branddata', 'Pages@msbranddata');

    Route::get('/hotdeals', 'Pages@mshotdeals');
    Route::post('/hotdealsdata', 'Pages@mshotdealsdata');

    Route::get('/category/{name}/{subcat}', 'Pages@subcategoryview');
    Route::post('/subcategorydata', 'Pages@subcategorydata');
    Route::post('/pay/{id}/verify', 'OrdersController@paymentpost')->name('payment');

    Route::get('/products/{name}', 'Pages@productsview');

    Route::post('/register', 'Customer@register')->name('regsiter');

    //not email verified
    Route::group(['middleware' => ['web', 'auth']], function () {
        Route::get('/otpverify', 'Customer@loginotpverify')->name('otpverify');
        Route::post('/otpverify', 'Customer@loginotpverifypost');
        Route::post('/otpresend', 'Customer@loginresentotp');
        Route::post('/getpromocode', 'Customer@getpromocode');
        Route::post('/getaddress', 'Customer@getaddress');

        Route::post('/postreview', 'Customer@postreview');
        Route::post('/reportreview', 'Customer@reportreview');
        Route::post('/changepincode', 'Customer@changepincode');

        Route::group(['prefix' => 'cart'], function () {

            Route::post('/delete', 'CartController@destroy');
        });
        Route::group(['middleware' => ['emailverify'], 'prefix' => 'profile'], function () {
            Route::get('/', 'Customer@profilehome');

            Route::group(['prefix' => 'cart'], function () {
                Route::get('/', 'CartController@index')->name('cart');
                Route::post('/checkout', 'CartController@checkout');
                Route::post('/save', 'CartController@save');
            });

            Route::group(['prefix' => 'orders'], function () {
                Route::get('/', 'OrdersController@index');
                Route::get('/{id}', 'OrdersController@show');
                Route::get('/pay/{id}', 'OrdersController@pay');
                Route::get('/cancel/{id}', 'OrdersController@cancel');
                Route::get('/return/{id}', 'OrdersController@return');
                Route::get('/invoice/{id}', 'OrdersController@invoice');
            });
            Route::group(['prefix' => 'wishlist'], function () {
                Route::get('/', 'WishListController@index')->name('wishlist');
                Route::post('/filter', 'WishListController@filter');
                Route::post('/delete', 'WishListController@destroy');
            });

            Route::group(['prefix' => 'address'], function () {
                Route::get('/', 'AddressController@index');
                Route::get('/new', 'AddressController@create');
                Route::post('/new', 'AddressController@store');
                Route::get('/edit/{id}', 'AddressController@edit');
                Route::post('/edit/{id}', 'AddressController@update');
                Route::get('/view/{id}', 'AddressController@show');
                Route::get('/delete/{id}', 'AddressController@destroy');
            });
            Route::group(['prefix' => 'security'], function () {
                Route::get('/', 'Customer@securityindex');
                Route::get('/name', 'Customer@nameedit');
                Route::post('/name', 'Customer@nameeditpost');
                Route::get('/email', 'Customer@emailedit');
                Route::post('/email', 'Customer@emaileditpost');
                Route::get('/phone', 'Customer@phoneedit');
                Route::post('/phone', 'Customer@phoneeditpost');
                Route::get('/password', 'Customer@resetpassword');
                Route::post('/password', 'Customer@resetpasswordpost');
            });
        });
    });
});



Route::get('/termsandcondition', 'Pages@termsandcondition')->name('termsandcondition');
Route::get('/shippingpolicy', 'Pages@shippingpolicy')->name('shippingpolicy');
Route::get('/refundpolicy', 'Pages@refundpolicy')->name('refundpolicy');
Route::get('/privacypolicy', 'Pages@privacypolicy')->name('privacypolicy');
Route::get('/aboutus', 'Pages@aboutus')->name('aboutus');
Route::get('/faq', 'Pages@faq')->name('faq');
Route::get('/returnpolicy', 'Pages@returnpolicy')->name('returnpolicy');
Route::get('/userdeletion', 'Pages@userdeletion')->name('userdeletion');


Route::get('/home', 'HomeController@index')->name('home');


Route::group(['middleware' => ['web', 'adminhome'], 'prefix' => 'admin'], function () {
    Route::get('/', 'AdminPage@home');
    Route::group(['middleware' => ['web'], 'prefix' => 'pages'], function () {
        Route::prefix('{pagename}')->group(function () {
            Route::prefix('subbanner')->group(function () {
                Route::get('/', 'PagesCollectionsController@subbannerindex');
                Route::get('/add', 'PagesCollectionsController@subbannercreate');
                Route::post('/add', 'PagesCollectionsController@subbannerstore');
                Route::get('/edit/{id}', 'PagesCollectionsController@subbanneredit');
                Route::post('/edit/{id}', 'PagesCollectionsController@subbannerupdate');
                Route::get('/view/{id}', 'PagesCollectionsController@subbannershow');
                Route::get('/delete/{id}', 'PagesCollectionsController@subbannerdestroy');
            });
        });
        Route::get('/', 'PagesCollectionsController@index');
        Route::get('/add', 'PagesCollectionsController@create');
        Route::post('/add', 'PagesCollectionsController@store');
        Route::get('/edit/{id}', 'PagesCollectionsController@edit');
        Route::post('/edit/{id}', 'PagesCollectionsController@update');
        Route::get('/view/{id}', 'PagesCollectionsController@show');
        Route::get('/delete/{id}', 'PagesCollectionsController@destroy');
    });
    Route::group(['middleware' => ['web'], 'prefix' => 'master'], function () {
        Route::prefix('category')->middleware('admincategory')->group(function () {
            Route::get('/', 'CategoryController@index');
            Route::get('/add', 'CategoryController@create');
            Route::post('/add', 'CategoryController@store');
            Route::get('/edit/{id}', 'CategoryController@edit');
            Route::post('/edit/{id}', 'CategoryController@update');
            Route::get('/view/{id}', 'CategoryController@show');
            Route::get('/delete/{id}', 'CategoryController@destroy');
        });
        Route::prefix('subcategory')->middleware('adminsubcategory')->group(function () {
            Route::get('/', 'SubCategoryController@index');
            Route::get('/add', 'SubCategoryController@create');
            Route::post('/add', 'SubCategoryController@store');
            Route::get('/edit/{id}', 'SubCategoryController@edit');
            Route::post('/edit/{id}', 'SubCategoryController@update');
            Route::get('/view/{id}', 'SubCategoryController@show');
            Route::get('/delete/{id}', 'SubCategoryController@destroy');
        });
        Route::prefix('brand')->middleware('adminbrand')->group(function () {
            Route::get('/', 'BrandController@index');
            Route::get('/add', 'BrandController@create');
            Route::post('/add', 'BrandController@store');
            Route::get('/edit/{id}', 'BrandController@edit');
            Route::post('/edit/{id}', 'BrandController@update');
            Route::get('/view/{id}', 'BrandController@show');
            Route::get('/delete/{id}', 'BrandController@destroy');
        });
        Route::prefix('attribute')->middleware('adminattribute')->group(function () {
            Route::get('/', 'AttributeController@index');
            Route::post('/add', 'AttributeController@store');
            Route::post('/edit', 'AttributeController@update');
            Route::post('/delete', 'AttributeController@destroy');
        });
        Route::prefix('packing')->middleware('adminpacking')->group(function () {
            Route::get('/', 'PackingController@index');
            Route::post('/add', 'PackingController@store');
            Route::post('/edit', 'PackingController@update');
            Route::post('/delete', 'PackingController@destroy');
        });
        Route::prefix('uom')->middleware('adminuom')->group(function () {
            Route::get('/', 'UOMController@index');
            Route::post('/add', 'UOMController@store');
            Route::post('/edit', 'UOMController@update');
            Route::post('/delete', 'UOMController@destroy');
        });
        Route::prefix('tags')->middleware('admintags')->group(function () {
            Route::get('/', 'TagsController@index');
            Route::post('/add', 'TagsController@store');
            Route::post('/edit', 'TagsController@update');
            Route::post('/delete', 'TagsController@destroy');
        });
    });

    Route::group(['middleware' => ['web'], 'prefix' => 'discounts'], function () {
        Route::prefix('promocode')->group(function () {
            Route::get('/', 'PromoCodeController@index');
            Route::get('/add', 'PromoCodeController@create');
            Route::post('/add', 'PromoCodeController@store');
            Route::get('/edit/{id}', 'PromoCodeController@edit');
            Route::post('/edit/{id}', 'PromoCodeController@update');
            Route::get('/view/{id}', 'PromoCodeController@show');
            Route::get('/delete/{id}', 'PromoCodeController@destroy');
        });
        Route::prefix('netdiscount')->group(function () {
            Route::get('/', 'DiscountsController@index');
            Route::get('/add', 'DiscountsController@create');
            Route::post('/add', 'DiscountsController@store');
            // Route::get('/edit/{id}','DiscountsController@edit');
            // Route::post('/edit/{id}','DiscountsController@update');
            Route::get('/view/{id}', 'DiscountsController@show');
            Route::get('/delete/{id}', 'DiscountsController@destroy');
        });
    });
    Route::prefix('products')->group(function () {
        Route::get('/', 'ProductsController@index');
        Route::get('/inventory', 'ProductsController@inventory');
        Route::get('/add', 'ProductsController@create');
        Route::post('/add', 'ProductsController@store');
        Route::post('/addphoto/{id}', 'ProductsController@storephoto');
        Route::post('/deletephoto', 'ProductsController@deletephoto');
        Route::get('/edit/{id}', 'ProductsController@edit');
        Route::post('/edit/{id}', 'ProductsController@update');
        Route::get('/view/{id}', 'ProductsController@show');
        Route::get('/delete/{id}', 'ProductsController@destroy');
        Route::get('/stockupdate', 'ProductsController@stockupdatecreate');
        Route::post('/stockupdate', 'ProductsController@stockupdatestore');
    });


    Route::prefix('contact')->middleware('adminseo')->group(function () {
        Route::get('/', 'AdminPage@contactindex');
        Route::get('/{id}', 'AdminPage@contactdestroy');
    });

    Route::prefix('orders')->group(function () {
        Route::get('/', 'AdminPage@orderindex');
        Route::get('/quick', 'AdminPage@orderquickindex');
        Route::post('/quick', 'AdminPage@orderquickpull');

        Route::post('/approve', 'AdminPage@orderapprove');
        Route::post('/outfordel', 'AdminPage@orderoutfordel');
        Route::post('/delivered', 'AdminPage@orderdelivered');
        Route::post('/cancelled', 'AdminPage@ordercancelled');

        Route::get('/convertpaytype/{id}', 'AdminPage@convertpaytype');


        Route::post('/edit/{id}', 'AdminPage@ordershowsave');
        Route::get('/view/{id}', 'AdminPage@ordershow');
        Route::get('/invoice/{id}', 'AdminPage@orderinvoice');
        Route::get('/delete/{id}', 'OrdersController@destroy');
        Route::post('/returnamt/{id}', 'AdminPage@returnamt');
    });

    Route::prefix('store')->group(function () {
        Route::get('/', 'StoreController@index');
        Route::get('/add', 'StoreController@create');
        Route::post('/add', 'StoreController@store');
        Route::get('/edit/{id}', 'StoreController@edit');
        Route::post('/edit/{id}', 'StoreController@update');
        Route::get('/view/{id}', 'StoreController@show');
        Route::get('/delete/{id}', 'StoreController@destroy');
    });

    Route::prefix('banner')->middleware('adminbanner')->group(function () {
        Route::get('/', 'BannerController@index');
        Route::get('/add', 'BannerController@create');
        Route::post('/add', 'BannerController@store');
        Route::get('/edit/{id}', 'BannerController@edit');
        Route::post('/edit/{id}', 'BannerController@update');
        Route::get('/view/{id}', 'BannerController@show');
        Route::get('/delete/{id}', 'BannerController@destroy');
    });

    Route::prefix('newsletter')->middleware('adminnewsletter')->group(function () {
        Route::get('/', 'NewsletterController@index');
        Route::get('/add', 'NewsletterController@create');
        Route::post('/add', 'NewsletterController@store');
        Route::get('/edit/{id}', 'NewsletterController@edit');
        Route::post('/edit/{id}', 'NewsletterController@update');
        Route::get('/view/{id}', 'NewsletterController@show');
        Route::get('/delete/{id}', 'NewsletterController@destroy');
    });

    Route::prefix('customer')->group(function () {
        Route::get('/', 'AdminPage@custindex');
        Route::get('/add', 'AdminPage@custcreate');
        Route::post('/add', 'AdminPage@custstore');
        Route::get('/edit/{id}', 'AdminPage@custedit');
        Route::post('/edit/{id}', 'AdminPage@custupdate');
        Route::get('/view/{id}', 'AdminPage@custshow');
        Route::get('/delete/{id}', 'AdminPage@custdestroy');
    });

    Route::prefix('employee')->group(function () {
        Route::get('/', 'AdminPage@empindex');
        Route::get('/add', 'AdminPage@empcreate');
        Route::post('/add', 'AdminPage@empstore');
        Route::get('/edit/{id}', 'AdminPage@empedit');
        Route::post('/edit/{id}', 'AdminPage@empupdate');
        Route::get('/view/{id}', 'AdminPage@empshow');
        Route::get('/delete/{id}', 'AdminPage@empdestroy');
    });


    Route::prefix('cms')->middleware('admincms')->group(function () {
        Route::get('/', 'CMSController@index');
        Route::get('/{name}', 'CMSController@create');
        Route::post('/{name}', 'CMSController@store');
    });

    Route::prefix('seo')->middleware('adminseo')->group(function () {
        Route::get('/', 'SEOController@index');
        Route::get('/{name}', 'SEOController@edit');
        Route::post('/{name}', 'SEOController@update');
    });


    Route::prefix('settings')->group(function () {
        Route::get('/', 'SettingsController@create');
        Route::post('/', 'SettingsController@store');
    });

    Route::prefix('pincode')->middleware('adminpincode')->group(function () {
        Route::get('/', 'PinCodeController@index');
        Route::post('/add', 'PinCodeController@store');
        Route::post('/edit', 'PinCodeController@update');
        Route::post('/delete', 'PinCodeController@destroy');
        Route::post('/import', 'PinCodeController@import');
    });

    Route::prefix('logs')->group(function () {
        Route::get('/', 'AdminPage@logsindex');
        Route::get('/view/{id}', 'AdminPage@logshow');
        Route::get('/{id}', 'AdminPage@logsdestroy');
    });


    Route::prefix('reviews')->group(function () {
        Route::get('/', 'AdminPage@reviewsindex');
        Route::get('/view/{id}', 'AdminPage@reviewshow');
        Route::post('/edit/{id}', 'AdminPage@reviewsedit');
        Route::get('/{id}', 'AdminPage@reviewsdestroy');
    });





    Route::prefix('reports')->group(function () {
        Route::get('/lowstock', 'Report@lowstock');
        Route::get('/stock', 'Report@stock');
        Route::get('/sales', 'Report@sales');
        Route::get('/returns', 'Report@returns');
        Route::get('/productsold', 'Report@productsold');
    });

    Route::group(['prefix' => 'importexport'], function () {
        Route::get('/', 'ImportExportController@index');
        Route::post('import/{type}', 'ImportExportController@importtype');
        Route::get('export/{type}', 'ImportExportController@exporttype');
    });
});
