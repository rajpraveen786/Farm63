@extends('layouts.admin')
@section('content')
<div class="container mt-3">
    <nav aria-label="breadcrumb">


        <ol class="breadcrumb" style="background-color: transparent">
            <li class="breadcrumb-item"><a href="/admin"><i class="fa-lg fas fa-home"></i> </a></li>
            <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
                SEO</li>
        </ol>
    </nav>

        <div class="col-12 mt-3">
            <div class="card shadow-custom pt-3" style="border-radius: 8px">
                <div class="card-body">
                    <h4 class="color-prim font-weight-bold pb-2">List View</h4>
                    @if($data->count()>0)
                    <table class="table table-list table-responsive-sm">
                        <thead>
                            <tr style="text-transform: uppercase; font-family: var(--primaryfont) ">

                                <th>Page</th>
                                <th>Title</th>
                                <th>Description</th>
                                <th style="width:10%" class="text-center">Action</th>
                            </tr>
                        </thead>

                        <tbody>
                            @for($i=0;$i<$data->count();$i++)
                                <tr>
                                    <td>{{ $data[$i]->page }}</td>
                                    <td>{{ $data[$i]->title }}</td>
                                    <td>{{ $data[$i]->desc }}</td>
                                    <td class="text-center d-flex flex-row justify-content-around">
                                        <a href="/admin/seo/{{ $data[$i]->page }}" class="btn">
                                            <i class="fa fa-edit" style="color: rgba(0, 0, 0, 0.6)" aria-hidden="true"></i>
                                        </a>
                                    </td>
                                </tr>
                                @endfor
                        </tbody>
                    </table>
                    @else
                    <div class="container text-center">
                        <img loading="lazy" src="/storage/sorry.svg" alt="" class="w-25">
                        <h5>Sorry No data Found</h5>
                    </div>
                    @endif
                </div>
                <hr>

                <div class="d-flex mt-2 justify-content-center">
                    {{ $data->appends(['name' => request()->get('name') ?? ''])->render("pagination::bootstrap-4") }}
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
