@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/master/category" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/master">Master</a></li>
            <li class="breadcrumb-item"><a href="/admin/master/category">Category</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        <a href="/admin/master/category/edit/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-custom"><i class="fas fa-edit"></i> <span class="d-none d-md-inline"> Edit</span></a>
                        <a href="/admin/master/category/delete/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                    </div>
                    <h4 class="color-prim"><strong> Category - {{ $data->name }}</strong></h4>
                    <img loading="lazy" src="/{{$data->loc}}" alt="" class="mt-2 w-25">
                    <img loading="lazy" src="/{{$data->banner}}" alt="" class="mt-2 w-25">
                    <div class="mt-2 ">
                        <h5>Description</h5>
                        <descview :content="{{json_encode($data->desc)}}"></descview>
                    </div>



                    <div class="container mt-4">
                        <h4 class="color-prim">
                            SEO
                        </h4>
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-2">
                                <h6>Title</h6>
                                {{$data->seo_title}}
                            </div><div class="col-sm-12 col-md-6 mt-2">
                                <h6>Description</h6>
                                {{$data->seo_desc}}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endsection
