@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/discounts/netdiscount/add" class="btn btn-outline-custom"> <i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>
        </div>

        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/discounts">Discounts</a></li>

            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Net Discount</li>
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

                        <div class="form-group col-md-3">
                            <select name="status" class="input-hov form-control" id="exampleFormControlSelect1">
                                <option @if(request()->get('status')>-1) selected @endif value="-1">Select To filter</option>
                                <option @if(request()->get('status')==0) selected @endif value="0">Draft</option>
                                <option @if(request()->get('status')==1) selected @endif value="1">Active</option>
                            </select>
                            <label for="exampleFormControlSelect1">Status</label>
                        </div>
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <a href="/admin/discounts/netdiscount" class='btn btn-outline-dark mx-1'>
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
                    {{ $data }}
                    @if($data->count()>0)
                    <table class="table table-list table-responsive-sm">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                                <th scope="col font-weight-bold">#</th>
                                <th style="width:20%">Photo</th>
                                <th>Name</th>
                                <th>Status</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <th scope="row">{{ $data[$i]->id }}</th>
                                    <td><img loading="lazy" src="/{{ $data[$i]->loc }}" class="w-100" alt="{{ $data[$i]->name }}"> </td>
                                    <td>{{ $data[$i]->name }}</td>
                                    <td>
                                        @if($data[$i]->status)   <span class="badge badge-pill badge-success">Active</span>
                                        @else                    <span class="badge badge-pill badge-danger">Draft</span>
                                        @endif
                                    </td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/discounts/netdiscount/view/{{ encrypt($data[$i]->id) }}" class="btn">
                                            <i class="fa fa-eye" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn p-0 m-0 no-foc btn-lg toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            <i class="fa fa-ellipsis-v" style="color: rgba(0, 0, 0, 0.6)"></i>
                                        </button>
                                        <div class="dropdown-menu" style="border-radius: 5px">
                                            <ul class="m-0 p-0" style="list-style: none;">
                                                <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/discounts/netdiscount/delete/{{ encrypt($data[$i]->id) }}" onclick="return confirm('Are you sure you want to delete ?');" class="drop-hov"><i class="fa fa-trash ml-3"></i><span class="ml-3"> Delete</span></a></li>
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
                    {{ $data->appends(['name' => request()->get('name') ?? ''])->render("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
/
