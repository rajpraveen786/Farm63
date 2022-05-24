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
                Products Sold</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-custom px-3" style="border-radius: 8px">
                <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
                <form action="" class="forms-">
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <select class="input-hov form-control" name="orderby" id="exampleFormControlSelect1">
                                <option value="-1" default @if( request()->get('orderby') && request()->get('orderby')==-1) selected @endif>Orderby .. </option>
                                <option value="asc" @if(request()->get('orderby')=="asc") selected @endif>Ascending</option>
                                <option value="desc" @if(request()->get('orderby')=="desc") selected @endif>Descending</option>
                            </select>
                            <label for="exampleFormControlSelect1">Order by Stock sold</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="date" class="input-hov form-control" id="startdate" name='startdate' value="{{ request()->get('startdate') ?? date('Y-m-d',strtotime('-7 days')) }}" placeholder="" autocomplete="off">
                            <label for="startdate">Start Date</label>
                        </div>
                        <div class="form-group col-md-3">
                            <input type="date" class="input-hov form-control" id="enddate" name='enddate' value="{{ request()->get('enddate') ?? date('Y-m-d') }}" placeholder="" autocomplete="off">
                            <label for="enddate">End Date</label>
                        </div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <print class="float-right"></print>
                        <a href="/admin/reports/sales" class='btn btn-outline-dark mx-1'>
                            <i class="fa fa-search-minus" aria-hidden="true"></i> Clear</a>
                        <a href="/admin/reports/sales?export=1&orderby={{ request()->get('orderby') }}&startdate={{ request()->get('startdate') ?? date('Y-m-d') }}&enddate={{ request()->get('enddate') ?? date('Y-m-d') }}" class='btn btn-outline-dark mx-1'>
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
                    <h4 class="color-prim font-weight-bold pb-2">Product Wise Report</h4>
                    @if($data->count()>0)
                    @php
                    $netcost=0;
                    $qty=0;
                    @endphp
                    <table class="table table-list">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                                <th class='text-left'>Product Name</th>
                                <th  class="text-right">Minimum Stock</th>
                                <th class="text-right">Current Stock</th>
                                <th class="text-right">Qty Sold</th>
                                <th class="text-right">Cost</th>
                                <th class="text-right">Net cost</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <td>
                                        <a style="text-decoration:none" href="/admin/products/view/{{ encrypt($data[$i]->pid) }}">
                                            {{ $data[$i]->name }}
                                        </a>
                                    </td>
                                    <td  class="text-right">
                                        {{ $data[$i]->products->minstock }}
                                    </td>
                                    <td  class="text-right">
                                        {{ $data[$i]->products->stock }}
                                    </td>
                                    <td  class="text-right">
                                        {{ $data[$i]->qty }}
                                        @php
                                        $qty+=$data[$i]->qty;
                                        @endphp
                                    </td>
                                    <td class="text-right">
                                        <a style="text-decoration:none" href="/admin/orders/view/{{ $data[$i]->pid }}">
                                            <i class="fas fa-rupee-sign    "></i> {{ $data[$i]->products->fpricewtas }}
                                        </a>
                                    </td>
                                    <td class="text-right">
                                        <i class="fas fa-rupee-sign    "></i> {{ $data[$i]->products->fpricewtas*$data[$i]->qty }}
                                        @php
                                        $netcost+=$data[$i]->products->fpricewtas*$data[$i]->qty;
                                        @endphp
                                    </td>
                                </tr>
                                @endfor
                                <tr>
                                    <td colspan=3 class="text-right h5" style="font-weight: 900">
                                        Total
                                    </td>
                                    <td colspan=1 class="text-right  h5" style="font-weight: 900">
                                        {{ $qty }}
                                    </td>
                                    <td colspan=1 class="text-right h5" style="font-weight: 900">
                                        Total
                                    </td>
                                    <td colspan=1 class="text-right  h5" style="font-weight: 900">
                                        <i class="fas fa-rupee-sign    "></i> {{ $netcost }}
                                    </td>
                                </tr>
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
