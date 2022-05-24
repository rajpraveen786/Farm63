@extends('layouts.app')
@section('styles')
<style>
    #mx-0{
        margin: 0.1rem 0 !important;
    }
    .card-prod-ms .img-prod-ms {
        width: 100%;
    }
</style>
@endsection
@section('content')
<section class="container-fluid mt-3 mb-3">
        <div class="text-center mt-4 mb-2">
            <ol class="breadcrumb breadcrumb-bar p-0" style="background-color: transparent">
                <li class="breadcrumb-item"><a class='text-dark' href="/">Home </a></li>
                <li class="breadcrumb-item active font-prim font-weight-bold" aria-current="page" style="color: var(--prim)">
                    {{ $title }} </li>
            </ol>
            <h2 style="font-size:30px"><span>{{ $title }} </span></h2>
            <hr>
        </div>
        @if($data->count()>0)
            <div class="row justify-content-center">
                @for($i=0;$i<$data->count();$i++)
                    <div class="col-10 col-sm-6 col-md-3 col-lg-2 mt-3">
                        <msproductgen :data="{{ json_encode($data[$i]) }}" ></msproductgen>
                    </div>
                @endfor
            </div>
        @else
            <div class="text-center card p-3 shadow mt-5 h3">
                <div class="row justify-content-center align-items-center">
                    <div class="col-md-5">
                        <img loading="lazy" src="/storage/img/nodata.jpg" alt="" class="w-100 w-nodata mx-auto">
                    </div>
                    <div class="col-md-5">
                        <div style="font-size: 0.8em" class="font-prim ">
                            <h5 class="text-center font-weight-bold">! Data Unavailable !</h5>
                            We didnt find any products, Click <a href="/" class="btn-link">Here</a> to continune shopping
                        </div>
                    </div>
                </div>
            </div>
        @endif
</section>


@endsection
