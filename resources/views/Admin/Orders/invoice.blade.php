@extends('layouts.admin')

@section('content')

<print  :settings="{{ json_encode($settings) }}" :data="{{ json_encode($data) }}" :backlink="{{ json_encode(URL::previous()) }}"></print>

@endsection
