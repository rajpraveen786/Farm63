<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    @yield('styles')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/admin.css') }}" rel="stylesheet">
    <script>
        function preloader() {
            document.getElementById('loader-wrapper').style.display = "none";
        };

    </script>
</head>

<body onload="preloader()">
    <div id="app">
        <div id="loader-wrapper">
            <img loading="lazy" src="/storage/logo.jpg" alt="" class="w-25">
        </div>
        <nav id="sidenav" class="navbar pt-2" onmouseover="openNav(1)" onmouseleave="openNav(0)">
            <button id="closebtn" class="btn" onclick="openNav()">&times;</button>
            <ul id="side-ul navbar-nav">
                <li class="side-li mt-2">
                    <a href="" class="side-a" style="pointer-events: none;">
                        <i class="fa fa-ellipsis-h fa-lg side-img side-divider" aria-hidden="true"></i>
                        <div class="side-text text-muted small">Dashboard</div>
                    </a>
                </li>
                <li class="side-li mt-2">
                    <a href="/admin" class="side-a {{ request()->is('admin/') ? 'active' : '' }}">
                        <i class="fa fa-radiation fa-lg side-img" aria-hidden="true"></i>
                        <div class="side-text">Home</div>
                    </a>
                </li>
                <li class="side-li mt-2">
                    <a href="" class="side-a" style="pointer-events: none;">
                        <i class="fa fa-ellipsis-h fa-lg side-img side-divider" aria-hidden="true"></i>
                        <div class="side-text text-muted small">Pages</div>
                    </a>
                </li>
                <li class="side-li">
                    <a data-toggle="collapse" id="dropdown" href="#dropdown-orders" class="mt-2 {{ request()->is('admin/orders*') ? 'active' : '' }} ">
                        <i class="fa fa-box side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            Orders
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>

                    <div id="dropdown-orders" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/orders/"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">All Orders</div>
                                </a></li>
                                <li><a href="/admin/orders/quick"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                        <div class="side-text">Quick Order</div>
                                    </a></li>
                            <li><a href="/admin/orders?type=1"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Pending</div>
                                </a></li>
                            <li><a href="/admin/orders?type=3"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Shipping</div>
                                </a></li>
                            <li><a href="/admin/orders?type=4"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Recieved</div>
                                </a></li>
                            <li><a href="/admin/orders?type=5"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Returned</div>
                                </a></li>
                            <li><a href="/admin/orders?type=7"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Canceled</div>
                                </a></li>
                        </ul>
                    </div>

                    <a data-toggle="collapse" id="dropdown" href="#dropdown-products" class="mt-2 {{ request()->is('admin/products*') ? 'active' : '' }} ">
                        <i class="fa fa-box side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            Products
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-products" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/products/"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">All Products</div>
                                </a></li>
                            <li><a href="/admin/products/inventory"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Inventory</div>
                                </a></li>
                                {{-- <li><a href="/admin/products/bulkupdate"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                        <div class="side-text">Bulk Update</div>
                                    </a></li> --}}
                        </ul>
                    </div>
                </li>

                <li class="side-li">
                    <a data-toggle="collapse" id="dropdown" href="#dropdown-discount" class="mt-2 {{ request()->is('admin/discount*') ? 'active' : '' }} ">
                        <i class="fa fa-percentage side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            Discount
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-discount" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/discounts/promocode"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Promo Code</div>
                                </a></li>
                            <li><a href="/admin/discounts/netdiscount"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Net Discounts</div>
                                </a></li>
                        </ul>
                    </div>
                </li>
                <li class="side-li mt-2">
                    <a href="/admin/customer" class="side-a {{ request()->is('admin/customer*') ? 'active' : '' }}">
                        <i class="fa fa-user fa-lg side-img" aria-hidden="true"></i>
                        <div class="side-text">Customer</div>
                    </a>
                </li>
                <li class="side-li mt-2">
                    <a href="" class="side-a" style="pointer-events: none;">
                        <i class="fa fa-ellipsis-h fa-lg side-img side-divider" aria-hidden="true"></i>
                        <div class="side-text text-muted small">Settings</div>
                    </a>
                </li>
                <li class="side-li">
                    <a data-toggle="collapse" id="dropdown" href="#dropdown-lvl1" class="mt-2 {{ request()->is('admin/master*') ? 'active' : '' }} ">
                        <i class="fa fa-toolbox side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            Master
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-lvl1" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/master/category"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Category</div>
                                </a></li>
                            <li><a href="/admin/master/subcategory"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Sub Category</div>
                                </a></li>
                            <li><a href="/admin/master/brand"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Brand</div>
                                </a></li>
                            <li><a href="/admin/master/attribute"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Attribute</div>
                                </a></li>
                                <li><a href="/admin/master/packing"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                        <div class="side-text">Packing</div>
                                    </a></li>
                            <li><a href="/admin/master/uom"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">UOM</div>
                                </a></li>
                            <li><a href="/admin/master/tags"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Tags</div>
                                </a></li>
                        </ul>
                    </div>
                </li>
                <li class="side-li">
                    <a data-toggle="collapse" id="dropdown" href="#dropdown-reports" class="mt-2 {{ request()->is('admin/reports*') ? 'active' : '' }} ">
                        <i class="fa fa-person-booth side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            Reports
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-reports" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/reports/lowstock"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Low Stock</div>
                                </a></li>
                            <li><a href="/admin/reports/stock"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Stock</div>
                                </a></li>
                            <li><a href="/admin/reports/sales"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                    <div class="side-text">Sales</div>
                                </a></li>
                                <li><a href="/admin/reports/returns"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                        <div class="side-text">Returns</div>
                                    </a></li>
                                    <li><a href="/admin/reports/productsold"><i style="font-size: 0.5rem" class="mr-1 far fa-circle"></i>
                                            <div class="side-text">Product Sold</div>
                                        </a></li>
                        </ul>
                    </div>
                </li>

                <li class="side-li mt-2">
                    <a href="/admin/banner" class="side-a {{ request()->is('admin/banner*') ? 'active' : '' }}">
                        <i class="fa fa-columns fa-lg side-img" aria-hidden="true"></i>
                        <div class="side-text">Banner</div>
                    </a>
                </li>

                <li class="side-li">
                    <a data-toggle="collapse" id="dropdown" href="#dropdown-general" class="mt-2">
                        <i class="fa fa-at side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            General
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-general" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/store" class="side-a {{ request()->is('admin/pincode*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-store fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">Store</div>
                            </a></li>
                            <li><a href="/admin/pincode" class="side-a {{ request()->is('admin/pincode*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-map-marker-alt fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">Pincode</div>
                            </a></li>
                            <li><a href="/admin/seo" class="side-a {{ request()->is('admin/seo*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-file-alt fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">SEO</div>
                            </a></li>
                            <li><a href="/admin/cms" class="side-a {{ request()->is('admin/cms*') ? 'active' : '' }}">
                                <i class="fa fa-dharmachakra fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">CMS</div>
                            </a></li>
                            <li><a href="/admin/pages" class="side-a {{ request()->is('admin/pages*') ? 'active' : '' }}">
                                <i class="fa fa-sticky-note fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">Pages</div>
                            </a></li>
                            <li> <a href="/admin/employee" class="side-a {{ request()->is('admin/employee*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-users fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">Employee</div>
                            </a></li>
                            <li><a href="/admin/newsletter" class="side-a {{ request()->is('admin/newsletter*') ? 'active' : '' }}">
                                <i class="fa fa-newspaper fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">NewsLetter</div>
                            </a></li>
                        </ul>
                    </div>
                </li>
                @if(Auth::user()->type==2)

                <li class="side-li">
                    <a data-toggle="collapse" id="dropdown" href="#dropdown-superadmin" class="mt-2">
                        <i class="fa fa-toolbox side-img fa-lg" aria-hidden="true"></i>
                        <div class="side-text">
                            Admin
                        </div>
                        <div class="float-right"><i class="fa fa-caret-down drop-icon mr-3"></i></div>
                    </a>
                    <!-- Dropdown level 1 -->
                    <div id="dropdown-superadmin" class="collapse side-dropdown">
                        <ul class="fa-ul">
                            <li><a href="/admin/logs" class="side-a {{ request()->is('admin/logs*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-clipboard-list fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">Logs</div>
                            </a></li>
                            <li><a href="/admin/importexport" class="side-a {{ request()->is('admin/importexport*') ? 'active' : '' }}">
                                <i class="fa fa-fw fa-id-card fa-lg side-img" aria-hidden="true"></i>
                                <div class="side-text">Import Export</div>
                            </a></li>
                        </ul>
                    </div>
                </li>
                @endif
                <li class="side-li mt-2">
                    <a href="/admin/reviews" class="side-a {{ request()->is('admin/reviews*') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-book-open fa-lg side-img" aria-hidden="true"></i>
                        <div class="side-text">Reviews</div>
                    </a>
                </li>
                <li class="side-li mt-2">
                    <a href="/admin/contact" class="side-a {{ request()->is('admin/contact*') ? 'active' : '' }}">
                        <i class="fa fa-fw fa-id-card fa-lg side-img" aria-hidden="true"></i>
                        <div class="side-text">Contact Us</div>
                    </a>
                </li>
                <li class="side-li mt-2">
                    <a onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="side-a">
                        <i class="fa fa-fw fa-sign-out-alt fa-lg side-img" aria-hidden="true"></i>
                        <div class="side-text">Logout</div>
                    </a>
                </li>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                    @csrf
                </form>
            </ul>
        </nav>
        <main class="" id="main">
            <div class="container mt-2 position-sticky" style="top: 0.6rem; z-index: 100">
                <div class="card shadow-custom d-flex flex-row justify-content-between position-relative">
                    <!-- <button class="menu" onclick="this.classList.toggle('opened');this.setAttribute('aria-expanded', this.classList.contains('opened'))" aria-label="Main Menu">
                        <svg width="100" height="100" viewBox="0 0 100 100">
                            <path class="line line1" d="M 20,29.000046 H 80.000231 C 80.000231,29.000046 94.498839,28.817352 94.532987,66.711331 94.543142,77.980673 90.966081,81.670246 85.259173,81.668997 79.552261,81.667751 75.000211,74.999942 75.000211,74.999942 L 25.000021,25.000058" />
                            <path class="line line2" d="M 20,50 H 80" />
                            <path class="line line3" d="M 20,70.999954 H 80.000231 C 80.000231,70.999954 94.498839,71.182648 94.532987,33.288669 94.543142,22.019327 90.966081,18.329754 85.259173,18.331003 79.552261,18.332249 75.000211,25.000058 75.000211,25.000058 L 25.000021,74.999942" />
                        </svg>
                    </button> -->
                    <svg class="svgdef">
                        <defs>
                            <filter id="gooeyness">
                                <feGaussianBlur in="SourceGraphic" stdDeviation="2.2" result="blur" />
                                <feColorMatrix in="blur" mode="matrix" values="1 0 0 0 0  0 1 0 0 0  0 0 1 0 0  0 0 0 20 -10" result="gooeyness" />
                                <feComposite in="SourceGraphic" in2="gooeyness" operator="atop" />
                            </filter>
                        </defs>
                    </svg>
                    <div class="plate plate2" onclick="openNav()" style="cursor: pointer" id="menu-burger">
                        <svg class="burger svgdef" version="1.1" height="100" width="100" viewBox="0 0 100 100">
                            <path class="line  line1" d="M 50,65 H 70 C 70,65 75,65.198488 75,70.762712 C 75,73.779026 74.368822,78.389831 66.525424,78.389831 C 22.092231,78.389831 -18.644068,-30.508475 -18.644068,-30.508475" />
                            <path class="line line2" d="M 50,35 H 70 C 70,35 81.355932,35.300135 81.355932,25.635593 C 81.355932,20.906215 78.841706,14.830508 72.881356,14.830508 C 35.648232,14.830508 -30.508475,84.322034 -30.508475,84.322034" />
                            <path class="line line3" d="M 50,50 H 30 C 30,50 12.288136,47.749959 12.288136,60.169492 C 12.288136,67.738339 16.712974,73.305085 40.677966,73.305085 C 73.791674,73.305085 108.47458,-19.915254 108.47458,-19.915254" />
                            <path class="line line4" d="M 50,50 H 70 C 70,50 81.779661,50.277128 81.779661,36.607372 C 81.779661,28.952694 77.941689,25 69.067797,25 C 39.95532,25 -16.949153,119.91525 -16.949153,119.91525" />
                            <path class="line line5" d="M 50,65 H 30 C 30,65 17.79661,64.618439 17.79661,74.152543 C 17.79661,80.667556 25.093813,81.355932 38.559322,81.355932 C 89.504001,81.355932 135.59322,-21.186441 135.59322,-21.186441" />
                            <path class="line line6" d="M 50,35 H 30 C 30,35 16.525424,35.528154 16.525424,24.152542 C 16.525424,17.535987 22.597755,13.559322 39.40678,13.559322 C 80.617882,13.559322 94.067797,111.01695 94.067797,111.01695" />
                        </svg>
                        <svg class="x svgdef" version="1.1" height="100" width="100" viewBox="0 0 100 100">
                            <path class="line" d="M 34,32 L 66,68" />
                            <path class="line" d="M 66,32 L 34,68" />
                        </svg>
                    </div>
                    <div class="p-2">
                        <div class="d-inline "><i onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="fa fa-sign-out-alt fa-lg nav-img mx-2" aria-hidden="true"></i></div>
                    </div>
                </div>
            </div>
            <div class="container">

                @if (Session::has('status'))
                <div class="alert alert-success">
                    {{ Session('status') }}
                </div>
                @endif
                @if (Session::has('error'))
                <div class="alert alert-danger">
                    {{ Session('error') }}
                </div>
                @endif
            </div>
            @yield('content')
        </main>
    </div>


    <script>
        var toggle = 0;
        const mediaQuery = window.matchMedia('(max-width: 576px)');
        const mediaQuery2 = window.matchMedia('(min-width: 577px) and (max-width: 850px)');

        var x = document.getElementsByClassName('side-text');
        var z = document.getElementsByClassName('side-divider');
        var w = document.getElementsByClassName('drop-icon');
        var v = document.getElementsByClassName('side-dropdown');

        for (var k = 0; k < z.length; k++) {
            z[k].style.display = 'inline';
        }

        document.getElementById('menu-burger').classList.add('not-active');
        document.getElementById('closebtn').style.display = "none";
        // sm
        if (mediaQuery.matches) {
            document.getElementById('sidenav').style.display = "none";
            document.getElementById('sidenav').style.position = "fixed";
            document.getElementById('main').style.width = "100%";
        }

        function openNav(val) {
            var ham = document.getElementById('menu-burger');
            if (val) {
                toggle = val

            } else {
                toggle = !toggle
            }
            if (toggle) {
                ham.classList.add('active');
                ham.classList.remove('not-active');

                for (var i = 0; i < x.length; i++) {
                    x[i].style.display = 'inline-block';
                }
                for (var k = 0; k < z.length; k++) {
                    z[k].style.display = 'none';
                }
                for (var l = 0; l < w.length; l++) {
                    w[l].style.display = 'inline';
                }
                // sm
                if (mediaQuery.matches) {

                    document.getElementById('closebtn').style.display = "block";
                    document.getElementById('sidenav').style.display = "block";
                    document.getElementById('sidenav').style.width = "70vw";
                    document.getElementById('menu-burger').classList.remove("active");

                } else {
                    // md
                    if (mediaQuery2.matches) {
                        document.getElementById('closebtn').style.display = "none";
                        document.getElementById('sidenav').style.width = "30vw";
                    }
                    // lg
                    else {
                        document.getElementById('closebtn').style.display = "none";
                        document.getElementById('sidenav').style.width = "20vw";
                    }
                }
            } else {
                ham.classList.remove('active');
                ham.classList.add('not-active');
                for (var i = 0; i < x.length; i++) {
                    x[i].style.display = 'none';
                }
                for (var k = 0; k < z.length; k++) {
                    z[k].style.display = 'inline';
                }
                for (var l = 0; l < w.length; l++) {
                    w[l].style.display = 'none';
                }
                for (var j = 0; j < v.length; j++) {
                    v[j].classList.remove('show');
                }
                document.getElementById('sidenav').style.width = "max-content";
                document.getElementById('closebtn').style.display = "none";
                const mediaQuery = window.matchMedia('(max-width: 576px)');
                // sm
                if (mediaQuery.matches) {
                    document.getElementById('sidenav').style.display = "none";
                    document.getElementById('main').style.width = "100%";
                }
            }
        }

    </script>
    <script src="{{ asset('js/app.js') }}"></script>
    @yield('scripts')

</body>

</html>
