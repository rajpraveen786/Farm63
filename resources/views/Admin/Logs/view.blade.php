@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/logs" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/logs">Logs</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        <a href="/admin/logs/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                    </div>
                    <h4 class="color-prim"><strong> Logs</strong></h4>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Page</h6>
                                {{$data->page}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>User</h6>
                                <a href="/admin/employee/view/{{ encrypt($data->user->id) }}">
                                    {{$data->user->name}}</a>
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Type</h6>
                                @if($data->type ==0)
                                Add
                                @elseif($data->type ==1)
                                Edit
                                @else
                                Delete
                                @endif
                            </div>
                        </div>
                    </div>

                    <div class="mt-3">
                        <adminlogs :newdata="{{ $data->newdata??json_encode('') }}" :olddata="{{ $data->olddata??json_encode('') }}"></adminlogs>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
