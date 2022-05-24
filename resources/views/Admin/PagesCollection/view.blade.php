@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/pages" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/pages">Pages</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim"><strong> Pages - {{ $data->name }}</strong></h4>

                    <br><br>
                    <div class="float-right">
                        <a href="/admin/pages/{{ $data->name }}/subbanner/add" class="btn btn-outline-custom"> <i class="fa fa-plus" aria-hidden="true"></i>
                            Add</a>
                    </div>
                    <h5 class="color-prim"><strong> Banner</strong></h5>
                    @php
                        $banner=json_decode($data->banner);
                    @endphp
                    @if(count($banner))
                    <table class="table table-list table-responsive-sm">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                                <th style="width:20%">Photo</th>
                                <th>Name</th>
                                <th>Link</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<count($banner);$i++)
                                <tr>
                                    <td><img loading="lazy" class="w-100" src="/{{ $banner[$i]->loc }}" alt=""></td>
                                    <td>{{ $banner[$i]->name }}</td>
                                    <td>{{ $banner[$i]->link }}</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                    <button type="button" class="btn p-0 m-0 no-foc btn-lg toggle dropdown-toggle-split" data-toggle="dropdown" aria-expanded="false">
                                        <span class="sr-only">Toggle Dropdown</span>
                                        <i class="fa fa-ellipsis-v" style="color: rgba(0, 0, 0, 0.6)"></i>
                                    </button>
                                    <div class="dropdown-menu" style="border-radius: 5px">
                                        <ul class="m-0 p-0" style="list-style: none;">
                                            <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/pages/{{ $data->name }}/subbanner/edit/{{ $banner[$i]->id??'' }}" class="drop-hov"> <i class="fa fa-edit ml-3"></i><span class="ml-3"> Edit</span></a></li>
                                            <li class="m-0 p-0" style="color: rgba(0, 0, 0, 0.7)"><a href="/admin/pages/{{ $data->name }}/subbanner/delete/{{ $banner[$i]->id??'' }}" onclick="return confirm('Are you sure you want to delete ?');" class="drop-hov"><i class="fa fa-trash ml-3"></i><span class="ml-3"> Delete</span></a></li>
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
            </div>
        </div>
        @endsection
