
@extends('layouts.app')
@section('content')
<brandpage
    :brand="{{ json_encode($data) }}"
    :category="{{ json_encode($category) }}"
    :data="{{ json_encode($products) }}"

></brandpage>
@endsection
