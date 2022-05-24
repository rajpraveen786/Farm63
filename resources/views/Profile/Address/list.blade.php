@extends('layouts.app')

@section('content')

    <div class="container pt-5">
        <ol class=" p-0 m-0 breadcrumb breadcrumb-bar" style="background-color: transparent">
            <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
            <li class="breadcrumb-item active font-prim" aria-current="page" style="color: var(--prim);">
                Your Address
            </li>
        </ol>
        <h3 class="py-2 font-prim font-weight-bold">Your Address</h3>
    </div>
    <div class="container">
        <div class="row">

            <div class="col-lg-3 col-md-4 col-12 my-2">
              <a href="/profile/address/new">

                <div class="card h-100 shadow-in" style="border: 1px dashed var(--prim);  box-shadow: inset 0 0.25rem 1rem rgba(0, 0, 0, 0.15) !important;">
                    <div class="card-body p-5 text-center">
                        <img loading="lazy" src="/storage/img/address.png" alt="" class="w-100 mb-4">
                        <span class="font-weight-bold font-prim">Add New Address</span>
                    </div>
                </div>
              </a>
            </div>
            @for($i=0;$i<$data->count();$i++)

            <div class="col-lg-3 col-md-4 col-sm-12 my-2">
                <div class="card h-100 shadow">
                    <div class="card-body align-item-center">
                        <h6 class="font-prim font-weight-bold color-prim mb-3">{{ $data[$i]->name }}</h6>
                        <span>{{ $data[$i]->phno }}</span><br>
                        <span>{{ $data[$i]->houseno }}</span><br>
                        <span>{{ $data[$i]->area }}</span><br>
                        <span>{{ $data[$i]->landmark }}</span><br>
                        <span>{{ $data[$i]->city }}</span>, <span>{{ $data[$i]->state }}</span>,
                        <span>{{ $data[$i]->pincode }}</span><br>
                        <span>{{ $data[$i]->country }}</span><br>
                        <span>{{ $data[$i]->default?'':'' }}</span><br>
                        <div class="mt-2 row">
                            <div class="col-6" style="border-right:1px solid black;">
                                <a class="text-muted float-right" href="/profile/address/edit/{{ encrypt($data[$i]->id) }}">
                                 <i class="mr-1 fas fa-pencil-alt color-prim"></i> Edit
                                </a>
                            </div>
                            <div class="col-6">
                                <a class="text-muted float-left" href="/profile/address/delete/{{ encrypt($data[$i]->id) }}" onclick="return confirm('Are you sure you want to delete ?');">
                                 <i class="mr-1 fas fa-trash-alt color-prim"></i> Delete
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endfor
        </div>
    </div>
@endsection

@section('styles')
<style>
    .blockstyle {
        background-image: url("data:image/svg+xml,%3csvg width='100%25' height='100%25' xmlns='http://www.w3.org/2000/svg'%3e%3crect width='100%25' height='100%25' fill='none' stroke='black' stroke-width='4' stroke-dasharray='6%2c 14' stroke-dashoffset='0' stroke-linecap='square'/%3e%3c/svg%3e");
    }

</style>
@endsection
