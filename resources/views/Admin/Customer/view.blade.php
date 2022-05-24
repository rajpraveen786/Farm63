@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/customer" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/customer">Customer</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        <a href="/admin/customer/edit/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-custom"><i class="fas fa-edit"></i> <span class="d-none d-md-inline"> Edit</span></a>
                        <a href="/admin/customer/delete/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                    </div>
                    <h4 class="color-prim"><strong> Customer - {{ $data->name }}</strong></h4>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Name</h6>
                                {{$data->name}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Phone Number</h6>
                                {{$data->phno}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Email</h6>
                                {{$data->email}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Email Verified</h6>
                                {{$data->email_verified_at?'Verified':'Not Verified'}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Status</h6>
                                {{$data->status?'Allowed':'Draft'}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Created At</h6>
                                {{date('Y-m-d H:i a', strtotime($data->created_at))}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="card shadow-sm mt-3" style="border-radius: 8px">
        <div class="card-body">
            <h4 class="color-prim"><strong> Orders</strong></h4>
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th>Invoice</th>
                        <th>Total</th>
                        <th class="">Status</th>
                        <th class="text-right">Ordered At</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($orders as $key => $value)
                    <tr>
                        <th>
                            <a href="/admin/orders/view/{{ $value->id }}" class='text-primary'>
                                {{ $value->id }}</a></th>

                        <th><i class="fas fa-rupee-sign    "></i> {{ $value->total }}</th>

                        <td>
                            @if($value->status==0)
                            Pending
                            @elseif($value->status==1)
                            Approved
                            @elseif($value->status==2)
                            Out for Delivery
                            @elseif($value->status==3)
                            Delivered
                            @elseif($value->status==4)
                            Returned
                            @elseif($value->status==5)
                            Not Attended
                            @elseif($value->status==6)
                            Cancelled
                            @endif
                        </td>
                        <th class="text-right">{{ date('Y-m-d h:i A',strtotime($value->created_at)) }}</th>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="4" class='alert alert-danger text-center'>Sorry no Data Found.</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>

            <div class="d-flex mt-2 justify-content-center">
                {{ $orders->render("pagination::bootstrap-4") }}
            </div>
        </div>
    </div>
    <div class="card shadow-sm mt-3" style="border-radius: 8px">
        <div class="card-body">
            <h4 class="color-prim"><strong> Reviews</strong></h4>

            <table class="table mt-2">
                <thead>
                    <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                        <th>Product</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th style="width:10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data->reviews as $key => $value)
                    <tr>
                        <td><a href="/admin/products/view/{{ encrypt($value->product->id) }}">
                                {{ $value->product->name }}</a></td>
                        <td>{{ $value->rating }}</td>
                        <td>
                            @if($value->status ==0)
                            Pending
                            @elseif($value->status ==1)
                            Approved
                            @elseif($value->status ==3)
                            Draft
                            @else
                            Reported
                            @endif
                        </td>
                        <td class="text-center d-flex flex-row justify-content-around">
                            <a href="/admin/reviews/view/{{ encrypt($value->id) }}" class="btn">
                                <i class="fa fa-eye" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                            </a>
                            <a onclick="return confirm('Are you sure you want to delete ?');" href="/admin/reviews/{{ encrypt($value->id) }}" class="btn">
                                <i class="fa fa-trash" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <th colspan="4" class='alert alert-danger text-center'>Sorry no Data Found.</th>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
