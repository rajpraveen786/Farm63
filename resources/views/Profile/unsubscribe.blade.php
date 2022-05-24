@extends('layouts.app')

@section('content')
<div class="container-fluid" style="background-image: url('/storage/img/unsub.jpg'); background-position: center;background-size: cover; ">
    <div class="row align-items-center justify-content-center" style="min-height: 80vh">
        <div class="col-lg-5 offset-lg-6 col-md-7 offset-md-5 col-10">
            <div class="card shadow card-body" style="border-radius: 10px; background-color: rgba(255, 255, 255, 0.2); color: white">
                <h5 class="font-prim font-weight-bold">We're so sorry to see you go!</h5>
                <p class="mb-0 mt-3">Click to <a href="" style="color: var(--prim); margin: auto 0.25rem; font-weight: bold"> subscribe</a> if this was an accident</p>
                <p class="mt-0">Visit our <a href="/" style="color: var(--prim); margin: auto 0.25rem; font-weight: bold"> Homepage</a> to shop from our exciting deals</p>
            </div>
        </div>
    </div>
</div>
@endsection
