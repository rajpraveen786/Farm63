@extends('layouts.profile')

@section('subcontent')
<div style="background-image: url('/storage/img/bgg1.png'); min-height: 80vh">

<div class="container px-md-5 py-2">

    <ol class="breadcrumb breadcrumb-bar p-3 m-3" style="background-color: rgba(255, 255, 255, 0.8)">
        <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
        <li class="breadcrumb-item active font-prim font-weight-bold" aria-current="page" style="color: var(--prim)">
            Your Wishlist
        </li>
    </ol>

    <wishlist ></wishlist>
</div>
</div>
@endsection
