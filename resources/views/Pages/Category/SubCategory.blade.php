
@extends('layouts.app')
@section('content')
<subcategorypage
    :category="{{ json_encode($data) }}"
    :brand="{{ json_encode($brand) }}"
    :data="{{ json_encode($products) }}"

></subcategorypage>
@endsection
