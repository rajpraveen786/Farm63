@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/newsletter" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/newsletter">Newsletter</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Add</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Newsletter - Add</h3>
            <form action="/admin/newsletter/add" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('title')? 'is-invalid ':'' }}" autocomplete="off" name="title" id="inputTitle4" placeholder="Enter Title" value="{{ old('title')??'' }}">
                        <label for="inputTitle4">Title</label>
                        @if ($errors->has('title'))
                        <small class="form-text text-danger">{{ $errors->first('title') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <label for="linkt">Status</label>
                        <select name="status" class="form-control" id="linkt">
                            <option @if(old('status') && old('status')==0) selected @else selected @endif value="0">Draft</option>
                            <option @if(old('status') && old('status')==1) selected @endif value="1">Active</option>
                        </select>
                    </div>
                </div>
                    <adminnewsletterindex
                        :oldsubject="{{ json_encode(old('oldsubject')) }}"
                        :oldcontent="{{ json_encode(old('oldcontent')) }}"
                        :olddatetime="{{ json_encode(old('olddatetime')) }}"
                        :oldtemplate="{{ json_encode(old('oldtemplate')) }}"

                        :errorsubject="{{ json_encode($errors->first('subject')) }}"
                        :errorcontent="{{ json_encode($errors->first('content')) }}"
                        :errordatetime="{{ json_encode($errors->first('datetime')) }}"
                        :errorloce="{{ json_encode($errors->first('loc')) }}"

                    ></adminnewsletterindex>
                <div class="d-flex mt-2 justify-content-end">
                    <button type="submit" class="btn btn-outline-custom">
                        <i class="fas fa-save    "></i>
                        Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
