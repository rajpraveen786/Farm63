@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">

    <adminpincode :data='{{ json_encode($data) }}'
    :oldcity='{{ json_encode(request()->get('city') ?? '') }}'
    :oldpincode='{{ json_encode(request()->get('pincode') ?? '') }}'
    :oldstate='{{ json_encode(request()->get('state') ?? '') }}'
    :oldcountry='{{ json_encode(request()->get('country') ?? '') }}'
    :oldstatus='{{ json_encode(request()->get('status') ?? -1) }}'
    :oldstore='{{ json_encode(request()->get('store') ?? -1) }}'

    :store="{{ json_encode($stores) }}"
    ></adminpincode>
    <div class="d-flex mt-2 justify-content-center">
        {{ $data->appends([
            'city' => request()->get('city') ?? '',
            'country' => request()->get('country') ?? '',
            'state' => request()->get('state') ?? '',
            'pincode' => request()->get('pincode') ?? '',
            'cost' => request()->get('cost') ?? '',
            'deldays' => request()->get('deldays') ?? '',
            'status' => request()->get('status') ?? -1,
            'store' => request()->get('store') ?? -1,
            ])->render("pagination::bootstrap-4") }}
    </div>
</div>
@endsection
