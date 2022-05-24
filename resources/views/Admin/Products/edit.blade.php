@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/products" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/products">Products</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Edit</li>
        </ol>
    </nav>
    <h3 class="mb-3 color-prim">Products - Edit</h3>
    <form action="/admin/products/edit/{{ encrypt($data->id) }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
        <div class="row position-relative">
            <div class="col-sm-12 col-md-8 mt-2">
                <div class="card shadow-custom" style="border-radius: 8px">
                    <div class="card-body">
                        <h5 class="mb-3 color-prim">Basics</h5>
                        <div class="form-row my-2">
                            <div class="form-group mt-2 col-md-12">
                                <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??$data->name??'' }}">
                                <label for="inputName4">Name</label>
                                @if ($errors->has('name'))
                                <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                                @endif
                            </div>

                            <div class="form-group mt-2 col-12">
                                <descinput name="shortdesc" title="Short description" :content="{{ json_encode(old('shortdesc')??$data->shortdesc??'') }}"></descinput>
                                @if ($errors->has('shortdesc'))
                                <small class="form-text text-danger">{{ $errors->first('shortdesc') }}</small>
                                @endif
                            </div>
                            <div class="form-group mt-2 col-12">
                                <descinput name="desc" title="Description" :content="{{ json_encode(old('desc')??$data->desc??'') }}"></descinput>
                                @if ($errors->has('desc'))
                                <small class="form-text text-danger">{{ $errors->first('desc') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-custom mt-2" style="border-radius: 8px">
                    <div class="card-body">
                        <adminproductattribute :data="{{ json_encode($attribute) }}" :errorattribute="{{ json_encode($errors->first('attribute')??'') }}" :oldattribute="{{ json_encode(old('attribute')??$data->attribute) }}"></adminproductattribute>
                    </div>
                </div>
                <div class="card shadow-custom mt-2" style="border-radius: 8px">
                    <div class="card-body">
                        <h5 class="mb-3 color-prim">Pricing</h5>
                        <adminproductpricing :data="{{ json_encode($data) }}" :errorcpi="{{ json_encode($errors->first('cpi')??'') }}" :errordisp="{{ json_encode($errors->first('disp')??'') }}" :errorfpricewtas="{{ json_encode($errors->first('fpricewtas')??'') }}" :errortaxp="{{ json_encode($errors->first('taxp')??'') }}" :oldcpi="{{ json_encode(old('cpi')??$data->cpi??'') }}" :oldfpricewtas="{{ json_encode(old('fpricewtas')??$data->fpricewtas??'') }}" :oldtaxp="{{ json_encode(old('taxp')??$data->taxp??'') }}" :olddisp="{{ json_encode(old('disp')??$data->disp??'') }}"></adminproductpricing>
                    </div>
                </div>

                <div class="mt-2 ">
                    <adminproductphoto :data='{{ json_encode($data->images) }}' :link='{{ json_encode('/admin/products/addphoto/'.encrypt($data->id)) }}'></adminproductphoto>
                    <small class="form-text text-muted">Image must be of size 460px X 460px</small>

                </div>

                <div class="card shadow-custom mt-2" style="border-radius: 8px">
                    <div class="card-body">
                        <h5 class="mb-3 color-prim">Inventory</h5>
                        <adminproductinventory
                        :errorsku="{{ json_encode($errors->first('sku')??'') }}"
                            :oldsku="{{ json_encode(old('sku')??$data->sku??'') }}"
                            :errorbarcode="{{ json_encode($errors->first('barcode')??'') }}"
                            :oldbarcode="{{ json_encode(old('barcode')??$data->barcode??'') }}"
                            :errortrackqty="{{ json_encode($errors->first('trackqty')??'') }}"
                            :oldtrackqty="{{ json_encode(old('trackqty')??$data->trackqty??'') }}"
                            :erroroosc="{{ json_encode($errors->first('oosc')??'') }}"
                            :oldoosc="{{ json_encode(old('oosc')??$data->oosc??'') }}"
                            :errorstock="{{ json_encode($errors->first('stock')??'') }}"
                            :oldstock="{{ json_encode(old('stock')??$data->stock??'') }}"
                            :errorminstock="{{ json_encode($errors->first('minstock')??'') }}"
                            :oldminstock="{{ json_encode(old('minstock')??$data->minstock??'') }}"
                            ></adminproductinventory>
                    </div>
                </div>
                <div class="card shadow-custom mt-2" style="border-radius: 8px">
                    <div class="card-body">
                        <h5 class="mb-3 color-prim">Shipping</h5>
                        <div class="form-row my-2">
                            <div class="form-group mt-2 col-md-6 col-sm-12">
                                <input type="text" min=0 class="input-hov form-control {{ $errors->has('weight')? 'is-invalid ':'' }}" autocomplete="off" name="weight" id="inputWeight4" placeholder="Enter Weight" value="{{ old('weight')??$data->weight??0 }}">
                                <label for="inputWeight4">Weight</label>
                                @if ($errors->has('weight'))
                                <small class="form-text text-danger">{{ $errors->first('weight') }}</small>
                                @endif
                            </div>
                            <div class="form-group mt-2 col-md-6 col-sm-12">
                                <label for="wgunit">Weight Unit</label>
                                <select name="wgunit" class="form-control" id="wgunit">
                                    <option @if(old('wgunit') && old('wgunit')==0 || $data->wgunit==0) selected @else selected @endif value="0">Kg</option>
                                    <option @if(old('wgunit') && old('wgunit')==1 || $data->wgunit==1) selected @endif value="1">g</option>

                                </select>
                                @if ($errors->has('weight'))
                                <small class="form-text text-danger">{{ $errors->first('weight') }}</small>
                                @endif
                            </div>

                            <div class="form-group mt-2 col-md-6 col-sm-12">
                                <input type="text" min=0 class="input-hov form-control {{ $errors->has('length')? 'is-invalid ':'' }}" autocomplete="off" name="length" id="inputlength4" placeholder="Enter Length" value="{{ old('length')??$data->length??0 }}">
                                <label for="inputlength4">Length</label>
                                @if ($errors->has('length'))
                                <small class="form-text text-danger">{{ $errors->first('length') }}</small>
                                @endif
                            </div>
                            <div class="form-group mt-2 col-md-6 col-sm-12">
                                <input type="text" min=0 class="input-hov form-control {{ $errors->has('width')? 'is-invalid ':'' }}" autocomplete="off" name="width" id="inputwidth4" placeholder="Enter Width" value="{{ old('width')??$data->width??0 }}">
                                <label for="inputwidth4">Width</label>
                                @if ($errors->has('width'))
                                <small class="form-text text-danger">{{ $errors->first('width') }}</small>
                                @endif
                            </div>
                            <div class="form-group mt-2 col-md-6 col-sm-12">
                                <input type="text" min=0 class="input-hov form-control {{ $errors->has('breadth')? 'is-invalid ':'' }}" autocomplete="off" name="breadth" id="inputbreadth4" placeholder="Enter Breadth" value="{{ old('breadth')??$data->breadth??0 }}">
                                <label for="inputbreadth4">Breadth</label>
                                @if ($errors->has('breadth'))
                                <small class="form-text text-danger">{{ $errors->first('breadth') }}</small>
                                @endif
                            </div>
                            <div class="form-group mt-2 col-md-6 col-sm-12">
                                <label for="lunit">Length Unit</label>
                                <select name="lunit" class="form-control" id="lunit">
                                    <option @if(old('lunit') && old('lunit')==0 || $data->lunit==0) selected @else selected @endif value="0">Kg</option>

                                </select>
                                @if ($errors->has('lunit'))
                                <small class="form-text text-danger">{{ $errors->first('lunit') }}</small>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card shadow-custom mt-2" style="border-radius: 8px">
                    <div class="card-body">
                        <h5 class="mb-3 color-prim">SEO</h5>
                        <div class="form-row my-2">
                            <div class="form-group mt-2 col-12">
                                <input type="text" min=0 class="input-hov form-control {{ $errors->has('seo_title')? 'is-invalid ':'' }}" autocomplete="off" name="seo_title" id="inputTitle4" placeholder="Enter Title" value="{{ old('seo_title')??$data->seo_title??'' }}">
                                <label for="inputTitle4">Title</label>
                                @if ($errors->has('seo_title'))
                                <small class="form-text text-danger">{{ $errors->first('seo_title') }}</small>
                                @endif
                            </div>
                            <div class="form-group mt-2 col-12">
                                <h6 for="inputdescription4">Description</h6>
                                <textarea name="seo_desc" class="input-hov form-control w-100 {{ $errors->has('seo_desc')? 'is-invalid ':'' }}" id="" rows="5">{{ old('seo_desc')??$data->seo_desc }}</textarea>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-sm-12 col-md-4 mt-2">
                <div class="card shadow-custom sticky-top" style="border-radius: 8px; top: 8vh">
                    <div class="card-body">
                        <div class="form-group">
                            <label for="linkt">Status </label>
                            <select name="status" class="form-control" id="linkt">
                                <option @if(old('status') && old('status')==0 || $data->status==0) selected @else selected @endif value="0">Draft</option>
                                <option @if(old('status') && old('status')==1 || $data->status==1) selected @endif value="1">Active</option>
                            </select>
                        </div>
                        <hr>
                        <adminproductcategory :data="{{ json_encode($category) }}" :olddataid="{{ json_encode(old('cid')??$data->cid??'') }}" :oldsubdataid="{{ json_encode(old('scid')??$data->scid??'') }}"></adminproductcategory>
                        <hr>
                        <selectval :data="{{ json_encode($brand) }}" :title="{{ json_encode('Brand') }}" :label="{{ json_encode('name') }}" :formname="{{ json_encode('bid') }}" :olddataid="{{ json_encode(old('bid')??$data->bid??'') }}"></selectval>
                        <hr>
                        <selectval :data="{{ json_encode($uom) }}" :title="{{ json_encode('UOM') }}" :label="{{ json_encode('name') }}" :formname="{{ json_encode('uomid') }}" :olddataid="{{ json_encode(old('uomid')??$data->uomid??'') }}"></selectval>
                        <hr>
                        <selectval :data="{{ json_encode($packing??'') }}" :title="{{ json_encode('Packing') }}" :label="{{ json_encode('name') }}" :formname="{{ json_encode('packingid') }}" :olddataid="{{ json_encode(old('packingid')??$data->packingid??'') }}"></selectval>
                        <hr>
                        <adminproducttags :data="{{ json_encode($tags) }}" :title="{{ json_encode('Tags') }}" :label="{{ json_encode('name') }}" :formname="{{ json_encode('tags') }}" :olddataid="{{ json_encode(old('tags')??$data->tags??[]) }}"></adminproducttags>
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
