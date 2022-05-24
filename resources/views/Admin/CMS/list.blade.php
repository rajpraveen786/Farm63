@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                CMS</li>
        </ol>
    </nav>
    <div class="row">
        <div class="col-12 mt-3">
            <div class="card shadow-custom pt-3" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim font-weight-bold pb-2">List View</h4>
                    <table class="table table-list table-responsive-sm">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">
                                <th style="width:20%">Name</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                                <tr>
                                    <td>Footer</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/footer" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Terms and Condition</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/tandc" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Shipping Policy</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/shipping" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Refund Policy</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/refund" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Privacy Policy</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/privacy" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>About Us</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/aboutus" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>FAQ</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/faq" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                <tr>
                                    <td>Return Policy</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/cms/return" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                        </tbody>
                    </table>
                </div>
                <hr>
            </div>
        </div>
    </div>
</div>
@endsection
