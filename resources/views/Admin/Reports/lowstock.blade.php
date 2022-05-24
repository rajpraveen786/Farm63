@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">

        </div>

        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/reports">Reports </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Low Stock</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-custom px-3" style="border-radius: 8px">
                <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
                <form action="" class="forms-">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="input-hov form-control" name="status" id="exampleFormControlSelect1">
                                <option value="-1" default @if( request()->get('status') && request()->get('status')==-1) selected @endif>Select Status</option>
                                <option value="0" @if(request()->get('status')==0) selected @endif>Draft</option>
                                <option value="1" @if(request()->get('status')==1) selected @endif>Active</option>
                            </select>
                            <label for="exampleFormControlSelect1">Status </label>
                        </div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <print class="float-right"></print>
                        <a href="/admin/reports/lowstock" class='btn btn-outline-dark mx-1'>
                            <i class="fa fa-search-minus" aria-hidden="true"></i> Clear</a>
                        <a href="/admin/reports/lowstock?export=1&status={{ request()->get('status') }}" class='btn btn-outline-dark mx-1'>
                            <i class="fa fa-file-export" aria-hidden="true"></i> Export</a>
                        <button type="submit" class="btn btn-outline-custom">
                            <i class="fa fa-filter" aria-hidden="true"></i>
                            Filter
                        </button>
                    </div>
                </form>
            </div>
        </div>
        <div class="col-12 mt-3">
            <div class="card shadow-custom pt-3" id='tableprint' style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim font-weight-bold pb-2">Low Stock Report</h4>
                    @if($data->count()>0)
                    <table class="table table-list table-responsive-sm">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                                <th>Product</th>
                                <th class='text-right'>Min Stock</th>
                                <th class='text-right'>Stock</th>
                                <th class='text-right'>Status</th>
                                <th class='text-right'>Sales Rate</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <td>
                                        <a style="text-decoration:none" href="/admin/products/view/{{ encrypt($data[$i]->id) }}">
                                            {{ $data[$i]->name }}
                                        </a>
                                    </td>
                                    <td class='text-right'>{{ $data[$i]->minstock }}</td>
                                    <td class='text-right'>{{ $data[$i]->stock }}</td>
                                    <td class='text-right'>
                                        @if($data[$i]->status ==0)
                                        Draft
                                        @elseif($data[$i]->status ==1)
                                        Active
                                        @elseif($data[$i]->status ==3)
                                        Draft
                                        @else
                                        Reported
                                        @endif
                                    </td>
                                    <td class='text-right'>Rs. {{ $data[$i]->fpricewtas }}</td>
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
            </div>
        </div>
    </div>
</div>
@endsection
