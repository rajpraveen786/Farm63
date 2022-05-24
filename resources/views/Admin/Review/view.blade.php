@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/reviews" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/reviews">Reviews</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        <a href="/admin/reviews/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                    </div>
                    <h4 class="color-prim"><strong> Reviews</strong></h4>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Page</h6>
                                <a href="/admin/products/view/{{ encrypt($data->product->id) }}">
                                    {{ $data->product->name }}</a>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>User</h6>
                                <a href="/admin/customer/view/{{ $data->customer->id??'' }}">
                                    {{$data->customer->name??''}}</a>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Status</h6>

                                @if($data->status ==0)
                                Pending
                                @elseif($data->status ==1)
                                Approved
                                @elseif($data->status ==3)
                                Draft
                                @else
                                Reported
                                @endif
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Reported By</h6>
                                <a href="/admin/customer/view/{{ $data->reportedby->id??'' }}">
                                    {{$data->reportedby->name??''}}</a>
                            </div>
                            <div class="col-sm-12 col-md-12 mt-3">
                                <h6>Rating</h6>
                                {{$data->rating}}
                            </div>
                            <div class="col-sm-12 col-md-12 mt-3">
                                <h6>Review</h6>
                                {{$data->review}}
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>
    <div class="row mt-2">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm mt-3" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim"><strong> Edit</strong></h4>
                    <form action="/admin/reviews/edit/{{ encrypt($data->id) }}" method="post" enctype="multipart/form-data">
                        <div class="row"> @csrf
                            <div class="form-group col-md-6 col-sm-12 mt-2">
                                <label for="Status">Status</label>
                                <select name=status class="input-hov form-control" id="Status">
                                    <option value="0" @if($data->status==0) selected @endif>Pending</option>
                                    <option value="1" @if($data->status==1) selected @endif>Approved</option>
                                    <option value="2" @if($data->status==2) selected @endif>Reported</option>
                                    <option value="3" @if($data->status==3) selected @endif>Draft</option>
                                </select>
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
        </div>
    </div>
</div>
@endsection
