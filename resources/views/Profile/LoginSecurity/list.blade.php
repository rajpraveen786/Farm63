@extends('layouts.profile')

@section('subcontent')
<div style="background-image: url('/storage/img/bgg1.png'); min-height: 80vh">

<div class="container pt-3">
    <div class="row justify-content-center">
        <div class="col-12">
            <ol class="breadcrumb breadcrumb-bar" style="background-color: rgba(255, 255, 255, 0.7)">
                <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
                <li class="breadcrumb-item active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                    Login & Security </li>
            </ol>
        </div>
        <div class="col-12 col-sm-12">
            <div class="card shadow">
                <div class="card-body">

                    <ul style="list-style: none" class='p-0 m-0'>
                        <li>
                            <div class="w-100">
                                <a href="/profile/security/name" class="btn float-right link-success text-muted"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <h6 style="font-weight:900;font-size:16px">Name:</h6>
                                {{ Auth::user()->name }}
                            </div>
                        </li>
                        <hr>
                        <li class=''>
                            <div class="w-100">
                                <a href="/profile/security/phone" class="btn float-right link-success text-muted"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <h6 style="font-weight:900;font-size:16px">Phone:</h6>
                                {{ Auth::user()->phno }}
                            </div>
                        </li>
                        <hr>
                        <li class=''>
                            <div class="w-100">
                                <a href="/profile/security/email" class="btn float-right link-success text-muted"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <h6 style="font-weight:900;font-size:16px">Email:</h6>
                                {{ Auth::user()->email }}
                            </div>
                        </li>
                        <hr>
                        <li class=''>
                            <div class="w-100">
                                <a href="/profile/security/password" class="btn float-right link-success text-muted"><i class="fas fa-pencil-alt"></i> Edit</a>
                                <h6 style="font-weight:900;font-size:16px">Password:</h6>

                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
@endsection
