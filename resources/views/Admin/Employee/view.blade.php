



@extends('layouts.admin')
@section('content')
<div class="container mt-4">
    <nav aria-label="breadcrumb">
        <div class="float-right">
            <a href="/admin/employee" class="btn btn-custom py-1"><i class="fa fa-caret-left fa-fw" aria-hidden="true"></i> Back</a>
        </div>
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fas fa-home fa-lg"></i> </a></li>
            <li class="breadcrumb-item"><a href="/admin/employee">Employee</a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif"> View</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-lg- col-sm-12">
            <div class="card shadow-sm" style="border-radius: 8px">
                <div class="card-body">
                    <div class="float-right">
                        <a href="/admin/employee/edit/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-custom"><i class="fas fa-edit"></i> <span class="d-none d-md-inline"> Edit</span></a>
                        <a href="/admin/employee/delete/{{ encrypt($data->id) }}" class="mx-1 btn btn-outline-danger" onclick="return confirm('Are you sure you want to delete ?');">
                            <i class="fas fa-trash"></i> <span class="d-none d-md-inline"> Delete</span></a>
                    </div>
                    <h4 class="color-prim"><strong> Employee - {{ $data->name }}</strong></h4>
                    <div class="container mt-4">
                        <div class="row">
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Name</h6>
                                {{$data->name}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Phone Number</h6>
                                {{$data->phno}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Email</h6>
                                {{$data->email}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Email Verified</h6>
                                {{$data->email_verified_at?'Verified':'Not Verified'}}
                            </div>
                            <div class="col-sm-12 col-md-6 mt-3">
                                <h6>Status</h6>
                                {{$data->status?'Allowed':'Draft'}}
                            </div>
                        </div>
                    </div>

            <div class="mt-5">
                <h5>Permissions</h5>
                <div class="row mt-3">
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="category">Category</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->category) checked @endif id="category" name="category" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="subcategory">Sub Category</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->subcategory) checked @endif id="subcategory" name="subcategory" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="brand">Brand</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->brand) checked @endif id="brand" name="brand" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="brand">Packing</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->packing) checked @endif id="brand" name="brand" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="uom">UOM</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->uom) checked @endif id="uom" name="uom" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="attribute">Attribute</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->attribute) checked @endif id="attribute" name="attribute" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="tags">Tags</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->tags) checked @endif id="tags" name="tags" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="banner">Banner</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->banner) checked @endif id="banner" name="banner" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="cms">CMS</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->cms) checked @endif id="cms" name="cms" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="seo">SEO</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->seo) checked @endif id="seo" name="seo" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="pincode">Pincode</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->pincode) checked @endif id="pincode" name="pincode" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="contactus">Contact Us</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->contactus) checked @endif id="contactus" name="contactus" type="checkbox" value="1" />
                            </div>
                        </div>
                    </div>
                    <div class="col-sm-12 col-md-6 mt-3">
                        <div class="row">
                            <div class="col-5">
                                <label for="newsletter">News    Letter</label>
                            </div>
                            <div class="col-7">
                                <input disabled @if($data->permission->general->newsletter) checked @endif id="newsletter" name="newsletter" type="checkbox" value="1" />
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
                            <td><input disabled @if($data->permission->general->productsadd) checked @endif id="productsadd" name="productsadd" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->productsedit) checked @endif id="productsview" name="productsview" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->productsview) checked @endif id="productsedit" name="productsedit" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->productsdel) checked @endif id="productsdel" name="productsdel" type="checkbox" value="1" /></td>
                        </tr>
                        <tr>
                            <th>Employeee</th>
                            <td><input disabled @if($data->permission->general->employeeadd) checked @endif id="employeeadd" name="employeeadd" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->employeeedit) checked @endif id="employeeview" name="employeeview" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->employeeview) checked @endif id="employeeedit" name="employeeedit" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->employeedel) checked @endif id="employeedel" name="employeedel" type="checkbox" value="1" /></td>
                        </tr>
                        <tr>
                            <th>Customer</th>
                            <td><input disabled @if($data->permission->general->customeradd) checked @endif id="customeradd" name="customeradd" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->customeredit) checked @endif id="customerview" name="customerview" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->customerview) checked @endif id="customeredit" name="customeredit" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->customerdel) checked @endif id="customerdel" name="customerdel" type="checkbox" value="1" /></td>
                        </tr>
                        <tr>
                            <th>Order</th>
                            <td></td>
                            <td><input disabled @if($data->permission->general->orderedit) checked @endif id="orderview" name="orderview" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->orderview) checked @endif id="orderedit" name="orderedit" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->orderdel) checked @endif id="orderdel" name="orderdel" type="checkbox" value="1" /></td>
                        </tr>
                        <tr>
                            <th>Promo Code</th>
                            <td><input disabled @if($data->permission->general->promocodeadd) checked @endif id="promocodeadd" name="promocodeadd" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->promocodeedit) checked @endif id="promocodeview" name="promocodeview" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->promocodeview) checked @endif id="promocodeedit" name="promocodeedit" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->promocodedel) checked @endif id="promocodedel" name="promocodedel" type="checkbox" value="1" /></td>
                        </tr>
                        <tr>
                            <th>Discounts</th>
                            <td><input disabled @if($data->permission->general->discountsadd) checked @endif id="discountsadd" name="discountsadd" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->discountsedit) checked @endif id="discountsview" name="discountsview" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->discountsview) checked @endif id="discountsedit" name="discountsedit" type="checkbox" value="1" /></td>
                            <td><input disabled @if($data->permission->general->discountsdel) checked @endif id="discountsdel" name="discountsdel" type="checkbox" value="1" /></td>
                        </tr>
                        <tr>
                            <th>Review</th>
                            <td></td>
                            <td><input disabled @if($data->permission->general->reviewedit) checked @endif id="reviewview" name="reviewview" type="checkbox" value="1" /></td>
                            <td></td>
                            <td><input disabled @if($data->permission->general->reviewdel) checked @endif id="reviewdel" name="reviewdel" type="checkbox" value="1" /></td>
                        </tr>
                    </tbody>
                </table>
            </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
