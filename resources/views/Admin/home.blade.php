@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <div class="row">
        <div class="col-sm-12 col-md-8">

            <ol class="breadcrumb" style="background-color: transparent">
                <li class="breadcrumb-item h3 active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                    DashBoard</li>
            </ol>
        </div>
        <div class="col-md-4 col-sm-12">
            <div class="form-group ">
                <select class="input-hov form-control" name="type" id="greet" onchange="getOption()">
                    <option @if(!request()->get('type') || request()->get('type')==1) selected @endif value="1">Today</option>
                    <option @if(request()->get('type')==2) selected @endif value="2">This Week</option>
                    <option @if(request()->get('type')==3) selected @endif value="3">This Month</option>
                    <option @if(request()->get('type')==4) selected @endif value="4">This Year</option>
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-6 col-md-3">
            <div class="card mt-4 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="dash-img col-lg-4 col-md-12 col-sm-12 text-center w-100">
                            <svg width="533" height="535" viewBox="0 0 533 535" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="266.138" cy="266.003" r="266" fill="black"/>
                                <path d="M169.259 380.948C137.852 390.388 104.702 434.895 89.4666 460.152C87.959 462.651 88.6001 465.892 90.8771 467.718C227.507 577.294 377.82 523.588 431.395 473.271C433.327 471.457 433.693 468.59 432.371 466.293C406.638 421.607 367.6 394.055 350.234 384.344C348.314 383.27 345.942 383.457 344.103 384.661C272.078 431.827 202.708 403.76 174.42 382.019C172.941 380.882 171.045 380.411 169.259 380.948Z" fill="white"/>
                                <path d="M364.681 252.411C364.291 280.023 323.483 372.341 259.49 371.437C194.102 363.013 157.312 277.099 157.702 249.487C159.517 121 235.395 122.072 263.007 122.462C290.618 122.852 366.496 123.924 364.681 252.411Z" fill="#FFFCFC"/>
                            </svg>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 dash-text">
                            <h4 class="font-weight-bold">{{ $customercount }}</h4>
                            <h6 class="small text-muted">Customers</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-6 col-md-3">
            <div class="card mt-4 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="dash-img col-lg-4 col-md-12 col-sm-12 text-center w-100">
                            <svg width="532" height="532" viewBox="0 0 532 532" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <circle cx="266" cy="266" r="266" fill="black"/>
                                <path d="M420 199.227L277.067 260.366V441.5L420 337.203V199.227Z" fill="white"/>
                                <path d="M111 199.227L256.412 260.366V441.5L111 337.203V199.227Z" fill="white"/>
                                <path d="M126.698 185.182L267.152 242.19L403.476 185.182L267.152 129L126.698 185.182Z" fill="white"/>
                                </svg>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 dash-text">
                            <h4 class="font-weight-bold">{{ $prodcount }}</h4>
                            <h6 class="small text-muted">Products</h6>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="col-6 col-md-3">
            <div class="card mt-4 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="dash-img col-lg-4 col-md-12 col-sm-12 text-center w-100">
                            <svg width="532" height="532" viewBox="0 0 532 532" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M266 0C119.28 0 0 119.28 0 266C0 412.72 119.28 532 266 532C412.72 532 532 412.72 532 266C532 119.28 412.72 0 266 0ZM362.879 173.6H306.879C314.16 183.678 319.199 195.44 322 207.76H362.879V248.08L322 248.076C313.039 290.635 274.961 322.556 229.602 322.556H220.082L326.483 430.636L267.124 430.64L169.124 331.519V279.999H229.603C251.443 279.999 269.923 266.558 277.763 248.077H169.124V207.757H277.763C269.924 188.718 251.443 175.835 229.603 175.835L169.124 175.839V133.28H362.323V173.6L362.879 173.6Z" fill="black"/>
                            </svg>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 dash-text">
                            <h4 class="font-weight-bold">{{ $revenue??0 }}</h4>
                            <h6 class="small text-muted">Revenue</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-6 col-md-3">
            <div class="card mt-4 shadow">
                <div class="card-body">
                    <div class="row">
                        <div class="dash-img col-lg-4 col-md-12 col-sm-12 text-center w-100">
                            <svg width="532" height="532" viewBox="0 0 532 532" fill="none" xmlns="http://www.w3.org/2000/svg">
                                <path d="M465.497 349.269V449.02C465.497 453.428 463.746 457.659 460.629 460.776C457.511 463.893 453.281 465.645 448.872 465.645H442.887C439.539 464.42 436.686 462.13 434.763 459.128C432.841 456.122 431.958 452.575 432.247 449.019V349.269C432.247 343.328 435.416 337.839 440.56 334.871C445.703 331.902 452.041 331.902 457.185 334.871C462.328 337.839 465.497 343.328 465.497 349.269V349.269Z" fill="black"/>
                                <path d="M465.497 515.52C465.549 519.928 463.738 524.155 460.51 527.157C459.103 528.842 457.266 530.108 455.188 530.816C453.114 531.31 450.95 531.31 448.872 530.816C444.508 530.753 440.345 528.979 437.279 525.877C434.214 522.771 432.489 518.585 432.481 514.224C432.474 509.86 434.181 505.667 437.235 502.554C440.526 499.93 444.675 498.627 448.872 498.895C450.839 498.427 452.891 498.427 454.858 498.895C456.933 499.603 458.773 500.869 460.176 502.554C463.898 505.793 465.872 510.599 465.498 515.519L465.497 515.52Z" fill="black"/>
                                <path d="M531.998 266.144C532.031 206.743 512.178 149.037 475.606 102.231C439.031 55.421 387.842 22.2004 330.199 7.86485C272.553 -6.47449 211.762 -1.1008 157.526 23.1238C103.287 47.3451 58.7166 89.0302 30.9195 141.523C3.12436 194.022 -6.30157 254.316 4.14846 312.789C14.5947 371.263 44.3193 424.557 88.5762 464.182C132.837 503.803 189.086 527.472 248.357 531.413C307.629 535.354 366.518 519.342 415.624 485.928C405.011 476.606 398.947 463.147 398.999 449.019V349.268C398.999 331.448 408.507 314.983 423.937 306.076C439.367 297.166 458.382 297.166 473.812 306.076C489.242 314.983 498.749 331.448 498.749 349.268V394.49C520.64 355.258 532.089 311.069 531.999 266.145L531.998 266.144ZM299.247 282.769V284.432C299.373 285.537 299.373 286.651 299.247 287.757V290.417L297.25 293.078L294.924 295.405L195.173 361.905C191.666 364.636 187.314 366.046 182.872 365.894C177.313 365.842 172.114 363.122 168.908 358.58C166.484 354.862 165.612 350.342 166.484 345.992C167.353 341.64 169.895 337.802 173.561 335.305L265.997 273.792V116.519C265.997 110.578 269.166 105.09 274.31 102.121C279.453 99.1523 285.792 99.1523 290.935 102.121C296.078 105.09 299.247 110.578 299.247 116.519L299.247 282.769Z" fill="black"/>
                            </svg>
                        </div>
                        <div class="col-lg-8 col-md-12 col-sm-12 dash-text">
                            <h4 class="font-weight-bold">{{ $netorders }}</h4>
                            <h6 class="small text-muted">Pending</h6>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
    <mainchart class="mt-4" :products="{{ json_encode($products) }}" :orders="{{ json_encode($orders) }}"></mainchart>
    <div class="row">
        <div class="col-sm-12 mt-3 col-md-6">
            <div class="card shadow">
                <div class="card-body">

                    <h5 class="font-weight-bold font-prim color-prim">Top Selling by Items</h5>
                    @if($soldproducts->count()>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th style="width:20%">Image</th>
                                <th>Name</th>

                                <th>No fo Times Ordered</th>
                                <th>Qty sold</th>
                            </tr>
                        </thead>
                        @for($i=0;$i<$soldproducts->count();$i++)
                            <tbody>
                                @if($soldproducts[$i]->adminproducts)
                                <tr>
                                    <th><img loading="lazy" class="w-100" src="/{{ $soldproducts[$i]->adminproducts->image->loc }}" alt="{{ $soldproducts[$i]->adminproducts->name??'' }}"> </th>
                                    <th>{{ $soldproducts[$i]->adminproducts->name??'' }}</th>
                                    <th>{{ $soldproducts[$i]->count_pid }}</th>
                                    <th>{{ $soldproducts[$i]->qty }}</th>
                                </tr>
                                @endif
                            </tbody>
                            @endfor
                    </table>

                    </ul>
                    @else
                    <div class="alert alert-danger">
                        Sorry No Prodcut Found
                    </div>
                    @endif

                </div>
            </div>
        </div>
        <div class="col-sm-12 mt-3 col-md-6">
            <div class="card shadow">
                <div class="card-body">
                    <h5 class="font-weight-bold font-prim color-prim">Top Selling Locations</h5>
                    @if($soldpincode->count()>0)
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Pincode</th>
                                <th>No fo Orders</th>
                            </tr>
                        </thead>
                        @for($i=0;$i<$soldpincode->count();$i++)
                            <tbody>
                                @if($soldpincode[$i])
                                <tr>
                                    <th>{{ $soldpincode[$i]->pincodeid }}</th>
                                    <th>{{ $soldpincode[$i]->count }}</th>
                                </tr>
                                @endif
                            </tbody>
                            @endfor
                    </table>

                    </ul>
                    @else
                    <div class="alert alert-danger">
                        Sorry No Prodcut Found
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>
<script type="application/javascript">
    function getOption() {
        window.location = "/admin?type=" + document.getElementById('greet').value;
    }

</script>
@endsection
