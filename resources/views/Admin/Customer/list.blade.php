@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/customer/add" class="btn btn-outline-custom"> <i class="fa fa-plus" aria-hidden="true"></i>
                Add</a>
        </div>

        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Customer</li>
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
                    </div>
                    <div class="d-flex mb-2 justify-content-end">
                        <a href="/admin/customer" class='btn btn-outline-dark mx-1'>
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
                                <th style="width:20%">Name</th>
                                <th>Email</th>
                                <th>Phone Number</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <td>{{ $data[$i]->name }}</td>
                                    <td>{{ $data[$i]->email }}</td>
                                    <td>{{ $data[$i]->phno }}</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/customer/view/{{ $data[$i]->id }}" class="btn">
                                            <i class="fa fa-eye" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                        <button type="button" class="btn p-0 m-0 no-foc btn-lg toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                            <span class="sr-only">Toggle Dropdown</span>
                                            <i class="fa fa-ellipsis-v" style="color: rgba(0, 0, 0, 0.6)"></i>
                                        </button>
                                        <div class="dropdown-menu" style="border-radius: 5px">
                                            <ul class="m-0 p-0" style="list-style: none;">
                                                <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/customer/edit/{{ encrypt($data[$i]->id) }}" class="drop-hov"> <i class="fa fa-edit ml-3"></i><span class="ml-3"> Edit</span></a></li>
                                                <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/customer/delete/{{ encrypt($data[$i]->id) }}" onclick="return confirm('Are you sure you want to delete ?');" class="drop-hov"><i class="fa fa-trash ml-3"></i><span class="ml-3"> Delete</span></a></li>
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
