@extends('layouts.app')

@section('content')

<div>
        @if (Session::has('status'))
        <div class="alert alert-success">
            {{ Session('status') }}
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {{ Session('error') }}
        </div>
        @endif
    @yield('subcontent')
</div>

@endsection


