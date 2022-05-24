<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- <title>{{ config('app.name', 'Laravel') }}</title> --}}
    {!! SEO::generate() !!}

    <script async src="https://www.googletagmanager.com/gtag/js?id=G-606H23ZMP7"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-606H23ZMP7');

    </script>
    <link rel="icon" type="image/x-icon" href="/storage/tryimg/vakilimg/favicon.ico">
    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/farm63.css') }}" rel="stylesheet">
    <script>
        function preloader() {
            document.getElementById('loader-wrapper').style.display = "none";
        };

    </script>
    @yield('styles')
    <script src="//code.tidio.co/yovqpu02wdje7p9ojd8sjjskqhoouwyx.js" async></script>

</head>

<body onload="preloader()">
    <div id="loader-wrapper">
        <img loading="lazy" src="/storage/logo.png" alt="">
    </div>
    <div id="app">
        {{-- <a target="_blank" href="https://api.whatsapp.com/send?phone={{ env('whatsappPhno') }}&text=%20Hi,%20I%20have%20a%20query%20from%20{{ env('APP_URL') }}" class="whatsapp">
        <i class="fa-brands fa-whatsapp"></i>
        </a> --}}
        {{-- <a target="_blank" href="https://api.whatsapp.com/send?phone=98821 98821&text=%20Hi,%20I%20have%20a%20query%20from%20" class="whatsapp">
            <svg width="25" height="25" viewBox="0 0 25 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                <path fill-rule="evenodd" clip-rule="evenodd" d="M10.0754 0.276233C7.26563 0.898749 5.51321 1.88598 3.5134 3.97341C0.0667048 7.57111 -0.830204 12.6148 1.13945 17.3242L1.72983 18.7356L0.854211 21.8685C0.37264 23.5914 -0.0117499 25.0006 0.000274609 25C0.0122991 24.9992 1.52108 24.6083 3.35314 24.131L6.68392 23.2636L7.39415 23.6223C9.47479 24.673 12.4017 25.0272 14.8829 24.5288C19.5391 23.5933 23.0666 20.5069 24.4892 16.1233C24.9142 14.8138 25.0014 14.1776 25 12.3945C24.9972 8.79269 23.9253 6.19375 21.4053 3.67848C18.4011 0.679647 14.0936 -0.613663 10.0754 0.276233ZM15.1923 2.43247C18.8397 3.37455 21.831 6.38412 22.6834 9.96951C23.5117 13.4538 22.5017 17.038 19.9789 19.5664C17.9256 21.6238 15.4401 22.6567 12.5473 22.6546C10.8223 22.6534 9.98336 22.4591 8.16747 21.6406L6.85069 21.047L4.96422 21.5424C3.68075 21.8796 3.07894 21.9648 3.0817 21.8094C3.08406 21.6836 3.30346 20.8451 3.56958 19.946L4.05351 18.3112L3.58042 17.5028C2.25004 15.2299 1.88221 11.8851 2.68036 9.32256C3.68568 6.09564 6.58181 3.33546 9.91595 2.4266C11.2233 2.07029 13.801 2.07322 15.1923 2.43247ZM7.22226 7.20952C6.1304 8.36855 5.97113 10.0549 6.80121 11.6682C7.49981 13.0262 9.36696 15.1836 10.7135 16.189C12.2101 17.3064 14.6993 18.3558 15.8531 18.3558C16.7924 18.3558 18.2698 17.6115 18.598 16.9728C18.7321 16.7122 18.8429 16.2074 18.8444 15.8511C18.8472 15.2328 18.7776 15.1711 17.3258 14.506L15.804 13.809L15.0814 14.6164C14.6838 15.0607 14.2118 15.424 14.0325 15.424C13.1068 15.424 10.9611 13.8131 9.95419 12.3618L9.34547 11.4847L9.73519 11.0599C10.5996 10.118 10.613 9.89797 9.90806 8.25656C9.26978 6.77092 9.22957 6.7246 8.5217 6.66519C7.9183 6.61456 7.69437 6.70838 7.22226 7.20952Z"/>
            </svg>
        </a> --}}
        <nav class="navbar navbar-expand-md py-0 navbar-light bg-white shadow">
            <div class="container-fluid">
                <a class="navbar-brand" href="/">
                    <img loading="lazy" src="/storage/logo.png" class="logo-height" alt="">
                </a>
                <selectpincode class="ml-auto" style="z-index: 1" :sid="{{ json_encode(Session::get('address') ?? null) }}"></selectpincode>
                <ul class="d-md-none ml-3 navbar-nav">
                    <li class="nav-item">
                        <a href="/profile/cart" class="hov-red-wish nav-link position-relative">
                            <img loading="lazy" src="/storage/tryimg/vakilimg/icons/cart.svg" alt="">
                        </a>
                    </li>
                </ul>
                <button class="btn ml-3 navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle Expansion">
                    <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu">
                        <line x1="3" y1="12" x2="21" y2="12"></line>
                        <line x1="3" y1="6" x2="21" y2="6"></line>
                        <line x1="3" y1="18" x2="21" y2="18"></line>
                    </svg>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav w-100 d-none d-md-block">
                        <searchapp :user="{{ json_encode(Auth::user()??'') }}" :value="{{ json_encode(request()->get('searchname')??'') }}"></searchapp>
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-4 nav-sm">
                        <li class="nav-item hov-nav-title" data-tooltipval="Wishlist">
                            <a href="/profile/wishlist" class="hov-red-wish nav-link position-relative">
                                <img loading="lazy" src="/storage/tryimg/vakilimg/icons/heart.svg" alt="">
                                <span class="d-md-none ml-2"> View Wishlist </span>

                                {{-- @if($wishcount>0) --}}
                                <div class="badge badge-danger rounded-pill p-1" id='wishcount'> {{ $wishcount>0 ? $wishcount:'' }} </div>
                                {{-- @endif --}}
                            </a>
                        </li>
                        <li class="nav-item hov-nav-title" data-tooltipval="Cart">
                            <a href="/profile/cart" class="hov-red-wish nav-link position-relative">
                                <img loading="lazy" src="/storage/tryimg/vakilimg/icons/cart.svg" alt="">
                                <span class="d-md-none ml-2"> View Cart </span>
                                {{-- badge here --}}

                                {{-- @if($cartcount>0) --}}
                                <div class="badge badge-danger rounded-pill p-1" id='cartcount'> {{ $cartcount>0 ? $cartcount:'' }} </div>
                                {{-- @endif --}}
                            </a>
                        </li>
                        <!-- Authentication Links -->
                        @guest

                        <li class="nav-item hov-nav-title dropdown" data-tooltipval="Profile">
                            <a id="navbarDropdown" class="hov-red-wish nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img loading="lazy" src="/storage/tryimg/vakilimg/icons/user.svg" alt="">
                                <span class="d-md-none ml-2"> View Profile </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right pl-2" aria-labelledby="navbarDropdown">
                                <ul class="navbar-nav flex-column">
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('login') }}">
                                            {{ __('Login') }}
                                        </a>
                                    </li>
                                    @if (Route::has('register'))
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                    </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                        @else
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img loading="lazy" src="/storage/tryimg/vakilimg/icons/user.svg" alt="">
                                <span class="d-md-none ml-2"> View Profile </span>
                            </a>

                            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                <ul class="navbar-nav flex-column">

                                    <li class="nav-item">
                                        <span class="ml-3 color-prim font-prim mb-2"> {{ Auth::user()->name }}</span>
                                    </li>
                                    @if (Auth::check() && in_array(Auth::user()->type,[1,2,3]))
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="/admin">
                                            Admin Dashboard
                                        </a>
                                    </li>
                                    @endif
                                    <li class="nav-item">
                                        <a href="/profile" class="dropdown-item">
                                            Profile
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a href="/profile/orders" class="dropdown-item">
                                            Orders
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                                document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </div>
                        </li>
                        @endguest
                    </ul>
                    <ul class="navbar-nav d-md-none w-100">
                        <!-- Authentication Links -->
                        <li class="nav-item mx-3">
                            <a class="nav-link {{ request()->is('/') ? 'active' : '' }}" href="/">Home</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link {{ request()->is('/newproducts') ? 'active' : '' }}" href="/newproducts">New Products</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link {{ request()->is('/topselling') ? 'active' : '' }}" href="/topselling">Top Selling</a>
                        </li>
                        <li class="nav-item mx-3">
                            <a class="nav-link {{ request()->is('/contactus') ? 'active' : '' }}" href="/contactus">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        <nav class="navbar navbar-sec d-none d-md-block shadow py-0" style="border-top: 1px solid rgba(0, 0, 0, 0.075); background-color: #003d00; color: white; font-weight: bold">
            <div class="container-fluid">
                <ul class="w-100 navbar-nav" style="flex-direction: row; gap: 1rem;">
                    <li class="nav-item">
                        <a href="/" class="nav-link active">Home</a>
                    </li>
                    <li class="nav-item">
                        <a href="/topselling" class="nav-link">Top Selling</a>
                    </li>
                    <li class="nav-item">
                        <a href="/trendingproducts" class="nav-link">Trending Products</a>
                    </li>
                    @if ($categorieslist->count() > 0)
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Categories
                        </a>
                        <div class="dropdown-menu position-absolute" aria-labelledby="navbarDropdown">
                            <div class="container" style="width: clamp(350px, 30vw, 600px)">
                                <div class="row">
                                    @foreach ($categorieslist as $item)
                                    <div class="col-6 p-0">
                                        <a class="dropdown-item" href="/category/{{ $item->name }}">{{ $item->name }}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif


                    @if ($brandlist->count() > 0)
                    <li class="nav-item dropdown position-relative">
                        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            Brands
                        </a>
                        <div class="dropdown-menu position-absolute" aria-labelledby="navbarDropdown">
                            <div class="container" style="width: clamp(350px, 30vw, 700px)">
                                <div class="row">
                                    @foreach ($brandlist as $item)
                                    <div class="col-6 p-0">
                                        <a class="dropdown-item" href="/brand/{{ $item->name }}">{{ $item->name }}</a>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                    </li>
                    @endif
                </ul>
            </div>
        </nav>
        <nav class="d-md-none bg-prim px-3">
            <ul class="navbar-nav w-100">
                <searchapp :user="{{ json_encode(Auth::user()??'') }}" :value="{{ json_encode(request()->get('name')??'') }}"></searchapp>
            </ul>
        </nav>

        <main class="" style="min-height: 80vh;">
            @yield('content')
        </main>
        <div class="footer">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-3 col-md-6 col-sm-12">
                        <img loading="lazy" class="w-75 bg-white px-3" style="border-radius: 10px" src="/storage/logo.png" alt="">
                    </div>
                    <div class="col-lg-3 col-md-6 col-12">
                        <h6 class="font-weight-bold font-prim color-prim">Contact Us</h6>
                        <div class="contact">
                            <div class="address row">
                                <div class="col-2 col-sm-1 col-lg-2 address-box">
                                    <img loading="lazy" src="/storage/tryimg/vakilimg/icons/map-pin.svg" class="w-100">
                                </div>
                                <div class="col-10 col-sm-11 col-lg-10">
                                    Farm63</br>
                                    Trinity House, 2nd Floor, No 18,<br>
                                    4th Street Tirumurthi Nagar,<br>
                                    Nungambakam <br>
                                    Chennai - 600 0034.</br>
                                    Tamil Nadu <br>
                                </div>
                            </div>

                            <div class="address row">
                                <div class="col-2 col-sm-1 col-lg-2 address-box">
                                    <img loading="lazy" src="/storage/tryimg/vakilimg/icons/phone.svg" class="w-100">
                                </div>
                                <div class="col-10 col-sm-11 col-lg-10">
                                    <a class="text-light" href="tel:+91 98821 98821"> +91 98821 98821 </a>
                                </div>
                            </div>

                            <div class="address row">
                                <div class="col-2 col-sm-1 col-lg-2 address-box">
                                    <img loading="lazy" src="/storage/tryimg/vakilimg/icons/at-sign.svg" class="w-100">
                                </div>
                                <div class="col-10 col-sm-11 col-lg-10">
                                    <a class="text-light" href="mailto:cc@farm63.com"></i>cc@farm63.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mt-md-5 mt-lg-0 mt-4 col-12">

                        <h6 class="font-weight-bold font-prim color-prim">About</h6>
                        <ul class="navbar-nav">

                            <li class="nav-item">
                                <a href="/contactus" class="nav-link">Contact Us</a>
                            </li>

                            <li class="nav-item">
                                <a href="/aboutus" class="nav-link">About Us</a>
                            </li>

                            <li class="nav-item">
                                <a href="/faq" class="nav-link">FAQ's</a>
                            </li>
                            <li class="nav-item">
                                <a href="/termsandcondition" class="nav-link">Terms and Conditions</a>
                            </li>
                            <li class="nav-item">
                                <a href="/privacypolicy" class="nav-link">Privacy Policy</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 mt-md-5 mt-lg-0 mt-4 col-12">
                        <h6 class="font-weight-bold font-prim color-prim">Account</h6>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/profile" class="nav-link">Your Account</a>
                            </li>
                            <li class="nav-item">
                                <a href="/profile/wishlist" class="nav-link">Wishlist</a>
                            </li>
                            <li class="nav-item">
                                <a href="/profile/cart" class="nav-link">Cart</a>
                            </li>
                            <li class="nav-item">
                                <a href="/profile/orders" class="nav-link">Orders</a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 mt-md-5 mt-lg-0 mt-4 col-12">
                        <h6 class="font-weight-bold font-prim color-prim">Shop By</h6>
                        <ul class="navbar-nav">
                            <li class="nav-item">
                                <a href="/newproducts" class="nav-link">New Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="/topselling" class="nav-link">Top Selling</a>
                            </li>
                            <li class="nav-item">
                                <a href="/hotdeals" class="nav-link">Hot Deals</a>
                            </li>
                            <li class="nav-item">
                                <a href="/allproducts" class="nav-link">All Products</a>
                            </li>
                            <li class="nav-item">
                                <a href="/category" class="nav-link">Category</a>
                            </li>
                            {{-- <li class="nav-item">
                                <a href="/brand" class="nav-link">Brand</a>
                            </li> --}}
                        </ul>
                    </div>
                </div>
                <div class="row d-none d-md-block justify-content-end">
                    <div class="col text-right">
                        <img src="/storage/img/pay/pay.svg" alt="">
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid text-center py-1 bg-white">
            <a href="{{ env('APP_URL') }}" style="font-size: 0.8em"> Created and Maintained by &#169; Farm63 </a>
        </div>
    </div>
    @yield('scripts')
</body>

</html>
