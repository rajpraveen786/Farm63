@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/products">Products </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Inventory</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12">
            <div class="card shadow-custom px-3" style="border-radius: 8px">
                <h4 class="color-prim font-weight-bold pb-2 pt-3">Quick Filters</h4>
                <form action="" class="forms-">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <input type="text" class="input-hov pl-5 form-control" id="filname" name='name' value="{{ request()->get('name') ?? '' }}" placeholder="Search By Name" autocomplete="off">
                            <label for="filname">What are you looking for?</label>
                            <button type="submit" class="btn position-absolute color-prim" style="top: 0; left: 2%"><i class="fas fa-search"></i></button>
                        </div>

                        <div class="form-group col-md-6">
                            <select name="selected" class="input-hov form-control" id="exampleFormControlSelect1">
                                <option value="-1" @if(!request()->get('selected')) selected @endif>Select to Filter</option>
                                <option value="1" @if(request()->get('selected')==1) selected @endif>Low to High </option>
                                <option value="2" @if(request()->get('selected')==2) selected @endif>High to Low </option>
                            </select>
                            <label for="exampleFormControlSelect1">Order By Stock</label>
                        </div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <a href="/admin/products/inventory" class='btn btn-outline-dark mx-1'>
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
                                <th>Name</th>
                                <th class="text-right">Stock</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <td>
                                        <a href="/admin/products/view/{{ encrypt($data[$i]->id) }}">
                                            {{ $data[$i]->name }}</a></td>
                                    <td class="text-right">{{ $data[$i]->stock }}</td>
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

            </div>
        </div>
    </div>
</div>
@endsection
