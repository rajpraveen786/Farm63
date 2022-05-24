@extends('layouts.profile')

@section('subcontent')

<print :settings="{{ json_encode($settings) }}" :data="{{ json_encode($data) }}" :backlink="{{ json_encode(URL::previous()) }}"></print>

@endsection
