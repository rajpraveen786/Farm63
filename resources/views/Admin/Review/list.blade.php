@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">

        </div>

        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Reviews</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-custom px-3" style="border-radius: 8px">
                <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
                <form action="" class="forms-">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="input-hov pl-5 form-control" id="filname" name='name' value="{{ request()->get('name') ?? '' }}" placeholder="Search By Name, Email, Phone Number" autocomplete="off">
                            <label for="filname">What are you looking for?</label>
                            <button type="submit" class="btn position-absolute color-prim" style="top: 0; left: 2%"><i class="fas fa-search"></i></button>
                        </div>
                        <div class="form-group col-md-3">
                            <select class="input-hov form-control" name="status" id="exampleFormControlSelect1">
                                <option value="-1" default @if( old('status')==-1) selected @endif>Select Status</option>
                                <option value="0" @if(old('status')==0) selected @endif>Pending</option>
                                <option value="1" @if(old('status')==1) selected @endif>Approved</option>
                                <option value="2" @if(old('status')==2) selected @endif>Reported</option>
                                <option value="3" @if(old('status')==3) selected @endif>Draft</option>
                            </select>
                            <label for="exampleFormControlSelect1">Status </label>
                        </div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <a href="/admin/reviews" class='btn btn-outline-dark mx-1'>
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
                                <th>Product</th>
                                <th>Customer</th>
                                <th>Reported By</th>
                                <th>Rating</th>
                                <th>Status</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>
                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <td><a href="/admin/products/view/{{ encrypt($data[$i]->product->id) }}">
                                            {{ $data[$i]->product->name }}</a></td>
                                            @if($data[$i]->customer)
                                    <td><a href="/admin/customer/view/{{ $data[$i]->customer->id??'' }}">
                                            {{ $data[$i]->customer->name??'' }}</a></td>
                                            @endif
                                    <td><a href="/admin/customer/view/{{ $data[$i]->reportby->id??'' }}">
                                            {{ $data[$i]->reportby->name??'' }}</a></td>

                                    <td>{{ $data[$i]->rating }}</td>
                                    <td>
                                        @if($data[$i]->status ==0)
                                        Pending
                                        @elseif($data[$i]->status ==1)
                                        Approved
                                        @elseif($data[$i]->status ==3)
                                        Draft
                                        @else
                                        Reported
                                        @endif
                                    </td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/reviews/view/{{ encrypt($data[$i]->id) }}" class="btn">
                                            <i class="fa fa-eye" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                        <a onclick="return confirm('Are you sure you want to delete ?');" href="/admin/reviews/{{ encrypt($data[$i]->id) }}" class="btn">
                                            <i class="fa fa-trash" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
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
                    {{ $data->appends(['name' => request()->get('name') ?? '','status' => request()->get('status') ?? -1])->render("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
