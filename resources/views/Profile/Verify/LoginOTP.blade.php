@extends('layouts.app')

@section('content')
<div style="background-image: url('/storage/img/bgg1.png'); min-height: 80vh">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-5">
                <div class="card shadow-lg">
                    <div class="card-body">
                    <profileverifyloginotp :user="{{ json_encode(Auth::user()) }}"></profileverifyloginotp>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
