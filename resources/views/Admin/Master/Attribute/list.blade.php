@extends('layouts.admin')
@section('content')
<div class="container mt-3">

    <adminmasterattributeindex :data='{{ json_encode($data) }}' :oldsearch='{{ json_encode(request()->get('name') ?? '') }}'></adminmasterattributeindex>
    <div class="d-flex mt-2 justify-content-center">
        {{ $data->appends(['name' => request()->get('name') ?? ''])->render("pagination::bootstrap-4") }}
    </div>
</div>
@endsection
