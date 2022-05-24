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
                Add</li>
        </ol>
    </nav>
    <div class="card shadow-custom" style="border-radius: 8px">
        <div class="card-body">
            <h3 class="mb-3 color-prim">Employee - Add</h3>
            <form action="/admin/employee/add" method="POST" class="forms-" enctype="multipart/form-data"> @csrf
                <div class="form-row my-2">
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('name')? 'is-invalid ':'' }}" autocomplete="off" name="name" id="inputName4" placeholder="Enter Name" value="{{ old('name')??'' }}">
                        <label for="inputName4">Name</label>
                        @if ($errors->has('name'))
                        <small class="form-text text-danger">{{ $errors->first('name') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('email')? 'is-invalid ':'' }}" autocomplete="off" name="email" id="inputEmail4" placeholder="Enter Email" value="{{ old('email')??'' }}">
                        <label for="inputEmail4">Email</label>
                        @if ($errors->has('email'))
                        <small class="form-text text-danger">{{ $errors->first('email') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="text" class="input-hov form-control {{ $errors->has('phno')? 'is-invalid ':'' }}" autocomplete="off" name="phno" id="inputPhno4" placeholder="Enter Phone Number" value="{{ old('phno')??'' }}">
                        <label for="inputPhno4">Phone Number</label>
                        @if ($errors->has('phno'))
                        <small class="form-text text-danger">{{ $errors->first('phno') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="password" class="input-hov form-control {{ $errors->has('password')? 'is-invalid ':'' }}" autocomplete="off" name="password" id="inputPass4" placeholder="Enter Password" value="">
                        <label for="inputPass4">Password</label>
                        @if ($errors->has('password'))
                        <small class="form-text text-danger">{{ $errors->first('password') }}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2 col-md-6">
                        <input type="password" class="input-hov form-control {{ $errors->has('password_confirmation')? 'is-invalid ':'' }}" autocomplete="off" name="password_confirmation" id="inputPass4" placeholder="Enter Password  Confimation" value="">
                        <label for="inputPass4">Password Confimation</label>
                        @if ($errors->has('password_confirmation'))
                        <small class="form-text text-danger">{{ $errors->first('password_confirmation') }}</small>
                        @endif
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
                                    <input checked id="category" name="category" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="subcategory">Sub Category</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="subcategory" name="subcategory" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="brand">Brand</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="brand" name="brand" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="packing">Packing</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="packing" name="packing" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="uom">Unit Of Measure</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="uom" name="uom" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="attribute">Attribute</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="attribute" name="attribute" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="tags">Tags</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="tags" name="tags" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="banner">Banner</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="banner" name="banner" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="cms">CMS</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="cms" name="cms" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="seo">SEO</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="seo" name="seo" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="pincode">Pincode</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="pincode" name="pincode" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="contactus">Contact Us</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="contactus" name="contactus" type="checkbox" value="1" />
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-12 col-md-6 mt-3">
                            <div class="row">
                                <div class="col-5">
                                    <label for="newsletter">NewsLetter</label>
                                </div>
                                <div class="col-7">
                                    <input checked id="newsletter" name="newsletter" type="checkbox" value="1" />
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
                                <td><input id="productsadd" name="productsadd" type="checkbox" value="1" /></td>
                                <td><input checked id="productsview" name="productsview" type="checkbox" value="1" /></td>
                                <td><input id="productsedit" name="productsedit" type="checkbox" value="1" /></td>
                                <td><input id="productsdel" name="productsdel" type="checkbox" value="1" /></td>
                            </tr>
                            <tr>
                                <th>Store</th>
                                <td><input id="storeadd" name="storeadd" type="checkbox" value="1" /></td>
                                <td><input checked id="storeview" name="storeview" type="checkbox" value="1" /></td>
                                <td><input id="storeedit" name="storeedit" type="checkbox" value="1" /></td>
                                <td><input id="storedel" name="storedel" type="checkbox" value="1" /></td>
                            </tr>


                            <tr>
                                <th>Employee</th>
                                <td><input id="employeeadd" name="employeeadd" type="checkbox" value="1" /></td>
                                <td><input id="employeeview" name="employeeview" type="checkbox" value="1" /></td>
                                <td><input id="employeeedit" name="employeeedit" type="checkbox" value="1" /></td>
                                <td><input id="employeedel" name="employeedel" type="checkbox" value="1" /></td>
                            </tr>

                            <tr>
                                <th>Customer</th>
                                <td><input id="customeradd" name="customeradd" type="checkbox" value="1" /></td>
                                <td><input checked id="customerview" name="customerview" type="checkbox" value="1" /></td>
                                <td><input id="customeredit" name="customeredit" type="checkbox" value="1" /></td>
                                <td><input id="customerdel" name="customerdel" type="checkbox" value="1" /></td>
                            </tr>

                            <tr>
                                <th>Order</th>
                                <td></td>
                                <td><input checked id="orderview" name="orderview" type="checkbox" value="1" /></td>
                                <td><input id="orderedit" name="orderedit" type="checkbox" value="1" /></td>
                                <td><input id="orderdel" name="orderdel" type="checkbox" value="1" /></td>
                            </tr>

                            <tr>
                                <th>Promocode</th>
                                <td><input id="promocodeadd" name="promocodeadd" type="checkbox" value="1" /></td>
                                <td><input checked id="promocodeview" name="promocodeview" type="checkbox" value="1" /></td>
                                <td><input id="promocodeedit" name="promocodeedit" type="checkbox" value="1" /></td>
                                <td><input id="promocodedel" name="promocodedel" type="checkbox" value="1" /></td>
                            </tr>

                            <tr>
                                <th>Discounts</th>
                                <td><input id="discountsadd" name="discountsadd" type="checkbox" value="1" /></td>
                                <td><input checked id="discountsview" name="discountsview" type="checkbox" value="1" /></td>
                                <td><input id="discountsedit" name="discountsedit" type="checkbox" value="1" /></td>
                                <td><input id="discountsdel" name="discountsdel" type="checkbox" value="1" /></td>
                            </tr>

                            <tr>
                                <th>Review</th>
                                <td></td>
                                <td></td>
                                <td><input id="reviewedit" name="reviewedit" type="checkbox" value="1" /></td>
                                <td><input id="reviewdel" name="reviewdel" type="checkbox" value="1" /></td>
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
