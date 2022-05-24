@extends('layouts.app')
@section('content')
<mscategory
    :category="{{ json_encode($category) }}"
    :brand="{{ json_encode($brand) }}"
    :searchdata="{{ json_encode($data) }}"

    :searchname="{{ json_encode($searchname) }}"
></mscategory>
@endsection
