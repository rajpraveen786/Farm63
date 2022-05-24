@extends('layouts.profile')

@section('subcontent')
<div class="container-fluid">

    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="container ">
                <ol class="breadcrumb" style="background-color: transparent">
                    <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
                    <li class="breadcrumb-item"><a class='text-dark' href="/profile/address">Your Address </a></li>
                    <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                        {{ $title }} </li>
                </ol>
                <h3 class="py-2 text-left">{{ $title }}</h3>
            </div>
            <div class="card">
                <div class="card-body">

                    <form method="POST" id="postdata" action="{{ $url }}">
                        @csrf
                        <profileaddressnew
                        :oldpid="{{ json_encode(old('pid')??$data->id??'') }}"
                        :oldname="{{ json_encode(old('name')??$data->name??'') }}"
                        :oldphno="{{ json_encode(old('phno')??$data->phno??'') }}"
                        :oldpincode="{{ json_encode(old('pincode')??$data->pincode??'') }}"
                        :oldcountry="{{ json_encode(old('country')??$data->country??'') }}"
                        :oldstate="{{ json_encode(old('state')??$data->state??'') }}"
                        :oldcity="{{ json_encode(old('city')??$data->city??'') }}"
                        :oldhouseno="{{ json_encode(old('houseno')??$data->houseno??'') }}"
                        :oldarea="{{ json_encode(old('area')??$data->area??'') }}"
                        :oldlandmark="{{ json_encode(old('landmark')??$data->landmark??'') }}"
                        :olddefault="{{ json_encode(old('default')??$data->default??0) }}"

                        :errorname="{{ json_encode($errors->first('name')??'') }}"
                        :errorphno="{{ json_encode($errors->first('phno')??'') }}"
                        :errorpincode="{{ json_encode($errors->first('pincode')??'') }}"
                        :errorcountry="{{ json_encode($errors->first('country')??'') }}"
                        :errorstate="{{ json_encode($errors->first('state')??'') }}"
                        :errorcity="{{ json_encode($errors->first('city')??'') }}"
                        :errorhouseno="{{ json_encode($errors->first('houseno')??'') }}"
                        :errorarea="{{ json_encode($errors->first('area')??'') }}"
                        :errorlandmark="{{ json_encode($errors->first('landmark')??'') }}"
                        :submit="{{ json_encode($submit) }}"
                        {{-- errorname="{{ json_encode($errors->first('name')??'') }}",
                        errorphno="{{ json_encode($errors->first('phno')??'') }}",
                        errorpincode="{{ json_encode($errors->first('pincode')??'') }}",
                        errorcountry="{{ json_encode($errors->first('country')??'') }}",
                        errorstate="{{ json_encode($errors->first('state')??'') }}",
                        errorcity="{{ json_encode($errors->first('city')??'') }}",
                        errorhouseno="{{ json_encode($errors->first('house')??'') }}",
                        errorarea="{{ json_encode($errors->first('area')??'') }}",
                        errorlandmark="{{ json_encode($errors->first('landmark')??'') }}", --}}

                        ></profileaddressnew>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
