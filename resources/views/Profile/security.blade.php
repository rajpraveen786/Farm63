@extends('layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12" style="background-color: #FE6443; border-bottom-right-radius: 20px; border-bottom-left-radius: 20px">
            <div class="position-absolute profile-cont">
                <h4 class="">Welcome, {{ Auth::user()->name }}</h4>
                <h2 class="font-weight-bold mb-4" style="font-family: Arial, Helvetica, sans-serif;">Your Profile</h2>
                <div class="btn btn-black">Your Orders</div>
                <div class="btn btn-black">Track Orders</div>
                <div class="btn btn-black">Cancel Orders</div>
                <div class="btn btn-black">Return Orders</div> <br>
                <div class="btn btn-black btn-block mt-4">Return Orders</div> <br>
            </div>

            <img loading="lazy" src="/storage/img/profile.svg" alt="" class="float-right profile-img">
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row my-4">
        <div class="col-md-6 col-12 col-lg-3 mt-3">
            <a href="/cart">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-3"><i class="fa fa-shopping-bag fa-lg" style="font-size:60px;color:var(--prim)" aria-hidden="true"></i>
                            </div>
                            <div class="col-lg-8 col-md-8 col-9">
                                <h6 class="font-weight-bold text-muted">Cart</h6>
                                <h6 class="">A shopping cart helps to the purchase of a product.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-12 col-lg-3 mt-3">
            <a href="">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-3"><img loading="lazy" src="/storage/img/orders.svg" alt="" class="w-100"></div>
                            <div class="col-lg-8 col-md-8 col-9">
                                <h6 class="font-weight-bold text-muted">View Orders</h6>
                                <h6 class="">Review, Track, Return, Cancel existing orders</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-12 col-lg-3 mt-3">
            <a href="/profile/address">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-3"><img loading="lazy" src="/storage/img/address.svg" alt="" class="w-100"></div>
                            <div class="col-lg-8 col-md-8 col-9">
                                <h6 class="font-weight-bold text-muted">Delivery Address</h6>
                                <h6 class="">Edit delivery address for placed orders</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-12 col-lg-3 mt-3">
            <a href="/profile/security">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-3"><img loading="lazy" src="/storage/img/login.svg" alt="" class="w-100"></div>
                            <div class="col-lg-8 col-md-8 col-9">
                                <h6 class="font-weight-bold text-muted">Login And Security</h6>
                                <h6 class="">Edit Login Name and Mobile No.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
        <div class="col-md-6 col-12 col-lg-3 mt-3">
            <a href="{{ route('wishlist') }}">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-4 col-md-4 col-3"><img loading="lazy" src="/storage/img/pay.svg" alt="" class="w-100"></div>
                            <div class="col-lg-8 col-md-8 col-9">
                                <h6 class="font-weight-bold text-muted">WishList</h6>
                                <h6 class="">Change or Edit preferred payment methods.</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </a>
        </div>
    </div>
</div>
@endsection
