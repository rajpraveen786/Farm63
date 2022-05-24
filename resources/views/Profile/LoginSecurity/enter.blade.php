@extends('layouts.profile')

@section('subcontent')
<div style="background-image: url('/storage/img/bgg1.png'); min-height: 80vh">

    <div class="container pt-3">
        <div class="row justify-content-center">
            <div class="col-md-10 mt-3">
                <ol class="breadcrumb breadcrumb-bar" style="background-color: rgba(255, 255, 255, 0.5)">
                    <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
                    <li class="breadcrumb-item"><a class='text-dark' href="/profile/security"> Login & Security </a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: var(--prim); font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                        {{ $title }}
                    </li>
                </ol>
            </div>
            <div class="col-md-10">
                <div class="card shadow">
                    <div class="card-body">
                        <h3 class="py-2 text-left font-weight-bold font-prim">{{ $title }}</h3>
                        <form method="POST" id="postdata" action="{{ $url }}">
                            @csrf
                            <div class="form-group">
                                <label for="inputdata">Name</label>
                                <input type="text" name="name" class="form-control {{ $errors->has('name')? 'is-invalid ':'' }}" value="{{ old('name')??$value?? ''}}" id="inputdata" aria-describedby="nameHelp" />
                                @if ($errors->has('name'))
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                            <div class="form-group row mb-0">
                                <div class="col-12">
                                    <button type="submit" class="btn btn-login-custom float-right">
                                        {{ $submit }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
