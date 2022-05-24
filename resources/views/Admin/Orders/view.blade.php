@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">

            @if(!in_array($data->paystatus,[1,3]))
            <a href="/admin/orders/convertpaytype/{{ encrypt($data->id) }}" class="btn btn-custom py-1"><i class="fa fa-edit fa-fw" aria-hidden="true"></i> Convert Payment to {{ $data->paytype==0 ?'Online Payment' :'COD' }}</a>
            @endif
            <a href="/admin/orders" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/orders">Orders</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        @if($data->paystatus==1)
                        <a href="/admin/orders/invoice/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-primary    ">
                            Invoice</a>
                        @endif

                        @if(in_array($data->status,[4,6]) && $data->paystatus==1 && $data->paytype==0 && is_null($data->refunddata)&&Auth::user()->permission->orderview)
                        <button type="button" class="btn btn-outline-primary" data-toggle="modal" data-target="#InitiateRefund">
                            Initiate Refund
                        </button>
                        @endif
                        @if(Auth::user()->permission->orderdel)
                        <a href="/admin/orders/delete/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                            @endif
                    </div>
                    <h4 class="color-prim"><strong> Orders - #{{ $data->invno }}</strong></h4>
                    <div class="row mt-2">
                        <div class="col-md-6 col-sm-12 mt-2">
                            <h4>To Address</h4>
                            @php
                            $address=json_decode($data->address);
                            @endphp
                            <h5>{{ $address->name }}</h5>
                            <h6>{{ $address->phno }}</h6>
                            {{ $address->houseno }} <br>
                            {{ $address->area }}, {{ $address->landmark }}<br>
                            {{ $address->city }}, {{ $address->state }} <br>
                            {{ $address->country }}, {{ $address->pincode }} <br>
                        </div>
                        <div class="col-md-6 col-sm-12 mt-2">
                            <div class="row mt-2">
                                <div class="col-4">Customer</div>
                                <div class="col-8">
                                    <a class="color-prim" href="/admin/customer/view/{{ $data->customer->id }}">
                                        {{ $data->customer->name }}
                                    </a></div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">Ordered On</div>
                                <div class="col-8">{{ date('d M-Y h:m A',strtotime($data->created_at)) }}</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">Status</div>
                                <div class="col-8">

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
                                </div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">Payment Type</div>
                                <div class="col-8">
                                    @if($data->paytype==0)
                                    Online
                                    @elseif($data->paytype==1)
                                    COD
                                    @endif</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">Payment Status</div>
                                <div class="col-8">
                                    @if($data->paystatus==0)
                                    Pending
                                    @elseif($data->paystatus==1)
                                    Paid
                                    @elseif($data->paystatus==2)
                                    Error
                                    @elseif($data->paystatus==3)
                                    Returned
                                    @endif</div>
                            </div>
                            <div class="row mt-2">
                                <div class="col-4">Total</div>
                                <div class="col-8">
                                    {{$data->total}}</div>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
            @if($data->refunddata)
            <div class="card shadow-sm mt-3" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim"><strong> Refund Status</strong></h4>

                    <div class="row mt-2">
                        <div class="col-4">Refund Amount</div>
                        <div class="col-8">
                            <a class="color-prim" href="/admin/customer/view/{{ $data->customer->id }}">
                                {{ $data->refunddata->orderAmount }}
                            </a></div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">Refunded Inititalted On</div>
                        <div class="col-8">{{ date('d M-Y h:m A',strtotime($data->refunddata->created_at)) }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-4">Status</div>
                        <div class="col-8">

                            @if($data->refunddata->status==0)
                            Pending
                            @elseif($data->refunddata->status==1)
                            Completed
                            @elseif($data->refunddata->status==2)
                            Failed
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            @endif
            <div class="card shadow-sm mt-4" style="border-radius: 8px">
                <div class="card-body">
                    <h4>Bill Order</h4>
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Name</th>
                                <th>Unit Cost</th>
                                <th>Qty</th>
                                <th>Tax</th>
                                <th>Total</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<$data->ordersubadmin->count();$i++)
                                <tr>
                                    <th>
                                        <a href="/admin/products/view/{{ encrypt($data->ordersubadmin[$i]->id) }}">
                                            {{ $data->ordersubadmin[$i]->name }}</a></th>
                                    <th>{{ $data->ordersubadmin[$i]->subcost }}</th>
                                    <th>{{ $data->ordersubadmin[$i]->qty }}</th>
                                    <th>{{ $data->ordersubadmin[$i]->tax }}</th>
                                    <th>{{ $data->ordersubadmin[$i]->final }}</th>
                                </tr>
                                @endfor
                                <tr>
                                    <th colspan=3></th>
                                    <th>SubTotal</th>
                                    <th>{{ $data->subcost }}</th>
                                </tr>
                                <tr>
                                    <th colspan=3></th>
                                    <th>Shipping</th>
                                    <th>{{ $data->shipping }}</th>
                                </tr>
                                <tr>
                                    <th colspan=3></th>
                                    <th>Tax</th>
                                    <th>{{ $data->tax }}</th>
                                </tr>
                                <tr>
                                    <th colspan=3></th>
                                    <th>PromoCode</th>
                                    <th>- {{ $data->promocodeval }}</th>
                                </tr>
                                <tr>
                                    <th colspan=3></th>
                                    <th>Total</th>
                                    <th>{{ $data->total }}</th>
                                </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="card shadow-sm mt-4" style="border-radius: 8px">
                <div class="card-body">
                    <h4>Order Timeline</h4>
                    <table class="table table-responsive-sm">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<$data->ordersmanage->count();$i++)
                                <tr>
                                    <th>
                                        @if($data->ordersmanage[$i]->status==0) Order Created
                                        @elseif($data->ordersmanage[$i]->status==1) Order Approved
                                        @elseif($data->ordersmanage[$i]->status==2) Out for Delivery
                                        @elseif($data->ordersmanage[$i]->status==3) Delivered
                                        @elseif($data->ordersmanage[$i]->status==4) Order Returned
                                        @elseif($data->ordersmanage[$i]->status==5) Order Not Attended
                                        @elseif($data->ordersmanage[$i]->status==6) Order Cancelled
                                        @elseif($data->ordersmanage[$i]->status==7) Order Cancelled due to nan Payment

                                        @endif
                                        {{ $data->ordersmanage[$i]->name }}
                                    </th>
                                    <th>{{ date('Y-m-d H:i a',strtotime($data->ordersmanage[$i]->created_at)) }}</th>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                </div>
            </div>
            @if(in_array($data->status,[0,1,2,3]) && Auth::user()->permission->general->orderedit )
            <div class="card shadow-sm mt-3" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim"><strong> Edit</strong></h4>
                    <form action="/admin/orders/edit/{{ encrypt($data->id) }}" method="post" enctype="multipart/form-data">
                        <div class="row"> @csrf
                            <div class="form-group col-md-6 col-sm-12 mt-2">
                                <select name=paystatus class="input-hov form-control" id="PayStatus">

                                    <option value="0" @if($data->paystatus==0) selected @endif>Pending</option>
                                    <option value="1" @if($data->paystatus==1) selected @endif>Paid</option>
                                    <option value="2" @if($data->paystatus==2) selected @endif>Error</option>
                                    <option value="3" @if($data->paystatus==3) selected @endif>Returned</option>
                                </select>
                                <label for="PayStatus">Pay Status</label>
                            </div>
                            <div class="form-group col-md-6 col-sm-12 mt-2">
                                <select name=status class="input-hov form-control" id="Status">
                                    <option value="0" @if($data->status==0) selected @endif>Pending</option>
                                    <option value="1" @if($data->status==1) selected @endif>Approval</option>
                                    <option value="2" @if($data->status==2) selected @endif>Shipping</option>
                                    <option value="3" @if($data->status==3) selected @endif>Delivered</option>
                                    <option value="4" @if($data->status==4) selected @endif>Returned</option>
                                    <option value="5" @if($data->status==5) selected @endif>Not Attended</option>
                                    <option value="6" @if($data->status==6) selected @endif>Canceled</option>
                                </select>
                                <label for="Status">Status</label>
                            </div>
                            <div class="form-group mt-2 col-md-6">
                                       <label for="">Photo</label>
                        <fileinput :error="{{ json_encode($errors->first('loc')??'') }}" id="loc" name="loc"></fileinput>
                            </div>

                        </div>

                        <div class="d-flex mb-2 justify-content-end">

                            <button type="submit" class="btn btn-outline-custom">
                                <i class="fa fa-save" aria-hidden="true"></i>
                                Save
                            </button>
                        </div>
                    </form>
                </div>
            </div>
            @endif
        </div>
    </div>
</div>

<div class="modal fade" id="InitiateRefund" tabindex="-1" role="dialog" aria-labelledby="InitiateRefundLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="InitiateRefundLabel">Initiate Refund</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/orders/returnamt/{{ encrypt($data->id) }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                    <div class="form-row my-2">
                        <div class="form-group mt-2 col-md-12">
                            <input type="text" class="input-hov form-control {{ $errors->has('refundamt')? 'is-invalid ':'' }}" autocomplete="off" name="refundamt" id="inputrefundamt4" placeholder="Enter Refund Amount" value="{{ old('refundamt')??'' }}">
                            <label for="inputrefundamt4">Refund Amount</label>
                            @if ($errors->has('refundamt'))
                            <small class="form-text text-danger">{{ $errors->first('refundamt') }}</small>
                            @endif
                        </div>
                    </div>

                    <div class="d-flex mt-2 justify-content-end">
                        <button type="submit" class="btn btn-outline-custom">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
