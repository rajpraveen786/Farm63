@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/cms" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                CMS</li>
        </ol>
    </nav>
    <form action="/admin/cms/{{ $name }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
        <div class="container-fluid">
            <div class="card shadow-custom" style="border-radius: 8px">
                <div class="card-body">
                    <h3 class="color-prim">Details</h3>
                    <div class="form-row my-2">
                        <div class="form-group mt-2 col-12">
                            <descinput name="value" title="" :content="{{ json_encode(old('value')??$data->desc??'') }}"></descinput>
                            @if ($errors->has('value'))
                            <small class="form-text text-danger">{{ $errors->first('value') }}</small>
                            @endif
                        </div>
                    </div>
                    <div class="d-flex mt-3 justify-content-end">
                        <button type="submit" class="btn btn-outline-custom"><i class="fas fa-save    "></i> Save</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
