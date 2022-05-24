@extends('layouts.app')

@section('content')
<div class="container">
    <ol class="breadcrumb breadcrumb-bar mt-4 p-0" style="background-color: transparent">
        <li class="breadcrumb-item"><a class='text-dark' href="/">Home </a></li>
        <li class="breadcrumb-item active font-prim font-weight-bold" aria-current="page" style="color: var(--prim)">
            Categories </li>
    </ol>
    <h4 class="font-weight-bold font-prim mt-4">Categories</h4><hr>
    <div class="row py-3">
        @for($i=0;$i<$data->count();$i++)
        <div class="col-lg-4 col-md-6 col-12">
                <a href="/category/{{ $data[$i]->name }}" class="useafter">
                            <img
                                src="/{{ $data[$i]->banner }}"
                                alt="{{ $data[$i]->name }}"
                                class="w-100"
                                style="border-radius: 5px">
                            <h6 class="font-weight-bold font-prim color-prim">
                            {{-- <img loading="lazy" class="w-100" src="/{{ $data[$i]->loc }}" alt="{{ $data[$i]->name }}"> --}}
                            <span class="py-3">
                                {{ $data[$i]->name }}
                            </span></h6>
                </a>
                <hr>
        </div>
        @endfor
    </div>
</div>
@endsection
