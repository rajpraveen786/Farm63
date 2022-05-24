@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/products" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/products">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Bulk Edit</li>
        </ol>
    </nav>
    <h3 class="mb-3 color-prim">Products - Bulk Edit</h3>
    <form action="/admin/products/bulkupdate" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
        <button type="submit" class="float-right btn btn-success" style="margin-top: -3rem"><i class="fa fa-save fa-fw" aria-hidden="true"></i> Save </button>
        <adminproductbulkupdate :data="{{ json_encode($data) }}"></adminproductbulkupdate>
    </form>
</div>
@endsection
