@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/customer" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/customer">Customer</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Edit</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Customer - Edit</h3>
            <form action="/admin/customer/edit/{{ encrypt($data->id) }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??$data->name??'' }}">
                        <label for="inputName4">Name</label>
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('email')? 'is-invalid ':'' }}" autocomplete="off" name="email" id="inputEmail4" placeholder="Enter Email" value="{{ old('email')??$data->email??'' }}">
                        <label for="inputEmail4">Email</label>
                        @if ($errors->has('email'))
                        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('phno')? 'is-invalid ':'' }}" autocomplete="off" name="phno" id="inputPhno4" placeholder="Enter Phone Number" value="{{ old('phno')??$data->phno??'' }}">
                        <label for="inputPhno4">Phone Number</label>
                        @if ($errors->has('phno'))
                        <small class="form-text text-danger">{{ $errors->first('phno') }}</small>
                        @endif
                    </div>
                <div class="col-sm-12 mt-2 col-md-6 mt-2">
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select name="status" class="form-control" id="status">
                            <option @if($data->status==1 ||old('status')=='1' ) selected @endif value="1">Allowed</option>
                            <option @if($data->status==0 ||old('status')=='0' ) selected @endif value="0">Blocked</option>
                        </select>
                    </div>
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
