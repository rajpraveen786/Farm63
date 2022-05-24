@extends('layouts.profile')

@section('subcontent')
<cart
:products="{{ json_encode($data) }}"
:buyagain="{{ json_encode($buyagain) }}"
:user="{{ json_encode(Auth::user()??'') }}"></cart>
@endsection
