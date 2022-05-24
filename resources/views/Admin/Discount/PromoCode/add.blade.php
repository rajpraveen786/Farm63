@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/discounts/promocode" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/discounts">Discounts</a></li>
            <li class="breadcrumb-item"><a href="/admin/discounts/promocode">Promo Code</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Add</li>
        </ol>
    </nav>
    <h3 class="mb-3 color-prim">Promo Codes - Add</h3>
    <form action="/admin/discounts/promocode/add" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
        <div class="row">
            <div class="col-sm-12 col-md-8 mt-2">
                <div class="card shadow-custom" style="border-radius: 8px">
                    <div class="card-body">
                        <h5 class="mb-3 color-prim">General</h5>
                        <div class="form-row my-2">
                            <div class="form-g
                            roup mt-2 col-md-12">
                                <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??'' }}">
                                <label for="inputName4">Name</label>
                                @if ($errors->has('name'))
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>
                        </div>
                        <h5 class="mb-3 color-prim">Photo</h5>
                        <div class="form-group">
                        <fileinput size="460px X 460px"  :error="{{ json_encode($errors->first('loc')??'') }}" id="loc" name="loc"></fileinput>                        </div>
                    </div>
                </div>
                <adminpromousage
                :oldoneuse="{{ json_encode(old('oneuse')??0) }}"
                :oldnoofuse="{{ json_encode(old('noofuse')??0) }}"
                :erroroneuse="{{ json_encode($errors->first('oneuse')) }}"
                :errornoofuse="{{ json_encode($errors->first('noofuse')) }}"
                ></adminpromousage>
                <adminpromotype
                :oldtype="{{ json_encode(old('type')??0) }}"
                :oldsubtype="{{ json_encode(old('subtype')??0) }}"
                :oldvalue="{{ json_encode(old('value')??[]) }}"
                :oldsubdata="{{ json_encode(old('subdata')??0) }}"
                :oldcode="{{ json_encode(old('code')??[]) }}"
                :oldoptid="{{ json_encode(old('optid')) }}"
                :category="{{ json_encode($category) }}"
                :products="{{ json_encode($products) }}"

                :errortype="{{ json_encode($errors->first('type')) }}"
                :errorcode="{{ json_encode($errors->first('code')??[]) }}"
                :errorsubtype="{{ json_encode($errors->first('subtype')) }}"
                :errorvalue="{{ json_encode($errors->first('value')??[]) }}"
                :errorsubdata="{{ json_encode($errors->first('subdata'??[])) }}"
                :erroroptid="{{ json_encode($errors->first('optid')) }}"
                ></adminpromotype>

                <adminpromominreq
                :oldminreq="{{ json_encode(old('minreq')??0) }}"
                :oldminreqdata="{{ json_encode(old('minreqdata')??0) }}"
                :errorminreq="{{ json_encode($errors->first('minreq')) }}"
                :errorminreqdata="{{ json_encode($errors->first('minreqdata')) }}"
                ></adminpromominr>



            </div>
            <div class="col-sm-12 col-md-4 mt-2">
                <div class="card shadow-custom sticky-md-top" style="border-radius: 8px">
                    <div class="card-body">
                        <div class="form-group">
                            <admindiscountdatetime
                            :oldstartdate="{{ json_encode(old('startdate')??'') }}"
                            :oldstarttime="{{ json_encode(old('starttime')??'') }}"
                            :oldenddate="{{ json_encode(old('enddate')??'') }}"
                            :oldendtime="{{ json_encode(old('endtime')??'') }}"
                            :errorstartdate="{{ json_encode($errors->first('startdate')??'') }}"
                            :errorstarttime="{{ json_encode($errors->first('starttime')??'') }}"
                            :errorenddate="{{ json_encode($errors->first('enddate')??'') }}"
                            :errorendtime="{{ json_encode($errors->first('endtime')??'') }}"></admindiscountdatetime>
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
