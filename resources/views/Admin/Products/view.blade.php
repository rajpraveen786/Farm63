@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/products" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/products">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>

    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        <a href="/admin/products/edit/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-custom"><i class="fas fa-edit"></i> <span class="d-none d-md-inline"> Edit</span></a>
                        <a href="/admin/products/delete/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                    </div>
                    <h4 class="color-prim"><strong> Products - {{ $data->name }} </strong></h4>
                    <pagesimage class="w-25" :image="{{ json_encode($data->images) }}"></pagesimage>

                    <div class="mt-2 ">
                        <h4 class="color-prim">Baisc info</h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-4">
                                <span style='font-weight:900'>Category :
                                    {{$data->category->name??''}} </span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-4">
                                <span style='font-weight:900'>Brand :
                                    {{$data->brand->name??''}} </span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-4">
                                <span style='font-weight:900'>UOM :
                                    {{$data->uom->name??''}} </span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-4">
                                <span style='font-weight:900'>Packing :
                                    {{$data->packing->name??''}} </span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-4">
                                <span style='font-weight:900'>Weight :
                                    {{$data->weight}}

                                    @if($data->wgunit==0) Kg
                                    @elseif($data->wgunit==1) g
                                    @endif </span>
                            </div>
                            <div class="col-12 mt-4 ">
                                <h5 class="color-prim">Pricing</h5>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <span style='font-weight:900'>Base Price : <i class="fas fa-fw fa-rupee-sign    "></i>{{ $data->fprice }}</span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <span style='font-weight:900'>Cost Per Item : <i class="fas fa-fw fa-rupee-sign    "></i>{{ $data->cpi }}</span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <span style='font-weight:900'>Disocunt : <i class="fas fa-fw fa-rupee-sign    "></i>{{ $data->disa }} ({{ $data->disp }} %)</span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <span style='font-weight:900'>Tax : <i class="fas fa-fw fa-rupee-sign    "></i>{{ $data->taxa }} ({{ $data->taxp }} %)</span>
                            </div>


                            <div class="col-sm-12 col-md-6 mt-2">
                                <span style='font-weight:900'>Stock : {{ $data->stock }}</span>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <span style='font-weight:900'>Minimum Stock : {{ $data->minstock }}</span>
                            </div>
                        </div>
                        <h4 class="color-prim mt-3">Short Description</h4>

                        <descview :content="{{json_encode($data->shortdesc)}}"></descview>
                        <h4 class="color-prim mt-3">Description</h4>

                        <descview :content="{{json_encode($data->desc)}}"></descview>
                    </div>

                    @if($data->attribute)
                    <div class="mt-2 ">
                        <adminproductattributeview :data='{{ json_encode($data->attribute) }}'></adminproductattributeview>
                    </div>
                    @endif

                    <div class="container mt-4">
                        <h4 class="color-prim">
                            SEO
                        </h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <h6>Title</h6>
                                {{$data->seo_title}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-2">
                                <h6>Description</h6>
                                {{$data->seo_desc}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


    <div class="card shadow-sm mt-3" style="border-radius: 8px">
        <div class="card-body">
            <h4 class="color-prim"><strong> Reviews</strong></h4>

            <table class="table mt-2">
                <thead>
                    <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                        <th>Customer</th>
                        <th>Rating</th>
                        <th>Status</th>
                        <th style="width:10%" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($data->review as $key => $value)
                    <tr>
                        <td><a href="/admin/customer/view/{{ $value->customer->id }}">
                                {{ $value->customer->name }}</a></td>

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
