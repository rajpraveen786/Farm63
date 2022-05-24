@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/master/brand" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>

        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/master">Master</a></li>
            <li class="breadcrumb-item"><a href="/admin/master/brand">Brand</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Add</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Brand - Add</h3>
            <form action="/admin/master/brand/add" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??'' }}">
                        <label for="inputName4">Name</label>
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="linkt">Status</label>
                        <select name="status" class="form-control" id="linkt">
                            <option @if(old('status') && old('status')==0) selected @endif value="0">Draft</option>
                            <option @if(old('status') && old('status')==1) selected @else selected @endif value="1">Active</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="">Photo</label>
                        <fileinput size="460px X 460px"  :error="{{ json_encode($errors->first('loc')??'') }}" id="loc" name="loc"></fileinput>
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="">Banner</label>
                        <fileinput size="1000px X 200px"  :error="{{ json_encode($errors->first('bannerimg')??'') }}" id="bannerimg" name="bannerimg"></fileinput>
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <div class="container">
                        <input type="checkbox" class="form-check-input" name="homebanner" value="1" id="homebanner" />
                        <small class="form-check-label" for="homebanner">Show Banner in Home Page</small>
                        </div>
                    </div>
                    <div class="form-group mt-2 col-12">
                        <descinput name="desc" title="Description" :content="{{ json_encode(old('desc')) }}"></descinput>
                        @if ($errors->has('desc'))
                        <small class="form-text text-danger">{{ $errors->first('desc') }}</small>
                        @endif
                    </div>

                </div>

                <h4 class="mt-3 color-prim">SEO</h4>
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('seotitle')? 'is-invalid ':'' }}" autocomplete="off" name="seotitle" id="inputseotitle4" placeholder="Enter SEO Title" value="{{ old('seotitle')??'' }}">
                        <label for="inputseotitle4">SEO Title</label>
                        @if ($errors->has('seotitle'))
                        <small class="form-text text-danger">{{ $errors->first('seotitle') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('seodesc')? 'is-invalid ':'' }}" autocomplete="off" name="seodesc" id="inputseodesc4" placeholder="Enter SEO Description" value="{{ old('seodesc')??'' }}">
                        <label for="inputseodesc4">SEO Description</label>
                        @if ($errors->has('seodesc'))
                        <small class="form-text text-danger">{{ $errors->first('seodesc') }}</small>
                        @endif
                    </div>
                </div>

                <div class="d-flex mt-2 justify-content-end">
                    <button type="submit" class="btn btn-outline-custom">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection
