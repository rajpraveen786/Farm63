@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/discounts/netdiscount" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/discounts">Discounts</a></li>
            <li class="breadcrumb-item"><a href="/admin/discounts/netdiscount">Net Discount</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="card shadow-sm" style="border-radius: 8px">
        <div class="card-body">
            <div class="float-right">
                <a href="/admin/discounts/netdiscount/delete/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                    <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
            </div>
            <h4 class="color-prim"><strong> Discounts - {{ $data->name }}</strong></h4>
             <div class="container mt-3 h5">
                <h4 class="color-prim">
                    Details
                </h4>
                <div class="row">
                    <div class="col-sm-12 col-md-6 mt-2">
                        <img loading="lazy" src="/{{ $data->loc }}" alt="" class="w-100">

                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                Types
                            </div>
                            <div class="col-sm-12 col-md-6">
                                {{$data->types?'Percentage':'Fixed Amount'}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                Discount Value
                            </div>
                            <div class="col-sm-12 col-md-6">
                                {{ $data->value }}
                                {{$data->types?'%':'Rs'}}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                Start Date / Time
                            </div>
                            <div class="col-sm-12 col-md-6">
                                {{ $data->startdate }} {{ $data->starttime }}
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-2">
                        <div class="row">
                            <div class="col-sm-12 col-md-6">
                                End Date / Time
                            </div>
                            <div class="col-sm-12 col-md-6">
                                {{ $data->enddate??'-' }} {{ $data->endtime??'-' }}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="card shadow-sm mt-3" style="border-radius: 8px">
        <div class="card-body">
            <h4 class="color-prim"><strong> Products</strong></h4>
            <table class="table mt-2">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Price</th>
                        <th>Discount Amount</th>
                        <th>Final Price</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($products as $key => $value)
                    <tr>
                        <th>
                            <a href="/admin/products/view/{{ encrypt($value->id) }}" class='text-primary'>
                                {{ $value->name }}</a></th>
                        <th>{{ $value->fprice }}</th>
                        <th>{{ $value->disa }}</th>
                        <th>{{ $value->fpricewtas }}</th>
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
