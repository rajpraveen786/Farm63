@extends('layouts.app')

@section('content')

<div class="container">
    <div class="card mt-3 shadow border-0 card-body">
        <div class="row">
            <div class="col-lg-4 mt-0">
                <pagesimage :disp="{{ json_encode($data->disp) }}" :image="{{ json_encode($data->images) }}"></pagesimage>
            </div>

            <div class="col-lg-8 mt-2">

                <ol class="breadcrumb breadcrumb-bar" style="background-color: rgba(255, 255, 255, 0.7)">
                    <li class="breadcrumb-item d-inline"><a class='text-dark' href="/">Home </a></li>
                    <li class="breadcrumb-item d-inline"><a class='text-dark' style="pointer-events: none" href="">{{ $data->category->name??'' }} </a></li>
                    @if($data->subcategory)
                    <li class="breadcrumb-item d-inline"><a class='text-dark' style="pointer-events: none" href="">{{ $data->subsubcategory->name??'' }} </a></li>
                @endif

                    <li class="breadcrumb-item d-inline active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                        <h6 class="d-inline font-prim font-weight-bold"> {{$data->name}}</h6>
                    </li>
                </ol>

                <h4> {{ $data->name }}</h4>
                <div class="prod-deets">
                    <div class="ml-4 price">
                        <h5 class="mt-3">
                            <span class="price-new font-prim">Rs. {{ $data->fpricewtas }}</span>
                        </h5>
                        @if($data->disp)
                        <span class="price-old">Rs. {{ $data->fpricebefdis }}</span>
                        <span class="text-success"> You save Rs. {{ $data->fpricebefdis-$data->fpricewtas }}</span>
                        @endif
                    </div>
                    <pagesproducts :data="{{ json_encode($data) }}" :enablestsock="{{ $data->stock > 0 || ($data->oosc) ? 1 : 0 }}"  :link="{{ json_encode(env('APP_URL')) }}"></pagesproducts>
                </div>
                @if($data->stock>0 || $data->oosc)
                <div class="in-stock">
                    <i class="fas fa-check mr-2"></i> In Stock
                </div>
                @else
                <div class="border border-danger">
                    <i class="fas fa-times mr-2"></i> Out of Stock
                </div>
                @endif
                <table class="mt-3 table">
                    <tbody>
                        @if($data->brand)
                        <tr class="w-100">
                            <th> Brand </th>
                            <td>
                                <a class="font-prim color-prim" href="/brand/{{  $data->brand->name }}">
                                    <p class="">{{ $data->brand->name }}</p>
                                </a>
                            </td>
                        </tr>
                        @endif
                        @if($data->packing)
                        <tr class="w-100">
                            <th>Pack</th>
                            <td>{{ $data->packing->name??'' }}</td>
                        </tr>
                        @endif
                        @if($data->uom)
                        <tr class="w-100">
                            <th>Unit Of Measure</th>
                            <td>{{ $data->uom->name??'' }}</td>
                        </tr>
                        @endif
                        @if($data->tags && count($data->tags)>0)
                        <tr class="w-100">

                            <td colspan="12" class="badge-cont">
                                @php
                                $tags=$data->tags;
                                @endphp
                                @foreach ($tags as $item)
                                <a class="text-dark" href="/search?tags={{ $item }}">
                                    <div class="badge m-1 p-2 badge-pill badge-custom px-3">
                                        {{ $item }}</div>
                                </a>
                                @endforeach
                            </td>
                        </tr>
                        @endif
                    </tbody>
                </table>
                <descview class="mt-2 mb-1" :content="{{ json_encode($data->shortdesc??'') }}"></descview>
            </div>
        </div>
    </div>
    @php
    $attribute = json_decode($data->attribute)??[];
    @endphp

    @if(count($attribute))
    <hr>
    <div>
        <ul class="nav nav-tabs mb-3" id="pills-tab" role="tablist" style="margin-top:5vh;">
            <li class="nav-item" role="presentation">
                <a class="nav-link active">Product Description</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane fade card card-body show active" id="pills-productDescription" role="tabpanel" aria-labelledby="pills-productDescription-tab">
                <descview class="mt-2 mb-1" :content="{{ json_encode($data->desc??'') }}"></descview>
                <div class="container">
                    @foreach ($attribute as $item)
                    <div class="content">
                        <h4>{{ $item->key }}</h4>
                        <p>
                            <descview :content="{{ json_encode($item->value??'') }}"></descview>
                        </p>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <ul class="nav nav-tabs mb-2" id="pills-tab" role="tablist" style="margin-top:5vh;">
            <li class="nav-item" role="presentation">
                <a class="nav-link active">Reviews</a>
            </li>
        </ul>
        <div class="tab-content" id="pills-tabContent">
            <div class="tab-pane position-relative fade show active" id="pills-REVIEWS" role="tabpanel" aria-labelledby="pills-REVIEWS-tab">

                <pagesreview :data="{{ json_encode($data->review) }}" :pid="{{ json_encode($data->id) }}" :user="{{ json_encode(Auth::user()??'') }}"></pagesreview>
            </div>
        </div>

        @if($customeralsobought->count()>0)
        <div class="container" style="margin: 15vh auto; ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <h4 class="font-prim font-weight-bold text-uppercase">Bought Together</h4>
                </div>
                <div class="col-12 mt-3"></div>
            </div>
            <div class="bg-bluee py-2">
                <mscarousel carid="customeralsobought" :data="{{ json_encode($customeralsobought) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
            </div>
        </div>
        @endif

        @if($productrelatedtoitem->count()>0)
        <div class="container" style="margin: 15vh auto; ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <h4 class="font-prim font-weight-bold text-uppercase">Related to - {{ $data->name }}</h4>
                </div>
                <div class="col-12 mt-3"></div>
            </div>
            <div class="bg-bluee py-2">
                <mscarousel carid="relatedto" :data="{{ json_encode($productrelatedtoitem) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
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

        @if($trendingproducts->count()>0)
        <div class="container" style="margin: 15vh auto; ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <div class="float-right"><a href="/trendingproducts" class="btn link-success text-success font-weight-bold"> View More</a></div>

                    <h4 class="font-prim font-weight-bold text-uppercase">Trending Products</h4>
                </div>
                <div class="col-12 mt-3"></div>
            </div>
            <div class="bg-bluee py-2">
                <mscarousel carid="trendingprod" :data="{{ json_encode($trendingproducts) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
            </div>
        </div>
        @endif



        @if($topselling->count()>0)
        <div class="container" style="margin: 15vh auto; ">
            <div class="row align-items-center justify-content-center">
                <div class="col-12">
                    <div class="float-right"><a href="/topselling" class="btn link-success text-success font-weight-bold"> View More</a></div>
                    <h4 class="font-prim font-weight-bold text-uppercase">Top Selling</h4>
                </div>
                <div class="col-12 mt-3"></div>
            </div>
            <div class="bg-bluee py-2">
                <mscarousel carid="topselling" :data="{{ json_encode($topselling) }}" :user="{{ json_encode(Auth::user()??'') }}"></mscarousel>
            </div>
        </div>
        @endif

    </div>
</div>
@endsection
