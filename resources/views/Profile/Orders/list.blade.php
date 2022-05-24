@extends('layouts.profile')

@section('subcontent')
<div style=" min-height: 80vh; padding-bottom: 5vh">

    <div class="container">

        <div class="dropdown pt-1 float-right">
            <button class="btn px-2 btn-login-custom dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              @if($type==-1 || $type==null) All
              @elseif($type==0) Pending
              @elseif($type==1) Approved
              @elseif($type==2) Out for Delivery
              @elseif($type==3) Delivered
              @elseif($type==4) Returned
              @elseif($type==5) Not attend
              @elseif($type==6) Canceled
              @endif
            </button>
            <div class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
              <a class="dropdown-item" href="/profile/orders/">All</a>
              <a class="dropdown-item" href="/profile/orders?type=0">Pending</a>
              <a class="dropdown-item" href="/profile/orders?type=1">Approved</a>
              <a class="dropdown-item" href="/profile/orders?type=2">Out for Delivery</a>
              <a class="dropdown-item" href="/profile/orders?type=3">Delivered</a>
              <a class="dropdown-item" href="/profile/orders?type=4">Returned</a>
              <a class="dropdown-item" href="/profile/orders?type=5">Not attend</a>
              <a class="dropdown-item" href="/profile/orders?type=6">Canceled</a>
            </div>
        </div>

        <ol class="mt-3 w-md-50 breadcrumb breadcrumb-bar" id="bread" style="background-color: transparent">
            <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Your Orders</li>
        </ol>

    </div>

    <div class="container mt-3">
        @if($data->count()>0)
        @for($i=0;$i<$data->count();$i++)
            <div class="card position-relative shadow px-3 mt-4" style="border: 1px solid rgba(0, 0, 0, 0.3);">
                <div class="repeat dropleft">
                    <button class="btn btn-success rounded-pill" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-bars"></i>
                    </button>
                    <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">

                      @if(in_array($data[$i]->status,[0,1]) && in_array($data[$i]->paystatus,[0,2]) && in_array($data[$i]->paytype,[0]))
                        <a
                            class="dropdown-item"
                            href="/profile/orders/pay/{{ encrypt($data[$i]->id) }}"
                        >
                            Pay Now
                        </a>
                      @endif
                      @if(in_array($data[$i]->status,[3]) && in_array($data[$i]->paystatus,[0,1,2]) && in_array($data[$i]->paytype,[0,1]))
                        <a
                            onclick="return confirm('Are you sure you want to return the order?');"
                            class="dropdown-item"
                            href="/profile/orders/returns/{{ encrypt($data[$i]->id) }}"
                        >
                            Return
                        </a>
                      @endif
                        <a
                            class="dropdown-item"
                            href="/profile/orders/{{ encrypt($data[$i]->id) }}"
                        >
                            View Order
                        </a>
                      @if($data[$i]->paystatus==1)
                        <a
                            class="dropdown-item"
                            href="/profile/orders/invoice/{{ encrypt($data[$i]->id) }}"
                        >
                            Invoice
                        </a>
                      @endif
                      @if(in_array($data[$i]->status,[0,1,5]) && in_array($data[$i]->paystatus,[0,1,2]) && in_array($data[$i]->paytype,[0,1]))
                        <a
                            onclick="return confirm('Are you sure you want to cancel the order?');"
                            class="dropdown-item"
                            style="color: rgb(200, 0 ,0)"
                            href="/profile/orders/cancel/{{ encrypt($data[$i]->id) }}"
                        >
                            Cancel Order
                        </a>
                      @endif
                    </div>
                </div>
                <div class="row card-header font-prim" style="background-color: #f7f5f5;">
                    <div class="col-lg-2 col-md-4 col-6">
                        <span class="small text-muted font-weight-bold">Date </span> <br>
                        {{ date('d F Y',strtotime($data[$i]->created_at)) }}
                    </div>
                    <div class="col-lg-2 col-md-2 col-6">
                        <span class="small text-muted font-weight-bold">Total </span> <br>
                        Rs. {{ $data[$i]->total }}
                    </div>

                    <div class="col-lg-2 col-md-2 col-6 offset-lg-4 text-lg-right">
                        <span class="small text-muted font-weight-bold">OrderID </span> <br>
                        {{$data[$i]->invno}}
                    </div>

                    <div class="col-lg-2 col-md-3 col-6 text-lg-right">
                        <span class="small text-muted font-weight-bold">Order Status : </span>
                        <div class="status">
                            @if($data[$i]->status==0)
                            <span class="" style="--colorstatus: #0B4619">Pending</span>
                            @elseif($data[$i]->status==1)
                            <span class="" style="--colorstatus: rgb(32, 0, 146)">Order Approved</span>
                            @elseif($data[$i]->status==2)
                            <span class="" style="--colorstatus: #1A5F7A">Out for Delivery</span>
                            @elseif($data[$i]->status==3)
                            <span class="" style="--colorstatus: #95CD41">Delivered</span>
                            @elseif($data[$i]->status==4)
                            <span class="" style="--colorstatus: #B3541E">Returned</span>
                            @elseif($data[$i]->status==5)
                            <span class="" style="--colorstatus: #FFC900">Not Attended</span>
                            @elseif($data[$i]->status==6)
                            <span class="" style="--colorstatus: #9B0000">Order Cancelled</span>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <div class="cart-head mb-4">
                        Items: <span class="c-items color-prim"> &lpar;{{ $data[$i]->ordersub->count() }}&rpar;</span>
                    </div>

                    @for($j=0;$j<$data[$i]->ordersub->count();$j++)
                        <div class="row mt-3">
                            <div class="col-lg-1 col-2 p-0">
                                <a target="_blank" href="/products/{{ $data[$i]->ordersub[$j]->urlslug }}"><img loading="lazy" src="/{{ $data[$i]->ordersub[$j]->image->loc }}" class="img-fluid" alt="{{ $data[$i]->ordersub[$j]->name }}"></a>
                            </div>
                            <div class="col-lg-8 col-7">
                                <h6 class=""><a target="_blank" href="/products/{{ $data[$i]->ordersub[$j]->urlslug }}">{{ $data[$i]->ordersub[$j]->name }}</a></h6>
                                <span class="font-weight-bold"> &lpar; {{ $data[$i]->ordersub[$j]->qty }} &rpar;</span>
                                <span class=""> x Rs. {{ $data[$i]->ordersub[$j]->singlecost }}</span>
                            </div>
                            <div class="col-lg-3 col-3 font-weight-bold text-right">
                                <span class=""> Rs. {{ $data[$i]->ordersub[$j]->final}}</span>
                            </div>
                        </div>
                        @endfor
                </div>
            </div>
            @endfor
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

            <div class="d-flex mt-2 justify-content-center">
                {{ $data->appends(['type' => request()->get('type') ?? ''])->links() }}
            </div>
    </div>
</div>
@endsection
