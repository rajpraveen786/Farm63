@extends('layouts.app')

@section('content')

@if($banner->count()>0)

<div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
    <ol class="carousel-indicators">
        @for($i=0;$i<$banner->count();$i++)
            <li data-target="#carouselExampleIdicators" data-slide-to="{{ $i }}" @if($i==0) class="active" @endif></li>
            @endfor
    </ol>
    <div class="carousel-inner carousel-h">
        @for($i=0;$i<$banner->count();$i++)
            <div class="carousel-item @if($i==0) active @endif">
                @if($banner[$i]->link)
                <a href="{{ $banner[$i]->link }}">
                    @endif
                    <img loading="lazy" class="w-100" src="/{{ $banner[$i]->loc }}" alt="First slide">
                    @if($banner[$i]->name||$banner[$i]->desc)
                    <div class="home-car-text">
                        @if($banner[$i]->name)
                        <h4 class="font-prim font-weight-bold">{{ $banner[$i]->name }}</h4>
                        @endif
                        @if($banner[$i]->desc)
                        <p class="">
                            {{ $banner[$i]->desc }}
                        </p>
                        @endif
                    </div>
                    @endif
                    @if($banner[$i]->link)
                </a>
                @endif
            </div>
            @endfor
    </div>
    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="sr-only">Previous</span>
    </a>
    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="sr-only">Next</span>
    </a>
</div>
@endif

@if($comboproduct->count())
<div class="container position-relative" style="margin: 5vh auto;">
    <div class="float-right"><a href="/comboproducts" class="btn link-success text-success font-weight-bold"> View More</a></div>
    <h4 class="after  font-weight-bold font-prim text-capitalise">Combo Prodcuts</h4>
    <div class="bg-bluee py-2">
        <mscarousel carid="comboproduct" :data="{{ json_encode($comboproduct) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
    </div>
</div>
@endif

@if($category->count())
<div class="bg-bluee" style="padding: 5vh 1vh">
    <div class="container position-relative p-2">
        <div class="float-right"><a href="/category" class="btn link-success text-success font-weight-bold"> View More</a>
        </div>
        <h4 class="after  font-weight-bold font-prim text-capitalise">Shop By Category</h4>
        <mscarouselcat carid="category" link="category" :data="{{ json_encode($category) }}"></mscarouselcat>
    </div>
</div>
@endif

@if($topselling->count())
<div class="container position-relative" style="margin: 5vh auto;">
    <div class="float-right"><a href="/topselling" class="btn link-success text-success font-weight-bold"> View More</a>
    </div>
    <h4 class="after  font-weight-bold font-prim text-capitalise">Top Selling</h4>
    <div class="bg-bluee py-2">
        <mscarousel carid="topselling" :data="{{ json_encode($topselling) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
    </div>
</div>
@endif


@if($brand->count())
<div class="container position-relative mt-5 p-2">
    <div class="float-right"><a href="/brand" class="btn link-success text-success font-weight-bold"> View More</a></div>
    <h4 class="after  font-weight-bold font-prim text-capitalise">Shop By Brand</h4>
    <mscarouselcat carid="brand" link="brand" :data="{{ json_encode($brand) }}"></mscarouselcat>
</div>
@endif

@if($trendingproducts->count())
<div class="container position-relative" style="margin: 5vh auto;">
    <div class="float-right"><a href="/trendingproducts" class="btn link-success text-success font-weight-bold"> View More</a></div>
    <h4 class="after  font-weight-bold font-prim text-capitalise">Trending Prodcuts</h4>
    <div class="bg-bluee py-2">
        <mscarousel carid="trendingproducts" :data="{{ json_encode($trendingproducts) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
    </div>
</div>
@endif


