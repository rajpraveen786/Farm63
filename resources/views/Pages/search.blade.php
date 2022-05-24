@extends('layouts.app')
@section('content')
<mssearch
    :category="{{ json_encode($category) }}"
    :brand="{{ json_encode($brand) }}"
    :searchdata="{{ json_encode($data) }}"

    :searchname="{{ json_encode($searchname) }}"
></mssearch>
@endsection
