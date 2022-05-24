@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/store" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/store">Store</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Edit</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Store - Edit</h3>
            <form action="/admin/store/edit/{{ encrypt($data->id) }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??$data->name??'' }}">
                        <label for="inputName4">Name</label>
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('location')? 'is-invalid ':'' }}" autocomplete="off" name="location" id="inputName4" placeholder="Enter Location" value="{{ old('location')??$data->general->location??'' }}">
                        <label for="inputLocation4">Location</label>
                        @if ($errors->has('location'))
                        <small class="form-text text-danger">{{ $errors->first('location') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="linkt">Status</label>
                        <select name="status" class="form-control" id="linkt">
                            <option @if(old('status') && old('status')==0) selected @endif value="0">Draft</option>
                            <option @if(old('status') && old('status')==1) selected @else selected @endif value="1">Active</option>
                        </select>
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