@if($topdeals->count())
<div class="container" style="margin: 5vh auto; ">
    <div class="row position-relative align-items-center justify-content-center">
        <div class="col-12">
            <div class="float-right"><a href="/hotdeals" class="btn link-success text-success font-weight-bold"> View
                    More</a></div>
            <h4 class="after font-prim font-weight-bold text-capitalise w-100">Top Deals</h4>
        </div>
        <div class="col-12 mt-3"></div>
    </div>
    <div class="bg-bluee py-2">
        <mscarousel carid="topdeals" :data="{{ json_encode($topdeals) }}" :user="{{ json_encode(Auth::user()??'') }}">
        </mscarousel>
    </div>
</div>
@endif

<!-- Category of Products -->
@for($i=0;$i<$catprod->count();$i++)
    @if($catprod[$i]->products->count()>0)
    <div class="container" style="margin: 5vh auto; ">
        <div class="row position-relative align-items-center justify-content-center">
            <div class="col-12">
                <div class="float-right"><a href="/category/{{$catprod[$i]->name}}" class="btn link-success text-success font-weight-bold"> View More</a></div>
                <h4 class="after font-prim font-weight-bold text-capitalise w-100">{{$catprod[$i]->name}}</h4>
            </div>
            <div class="col-12 mt-3"></div>
        </div>
        <div class="bg-bluee py-2">
            <mscarousel :carid="{{ json_encode('category'.$catprod[$i]->name??'') }}" :data="{{ json_encode($catprod[$i]->products) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
        </div>
    </div>
    @endif
    @endfor

    @php
    $pagescolhome=$pagescollection ? json_decode($pagescollection->banner) : [];
    @endphp
    @if(count($pagescolhome)>0)
        <div class="container" style="margin: 4rem auto">
            <h4 class="after font-prim font-weight-bold text-capitalise w-100">Hot Deals</h4>
            <carouselsub class="mt-2" carid="hotdeals" :data="{{ json_encode($pagescolhome) }}"></carouselsub>
        </div>
    @endif
    <!-- menu banner -->
    <!-- categories 1234 -->
    <div class="container-fluid" style="margin-top: 1rem; padding-bottom: 10vh">
        <div class="row w-75 mx-auto justify-content-center">
            <div class="col-lg-3 col-md-6 col-10 text-center">
                <div class="fa-box-custom">
                    <img loading="lazy" class="w-50 mx-auto" src="/storage/tryimg/vakilimg/icons/phone-call.svg" alt="Phone">
                </div>
                <div class="font-prim text-capitalise font-weight-bold">Quick Customer Support - 9to9, Sun-Sat.</div>
            </div>

            <div class="col-lg-3 col-md-6 col-10 text-center">
                <div class="fa-box-custom">
                    <img loading="lazy" class="w-50 mx-auto" src="/storage/tryimg/vakilimg/icons/dollar-sign.svg" alt="Value for money">
                </div>
                <div class="font-prim text-capitalise font-weight-bold">Value for money guaranteed</div>
            </div>

            <div class="col-lg-3 col-md-6 col-10 text-center">
                <div class="fa-box-custom">
                    <img loading="lazy" class="w-50 mx-auto" src="/storage/tryimg/vakilimg/icons/inbox.svg" alt="delivery">
                </div>
                <div class="font-prim text-capitalise font-weight-bold">Delivery always within promised schedule</div>
            </div>

            <div class="col-lg-3 col-md-6 col-10 text-center">
                <div class="fa-box-custom">
                    <img loading="lazy" class="w-50 mx-auto" src="/storage/tryimg/vakilimg/icons/truck.svg" alt="greate deals">
                </div>
                <div class="font-prim text-capitalise font-weight-bold">Great deals, exciting prices every. single. time.
                </div>
            </div>
        </div>
    </div>
    @if(strlen($cms->desc))
        <div class="container bg-white shadow my-3 p-4" style="border-radius: 5px; border-left: 3px solid var(--greeen);border-right: 3px solid var(--greeen)">
            <descview :content="{{json_encode($cms->desc)}}" style="word-break: break-all;"></descview>
        </div>
    @endif


    @endsection
