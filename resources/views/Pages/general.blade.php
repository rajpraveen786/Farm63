@extends('layouts.app')


@section('content')
<div class="mt-3 container-fluid">
    <ol class="breadcrumb breadcrumb-bar p-0" style="background-color: transparent">
        <li class="breadcrumb-item"><a class='text-dark' href="/">Home </a></li>
        <li class="breadcrumb-item active font-prim font-weight-bold" aria-current="page" style="color: var(--prim)">
            {{ $title }} </li>
    </ol>
</div>
<div class="container-fluid" style="height: 100%; background-color: #f5fcf5">
    <div class="row">
        <div class="position-relative col-12" class="general-bread" style="
        background:linear-gradient(0deg, rgba(3, 175, 26, 0.3), rgba(3, 175, 26, 0.3)), url(/storage/img/greencrop.jpg); height: 30vh;">
        </div>
        <div class="col-12 p-lg-5">
            <h6 class="text-muted text-uppercase mb-2">Agreement</h6>
            <h3 class="font-prim font-weight-bold mb-3" style="font-weight:900">{{ $title }}</h3>
            <hr>
            <descview class="" :content="{{json_encode($data->desc)}}"></descview>
        </div>
    </div>
</div>
@endsection
