@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/seo" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/seo">SEO</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Edit</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">SEO - {{ $data->page }}</h3>
            <form action="/admin/seo/{{ $data->page }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-12">
                        <input type="text" class="input-hov form-control {{ $errors->has('title')? 'is-invalid ':'' }}" autocomplete="off" name="title" id="inputDescription4" placeholder="Enter Description" value="{{ old('title')??$data->title??'' }}">
                        <label for="inputDescription4">Description</label>
                        @if ($errors->has('title'))
                        <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-12">
                        <input type="text" class="input-hov form-control {{ $errors->has('desc')? 'is-invalid ':'' }}" autocomplete="off" name="desc" id="inputDescription4" placeholder="Enter Description" value="{{ old('desc')??$data->desc??'' }}">
                        <label for="inputDescription4">Description</label>
                        @if ($errors->has('desc'))
                        <small class="form-text text-danger">{{ $errors->first('desc') }}</small>
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
