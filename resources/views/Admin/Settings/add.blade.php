@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <form action="/admin/settings" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
        <div class="row justify-content-center">
            <div class="col-sm-12 col-md-8">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb" style="background-color: transparent">
                        <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
                        <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                            Settings</li>
                    </ol>
                </nav>
                <div class="card shadow-custom" style="border-radius: 8px">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="inputdata">Name</label>
                            <input type="text" name="name" class="form-control {{ $errors->has('name')? 'is-invalid ':'' }}" value="{{ old('name')??$data[0]->value?? ''}}" id="inputdata" aria-describedby="nameHelp" />
                            @if ($errors->has('name'))
                            <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">Address 1</label>
                            <input type="text" name="ad1" class="form-control {{ $errors->has('ad1')? 'is-invalid ':'' }}" value="{{ old('ad1')??$data[1]->value?? ''}}" id="inputdata" aria-describedby="ad1Help" />
                            @if ($errors->has('ad1'))
                            <small class="form-text text-danger">{{ $errors->first('ad1') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">Address 2</label>
                            <input type="text" name="ad2" class="form-control {{ $errors->has('ad2')? 'is-invalid ':'' }}" value="{{ old('ad2')??$data[2]->value?? ''}}" id="inputdata" aria-describedby="ad2Help" />
                            @if ($errors->has('ad2'))
                            <small class="form-text text-danger">{{ $errors->first('ad2') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">Address 3</label>
                            <input type="text" name="ad3" class="form-control {{ $errors->has('ad3')? 'is-invalid ':'' }}" value="{{ old('ad3')??$data[3]->value?? ''}}" id="inputdata" aria-describedby="ad3Help" />
                            @if ($errors->has('ad3'))
                            <small class="form-text text-danger">{{ $errors->first('ad3') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">City</label>
                            <input type="text" name="city" class="form-control {{ $errors->has('city')? 'is-invalid ':'' }}" value="{{ old('city')??$data[4]->value?? ''}}" id="inputdata" aria-describedby="cityHelp" />
                            @if ($errors->has('city'))
                            <small class="form-text text-danger">{{ $errors->first('city') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">State</label>
                            <input type="text" name="state" class="form-control {{ $errors->has('state')? 'is-invalid ':'' }}" value="{{ old('state')??$data[5]->value?? ''}}" id="inputdata" aria-describedby="stateHelp" />
                            @if ($errors->has('state'))
                            <small class="form-text text-danger">{{ $errors->first('state') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">PinCode</label>
                            <input type="text" name="pincode" class="form-control {{ $errors->has('pincode')? 'is-invalid ':'' }}" value="{{ old('pincode')??$data[6]->value?? ''}}" id="inputdata" aria-describedby="pincodeHelp" />
                            @if ($errors->has('pincode'))
                            <small class="form-text text-danger">{{ $errors->first('pincode') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">Country</label>
                            <input type="text" name="country" class="form-control {{ $errors->has('country')? 'is-invalid ':'' }}" value="{{ old('country')??$data[7]->value?? ''}}" id="inputdata" aria-describedby="countryHelp" />
                            @if ($errors->has('country'))
                            <small class="form-text text-danger">{{ $errors->first('country') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">PAN NO</label>
                            <input type="text" name="panno" class="form-control {{ $errors->has('panno')? 'is-invalid ':'' }}" value="{{ old('panno')??$data[8]->value?? ''}}" id="inputdata" aria-describedby="pannoHelp" />
                            @if ($errors->has('panno'))
                            <small class="form-text text-danger">{{ $errors->first('panno') }}</small>
                            @endif
                        </div>
                        <div class="form-group mt-4">
                            <label for="inputdata">GST NO</label>
                            <input type="text" name="gstno" class="form-control {{ $errors->has('gstno')? 'is-invalid ':'' }}" value="{{ old('gstno')??$data[9]->value?? ''}}" id="inputdata" aria-describedby="gstnoHelp" />
                            @if ($errors->has('gstno'))
                            <small class="form-text text-danger">{{ $errors->first('gstno') }}</small>
                            @endif
                        </div>
                        <div class="d-flex mt-3 justify-content-end">
                            <button type="submit" class="btn btn-outline-custom"><i class="fas fa-save    "></i> Save</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>
</div>
@endsection
