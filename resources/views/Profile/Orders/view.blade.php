@extends('layouts.profile')

@section('subcontent')

<div style=" min-height: 80vh; padding-bottom: 5vh">

    <div class="container ">
        <ol class="pt-5 breadcrumb breadcrumb-bar" id="bread" style="background-color: transparent">
            <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
            <li class="breadcrumb-item"><a class='text-dark' href="/profile/orders">Orders </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Your Orders</li>
        </ol>
    </div>

    <div class="container">
        <div class="card shadow px-3 mt-4" style="border: 1px solid rgba(0, 0, 0, 0.3);">
            <div class="row card-header font-prim" style="background-color: #f7f5f5;">
                <div class="col-12">
                    <h4 class="py-2">Order Details</h4>
                </div>
            </div>

            <ul class="nav mt-3 w-100">
                <li class="nav-item w-sm-100">
                    <span class="nav-link">Ordered on {{ date('d-m-Y',strtotime($data->created_at)) }}</span>
                </li>
                <li class="nav-item w-sm-100">
                    <span class="nav-link">Ordered on {{ date('d-m-Y',strtotime($data->created_at)) }}</span>
                </li>
                <li class="nav-item">
                    <span class="nav-link">Order# {{ $data->invno }}</span>
                </li>
                <li class="nav-item ml-auto">
                    <ul class="nav">
                        @if($data->paystatus==1)
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-success btn-sm" href="/profile/orders/invoice/{{ encrypt($data->id) }}">Invoice</a>
                        </li>
                        @endif
                        @if(in_array($data->status,[0,1]) && in_array($data->paystatus,[0,2]) && in_array($data->paytype,[0]))
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-success btn-sm" href="/profile/orders/pay/{{ encrypt($data->id) }}">Pay Now</a>
                        </li>
                        @endif
                        @if(in_array($data->status,[0,1,5]) && in_array($data->paystatus,[0,1,2]) && in_array($data->paytype,[0,1])
                        )
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to cancel the order?');" href="/profile/orders/cancel/{{ encrypt($data->id) }}">Cancel Order</a>
                        </li>

                        @endif
                        @if(in_array($data->status,[3]) && in_array($data->paystatus,[0,1,2]) && in_array($data->paytype,[0,1])
                        )
                        <li class="nav-item mx-1">
                            <a class="nav-link btn btn-outline-danger btn-sm" onclick="return confirm('Are you sure you want to return the order?');" href="/profile/orders/returns/{{ encrypt($data->id) }}">Return Order</a>
                        </li>
                        @endif
                    </ul>
                </li>


            </ul>
            <div class="card-body">
                <div class="row mt-2">
                    <div class="col-sm-12 mt-2 col-lg-4 col-md-6 mt-3">
                        <h6 class="mb-md-4 color-prim" style="font-weight:900">Shipping Address</h6>
                        @php
                        $address=json_decode($data->address);
                        @endphp
                        {{ $address->name }} <br>
                        {{ $address->phno }} <br>
                        {{ $address->houseno }}, {{ $address->area }}, {{ $address->landmark }} <br>
                        {{ $address->city }}, {{ $address->state }} <br>
                        {{ $address->country }}, {{ $address->pincode }} <br>
                    </div>
                    <div class="col-sm-12 mt-2 col-lg-3 col-md-6 mt-3">
                        <h6 class="mb-md-4 color-prim" style="font-weight:900">Status</h6>
                        <span class="" style="font-weight:900"> Payment Method : </span>
                        @if($data->paytype==0)
                        Online Payment
                        @elseif($data->paytype==1)
                        Cash On Delivery
                        @endif <br>
                        <span class="" style="font-weight:900"> Payment Status : </span>
                        @if($data->paystatus==0)
                        Pending
                        @elseif($data->paystatus==1)
                        Paid
                        @elseif($data->paystatus==2)
                        Error
                        @elseif($data->paystatus==3)
                        Returned
                        @endif <br>
                        <span class="" style="font-weight:900"> Order Status : </span>
                        @if($data->status==0)
                        Pending
                        @elseif($data->status==1)
                        Approved
                        @elseif($data->status==2)
                        Out for Delivery
                        @elseif($data->status==3)
                        Delivered
                        @elseif($data->status==4)
                        Returned
                        @elseif($data->status==5)
                        Not Attended
                        @elseif($data->status==6)
                        Cancelled
                        @endif
                        @if($data->refunddata)
                        <br>
                        <span class="mt-2" style="font-weight:900"> Refund Status : </span>
                        @if($data->refunddata->status==0)
                        Pending
                        @elseif($data->refunddata->status==1)
                        Completed
                        @elseif($data->refunddata->status==2)
                        Failed
                        @endif

                        <br>
                        <span class="" style="font-weight:900"> Refund Amount : </span>
                        {{ $data->refunddata->orderAmount }}

                        @endif
                    </div>
                    <div class="col-sm-12 col-lg-4 col-md-12 mt-3">
                        <h6 class="mb-md-4 color-prim" style="font-weight:900">Order Summary</h6>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Items(s) Subtotal</td>
                                    <td><i class="fas fa-rupee-sign"></i> {{$data->subcost}}</td>
                                </tr>
                                <tr>
                                    <td>Shipping: </td>
                                    <td><i class="fas fa-rupee-sign"></i> {{$data->shipping}}</td>
                                </tr>
                                @if($data->promocodeval)
                                <tr>
                                    <td>Promo Code Applied</td>
                                    <td>- <i class="fas fa-rupee-sign"></i> {{$data->promocodeval}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Total</td>
                                    <td><i class="fas fa-rupee-sign"></i> {{$data->total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="card-header row">
                @for($i=0;$i<$data->ordersub->count();$i++)
                    <div class="col-lg-1 col-2 mt-2 p-0">
                        <img loading="lazy" src="/{{ $data->ordersub[$i]->image->loc ??'' }}" class="img-fluid" alt="">
                    </div>
                    <div class="col-lg-8 col-7 mt-2">
                        <h6 class="">{{ $data->ordersub[$i]->name }}</h6>
                        <span class="font-weight-bold"> &lpar; {{ $data->ordersub[$i]->qty }} &rpar;</span>
                        <span class=""> x Rs. {{ $data->ordersub[$i]->singlecost }}</span>
                    </div>
                    <div class="col-lg-3 col-3 mt-2 font-weight-bold text-right">
                        <span> Rs. {{ $data->ordersub[$i]->final}}</span>
                    </div>
                    @endfor
            </div>
        </div>
    </div>
</div>
@endsection
