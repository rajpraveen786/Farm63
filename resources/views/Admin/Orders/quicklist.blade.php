@extends('layouts.admin')
@section('content')
<div class="container-fluid mt-3">
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card shadow-custom pt-3" style="border-radius: 8px">
                <adminorderindex :settings="{{ json_encode($settings) }}" :data="{{ json_encode($data) }}"></adminorderindex>
            </div>
        </div>
    </div>
</div>
@endsection
