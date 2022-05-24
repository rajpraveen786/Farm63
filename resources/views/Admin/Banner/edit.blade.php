@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/banner" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/banner">Banner</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Edit</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Banner - Edit</h3>
            <form action="/admin/banner/edit/{{ encrypt($data->id) }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??$data->name??'' }}">
                        <label for="inputName4">Name</label>
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="linkt">Status </label>
                        <select name="status" class="form-control" id="linkt">
                            <option @if(old('status') && old('status')==0 || $data->status==0) selected @else selected @endif value="0">Draft</option>
                            <option @if(old('status') && old('status')==1 || $data->status==1) selected @endif value="1">Active</option>
                        </select>
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="">Photo</label>
                        <fileinput size="1400px X 500px"  :error="{{ json_encode($errors->first('loc')??'') }}" id="loc" name="loc"></fileinput>
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('desc')? 'is-invalid ':'' }}" autocomplete="off" name="desc" id="inputDescription4" placeholder="Enter Description" value="{{ old('desc')??$data->desc??'' }}">
                        <label for="inputDescription4">Description</label>
                        @if ($errors->has('desc'))
                        <small class="form-text text-danger">{{ $errors->first('desc') }}</small>
                        @endif
                    </div>

                    <div class="mt-2 col-12">
                        <adminbannerindex :category='{{ json_encode($category) }}' :brand='{{ json_encode($brand) }}' :products='{{ json_encode($products) }}' :oldlinkt='{{ json_encode(old('linkt')??$data->linkt??'') }}' :oldoptsel='{{ json_encode(old('optsel')??$data->optsel??'') }}' :errorlink='{{ json_encode($errors->first('linkt')??'') }}' :erroroptsel='{{ json_encode($errors->first('optsel')??'') }}'></adminbannerindex>
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
