@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/employee" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/employee">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                Edit</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Employee - Edit</h3>
            <form action="/admin/employee/edit/{{ encrypt($data->id) }}" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??$data->name??'' }}">
                        <label for="inputName4">Name</label>
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('email')? 'is-invalid ':'' }}" autocomplete="off" name="email" id="inputEmail4" placeholder="Enter Email" value="{{ old('email')??$data->email??'' }}">
                        <label for="inputEmail4">Email</label>
                        @if ($errors->has('email'))
                        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('phno')? 'is-invalid ':'' }}" autocomplete="off" name="phno" id="inputPhno4" placeholder="Enter Phone Number" value="{{ old('phno')??$data->phno??'' }}">
                        <label for="inputPhno4">Phone Number</label>
                        @if ($errors->has('phno'))
                        <small class="form-text text-danger">{{ $errors->first('phno') }}</small>
                        @endif
                    </div>
                    <div class="col-sm-12 mt-2 col-md-6 mt-2">
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select name="status" class="form-control" id="status">
                                <option @if($data->status==1 ||old('status')=='1' ) selected @endif value="1">Allowed</option>
                                <option @if($data->status==0 ||old('status')=='0' ) selected @endif value="0">Blocked</option>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="mt-3">
                    <h5>Permissions</h5>
                    <div class="row mt-3">
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="category">Category</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->category) checked @endif id="category" name="category" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="subcategory">Sub Category</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->subcategory) checked @endif id="subcategory" name="subcategory" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="brand">Brand</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->brand) checked @endif id="brand" name="brand" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>

                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="packing">Packing</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->packing) checked @endif checked id="packing" name="packing" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="uom">Unit Of Measure</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->uom) checked @endif id="uom" name="uom" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="attribute">Attribute</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->attribute) checked @endif id="attribute" name="attribute" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="tags">Tags</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->tags) checked @endif id="tags" name="tags" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="banner">Banner</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->banner) checked @endif id="banner" name="banner" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="cms">CMS</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->cms) checked @endif id="cms" name="cms" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="seo">SEO</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->seo) checked @endif id="seo" name="seo" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="pincode">Pincode</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->pincode) checked @endif id="pincode" name="pincode" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="contactus">Contact Us</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->contactus) checked @endif id="contactus" name="contactus" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="newsletter">NewsLetter</label>
                                </div>
                                <div class="col-7">
                                    <input @if($data->permission->general->newsletter) checked @endif id="newsletter" name="newsletter" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                    </div>
                    </div>
                    <table class="table table-responsive-sm mt-2">
                        <thead>
                            <tr>
                                <th>Description</th>
                                <th style="width:20%">Add</th>
                                <th style="width:20%">View</th>
                                <th style="width:20%">Edit</th>
                                <th style="width:20%">Delete</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <th>Products</th>
                                <td><input @if($data->permission->general->productsadd) checked @endif id="productsadd" name="productsadd" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->productsedit) checked @endif id="productsview" name="productsview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->productsview) checked @endif id="productsedit" name="productsedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->productsdel) checked @endif id="productsdel" name="productsdel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Store</th>
                                <td><input @if($data->permission->general->storeadd) id="storeadd" name="storeadd" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->storeedit) checked id="storeview" name="storeview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->storeview) id="storeedit" name="storeedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->storedel) id="storedel" name="storedel" type="checkbox" value="1" /></td>
                            </tr>

                            <tr>
                                <th>Employeee</th>
                                <td><input @if($data->permission->general->employeeadd) checked @endif id="employeeadd" name="employeeadd" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->employeeedit) checked @endif id="employeeview" name="employeeview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->employeeview) checked @endif id="employeeedit" name="employeeedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->employeedel) checked @endif id="employeedel" name="employeedel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Customer</th>
                                <td><input @if($data->permission->general->customeradd) checked @endif id="customeradd" name="customeradd" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->customeredit) checked @endif id="customerview" name="customerview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->customerview) checked @endif id="customeredit" name="customeredit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->customerdel) checked @endif id="customerdel" name="customerdel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Order</th>
                                <td></td>
                                <td><input @if($data->permission->general->orderedit) checked @endif id="orderview" name="orderview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->orderview) checked @endif id="orderedit" name="orderedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->orderdel) checked @endif id="orderdel" name="orderdel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Promo Code</th>
                                <td><input @if($data->permission->general->promocodeadd) checked @endif id="promocodeadd" name="promocodeadd" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->promocodeedit) checked @endif id="promocodeview" name="promocodeview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->promocodeview) checked @endif id="promocodeedit" name="promocodeedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->promocodedel) checked @endif id="promocodedel" name="promocodedel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Discounts</th>
                                <td><input @if($data->permission->general->discountsadd) checked @endif id="discountsadd" name="discountsadd" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->discountsedit) checked @endif id="discountsview" name="discountsview" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->discountsview) checked @endif id="discountsedit" name="discountsedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->discountsdel) checked @endif id="discountsdel" name="discountsdel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Review</th>
                                <td></td>
                                <td></td>
                                <td><input @if($data->permission->general->discountsedit) checked @endif id="reviewedit" name="reviewedit" type="checkbox" value="1" /></td>
                                <td><input @if($data->permission->general->discountsdel) checked @endif id="reviewdel" name="reviewdel" type="checkbox" value="1" /></td>
                            </tr>

                        </tbody>
                    </table>
                </div>

                <div class="d-flex mt-2 justify-content-end">
                    <button type="submit" class="btn btn-outline-custom">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
