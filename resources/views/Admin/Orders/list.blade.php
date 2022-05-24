@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">

        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Orders</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-custom px-3" style="border-radius: 8px">
                <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
                <form action="" class="forms-">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="input-hov pl-5 form-control" id="filname" name='name' value="{{ request()->get('name') ?? '' }}" placeholder="Search By Order ID" autocomplete="off">
                            <label for="filname">What are you looking for?</label>
                            <button type="submit" class="btn position-absolute color-prim" style="top: 0; left: 2%"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="form-group col-md-3">
                            <select name=paystatus class="input-hov form-control" id="PayStatus">
                                <option value="-1" @if($paystatus==-1) selected @endif>Select to Filter</option>
                                <option value="0" @if($paystatus==0) selected @endif>Pending</option>
                                <option value="1" @if($paystatus==1) selected @endif>Paid</option>
                                <option value="2" @if($paystatus==2) selected @endif>Error</option>
                                <option value="3" @if($paystatus==3) selected @endif>Returned</option>
                            </select>
                            <label for="PayStatus">Pay Status</label>
                        </div>
                        <div class="form-group col-md-3">
                            <select name=status class="input-hov form-control" id="Status">
                                <option value="-1" @if($status==-1) selected @endif>Select to Filter</option>
                                <option value="0" @if($status==0) selected @endif>Pending</option>
                                <option value="1" @if($status==1) selected @endif>Approval</option>
                                <option value="2" @if($status==2) selected @endif>Out for Delivery</option>
                                <option value="3" @if($status==3) selected @endif>Recieved</option>
                                <option value="4" @if($status==4) selected @endif>Returned</option>
                                <option value="5" @if($status==5) selected @endif>Not Attended</option>
                                <option value="6" @if($status==6) selected @endif>Canceled</option>
                            </select>
                            <label for="Status">Status</label>
                        </div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <a href="/admin/orders" class='btn btn-outline-dark mx-1'>
                            <i class="fa fa-search-minus" aria-hidden="true"></i> Clear</a>
                        <button type="submit" class="btn btn-outline-custom">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card shadow-custom pt-3" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim font-weight-bold pb-2">List View</h4>
                    @if($data->count()>0)
                    <table class="table table-list table-responsive-sm">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                                <th scope="col font-weight-bold">#</th>
                                <th style="width:20%">Customer</th>
                                <th>Status</th>
                                <th>Pay Type</th>
                                <th>Pay Status</th>
                                <th>Total</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <th scope="row">{{ $data[$i]->invno }}</th>
                                    <td>
                                        <a class="color-prim" href="/admin/customer/view/{{ $data[$i]->customer?$data[$i]->customer->id:'' }}">
                                            {{ $data[$i]->customer->name??'' }}
                                        </a>
                                    </td>
                                    <td>
                                        @if($data[$i]->status==0)
                                        Pending
                                        @elseif($data[$i]->status==1)
                                        Approved
                                        @elseif($data[$i]->status==2)
                                        Out for Delivery
                                        @elseif($data[$i]->status==3)
                                        Delivered
                                        @elseif($data[$i]->status==4)
                                        Returned
                                        @elseif($data[$i]->status==5)
                                        Not Attended
                                        @elseif($data[$i]->status==6)
                                        Cancelled
                                        @endif
                                    </td>
                                    <td>
                                        @if($data[$i]->paytype==0)
                                        Online
                                        @elseif($data[$i]->paytype==1)
                                        COD
                                        @endif
                                    </td>
                                    <td>
                                        @if($data[$i]->paystatus==0)
                                        Pending
                                        @elseif($data[$i]->paystatus==1)
                                        Paid
                                        @elseif($data[$i]->paystatus==2)
                                        Error
                                        @elseif($data[$i]->paystatus==3)
                                        Returned
                                        @endif
                                    </td>
                                    <td>
                                        {{ $data[$i]->total }}
                                    </td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/orders/view/{{ $data[$i]->id }}" class="btn">
                                            <i class="fa fa-eye" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn p-0 m-0 no-foc btn-lg toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            <i class="fa fa-ellipsis-v" style="color: rgba(0, 0, 0, 0.6)"></i>
                                        </button>
                                        <div class="dropdown-menu" style="border-radius: 5px">
                                            <ul class="m-0 p-0" style="list-style: none;">
                                                @if(!in_array($data[$i]->paystatus,[1,3]))
                                                <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/orders/convertpaytype/{{ encrypt($data[$i]->id) }}" class="drop-hov"> <i class="fa fa-edit ml-3"></i><span class="ml-3"> Convert Payment to {{ $data[$i]->paytype==0 ?'Online Payment' :'COD' }}</span></a></li>
                                                @endif
                                                <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/orders/delete/{{ encrypt($data[$i]->id) }}" onclick="return confirm('Are you sure you want to delete ?');" class="drop-hov"><i class="fa fa-trash ml-3"></i><span class="ml-3"> Delete</span></a></li>
                                            </ul>
                                        </div>
                                    </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                    @else
                    <div class="container text-center">
                        <img loading="lazy" src="/storage/sorry.svg" alt="" class="w-25">
                        <h5>Sorry No data Found</h5>
                    </div>
                    @endif
                </div>
                <hr>

                <div class="d-flex mt-2 justify-content-center">
                    {{ $data->appends(['name' => request()->get('name') ?? '','status' => request()->get('status') ?? '','paystatus' => $paystatus ?? ''])->render("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
