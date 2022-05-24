@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <ol class="breadcrumb breadcrumb-bar p-0" style="background-color: transparent">
        <li class="breadcrumb-item"><a class='text-dark' href="/">Home </a></li>
        <li class="breadcrumb-item active font-prim font-weight-bold" aria-current="page" style="color: var(--prim)">
            Brand </li>
    </ol>
    <h4 class="font-weight-bold font-prim mt-4">Brand</h4>
    <hr>
    <div class="row py-3">
        @for($i=0;$i<$data->count();$i++)
            <div class="col-lg-4 col-md-4 col-6">
                <a href="/brand/{{ $data[$i]->name }}">
                    <div class="row ">
                        <div class="col-lg-3 col-md-5 col-8">
                            <img
                                src="/{{ $data[$i]->banner }}"
                                alt="{{ $data[$i]->name }}"
                                class="w-100"
                                style="height: clamp(5vh, 250px, 8vh)">
                        </div>
                        <div class="col-lg-9 col-md-7 col-12">
                            <h6 class="font-weight-bold mt-2 font-prim color-prim">
                            <span class="py-3">
                                {{ $data[$i]->name }}
                            </span></h6>
                        </div>
                    </div>
                </a>
                <hr>
            </div>
            @endfor
    </div>
</div>
@endsection
