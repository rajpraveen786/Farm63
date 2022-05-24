@extends('layouts.app')
@section('content')

<div class="container mt-5">
    <div class="shadow position-relative card mx-auto">
        <div class="circle"><i class="fa-solid fa-circle-xmark"></i></div>
        <div class="card-body text-center" style="margin-top: var(--mtcircle);">
            <h4 class="font-weight-bold text-uppercase">Product not found</h4>
            <p class="mt-4">
                We couldn't find what you were looking for, Click <a href="/" class="font-weight-bold"> Here </a> to continue shopping from our other products
            </p>
            <a href="/trendingproducts" class="btn btn-danger rounded-pill mt-3 px-4">View Trending Products</a>
        </div>
    </div>
</div>

@if($trendingproducts->count()>0)
<div class="container" style="margin: 15vh auto; ">
    <div class="row align-items-center justify-content-center">
        <div class="col-12">
            <div class="float-right"><a href="/trendingproducts"> View More</a></div>
            <h4 class="font-prim font-weight-bold text-uppercase">Trending Products</h4>
        </div>
        <div class="col-12 mt-3"></div>
    </div>
    <div class="bg-bluee py-2">
        <mscarousel carid="trending" :data="{{ json_encode($trendingproducts) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
    </div>
</div>
@endif



@if($topselling->count()>0)
    <div class="container" style="margin: 15vh auto; ">
        <div class="row align-items-center justify-content-center">
            <div class="col-12">
                <div class="float-right"><a href="/topselling"> View More</a></div>
                <h4 class="font-prim font-weight-bold text-uppercase">Top Selling</h4>
            </div>
            <div class="col-12 mt-3"></div>
        </div>
        <div class="bg-bluee py-2">
            <mscarousel carid="topselling"  :data="{{ json_encode($topselling) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
        </div>
    </div>
@endif
@if($topdeals->count()>0)
<div class="container" style="margin: 15vh auto; ">
    <div class="row align-items-center justify-content-center">
        <div class="col-12">
            <h4 class="font-prim font-weight-bold text-uppercase">Top Deals</h4>
        </div>
        <div class="col-12 mt-3"></div>
    </div>
    <div class="bg-bluee py-2">
        <mscarousel carid="topdeals" :data="{{ json_encode($topdeals) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
    </div>
</div>
@endif
@if($newproducts->count()>0)
<div class="container" style="margin: 15vh auto; ">
    <div class="row align-items-center justify-content-center">
        <div class="col-12">
            <h4 class="font-prim font-weight-bold text-uppercase">New Products</h4>
        </div>
        <div class="col-12 mt-3"></div>
    </div>
    <div class="bg-bluee py-2">
        <mscarousel carid="newproduct" :data="{{ json_encode($newproducts) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
    </div>
</div>
@endif
@endsection
