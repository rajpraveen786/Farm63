
@extends('layouts.app')

@section('content')
<section class="section-tb-padding-bg-image" style="min-height: 80vh; background-image: url('/storage/img/farm/news-popup.jpg')">
    <div class="container pt-2">
        <div class="row text-center px-4 align-items-center justify-content-center">
            <div class="col-md-7 card card-body">
                <img src="/storage/logo.webp" class="w-75 mx-auto" alt="">
            </div>
            <div class="col-md-7 card card-body">
                <h2 class="font-weight-bold color-prim font-prim">! 404 Error !</h2>
                <h6 class="font-prim mt-3">
                    You seem to have reached a broken page <br> <br>
                    Please check your <span class="color-prim"> URL</span> <br> <span class="small">(or)</span> <br>
                    Click <a href="/" class="nav-link d-inline color-prim px-0">here</a> to continue shopping <br>
                </h6>
            </div>
        </div>
    </div>
</section>
@endsection
