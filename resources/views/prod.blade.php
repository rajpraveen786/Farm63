@extends('layouts.app3')
@section('content')

<!-- content area start -->
<section class="section1-t-padding">
    <div class="container">
        <div class="left-right-column">
            <div class="left-column">
        @if($productrelatedtoitem->count()>0)
        <div class="special-product section1-t-padding">
            <div class="left-section-title">
                <h4>Realted <span>Products</span></h4>
            </div>
            <a href="#special-pro" data-bs-toggle="collapse" class="responsive-collapse">Special <span> products</span><i class="fa fa-angle-down"></i></a>
            <div class="special-pro swiper-container collapse" id="special-pro">
                <div class="swiper-wrapper">
                    @for($i=0;$i<$productrelatedtoitem->count();$i++)
                        <swipertabproduct :data="{{ json_encode($productrelatedtoitem[$i]) }}"></swipertabproduct>
                        @endfor
                </div>
            </div>
        </div>
        @endif
        <!-- trending products left start -->
        <div class="tred-product section1-tb-padding">
            <div class="left-section-title">
                <h4>New <span>Products</span></h4>
            </div>
            <a href="#tred-products" data-bs-toggle="collapse" class="responsive-collapse">New <span>products</span> <i class="fa fa-angle-down"></i></a>
            <div class="trening-left-pro swiper-container collapse" id="tred-products">
                <div class="swiper-wrapper">
                    @for($i=0;$i<$newproducts->count();$i++)
                    <swipertabproduct :data="{{ json_encode($newproducts[$i]) }}"></swipertabproduct>
                    @endfor
                </div>
            </div>
        </div>

    </div>
    <div class="right-column">
        <section class="pro-page">
            <div class="row pro-image">
                <div class="col-xl-5 col-lg-6 col-md-6 col-12 larg-image">
                    <pagesimage :image="{{ json_encode($data->images) }}"></pagesimage>
                </div>
                <div class="col-xl-7 col-lg-6 col-md-6 col-12 pro-info">
                    <h4>{{ $data->name }}
                    </h4>
                    @if($data->stock>0 || ($data->trackqty && $data->oosc))
                    <div class="pro-availabale">
                        <span class="available">Availability:</span>
                        <span class="pro-instock">In stock</span>
                    </div>
                    @endif
                    <div class="pro-availabale">
                        <span class="available">Category:</span>
                        <span class="pro-instock">
                            <a class="pro-instock" href="/category/{{ $data->category->name }}">{{ $data->category->name }}</a>
                            > {{ $data->subcategory->name }}</span>
                    </div>
                    <div class="pro-availabale">
                        <span class="available">Brand:</span>
                        <span class="pro-instock">{{ $data->brand->name }}</span>
                    </div>
                    <div class="pro-price">
                        <span class="new-price"><i class="fas fa-fw fa-rupee-sign"></i> {{ $data->fpricewtas }} </span>
                        @if($data->disp)
                        <span class="old-price"><del> <i class="fas fa-fw fa-rupee-sign"></i> {{ $data->fpricebefdis }} </del></span>
                        @endif
                    </div>
                    <pagesproducts :dataid="{{ json_encode($data->id) }}" :enableqty="1" :enablestock="{{ ($data->stock>0 || ($data->trackqty && $data->oosc))?1:0 }}" ></pagesproducts>
                    <div class="share">
                        <span class="share-lable">Share:</span>
                        <ul class="share-icn">
                            <li><a href="javascript:void(0)"><i class="fa fa-facebook"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-twitter"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-instagram"></i></a></li>
                            <li><a href="javascript:void(0)"><i class="fa fa-pinterest"></i></a></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
        <!-- product info end -->

        @if($data->desc)
        <section class="pro-page-content mt-2">
            <h5>Description</h5>
            <descview :content="{{ json_encode($data->desc) }}"></descview>
        </section>
        @endif

        @php
        $attribute=json_decode($data->attribute);
        @endphp
        @if(count($attribute)>0)
        <section class="pro-page-content mt-4">
            <h5>Technical Details</h5>
            <table class="table table-striped table-responsive-sm ">
                <tbody>

                    @foreach ($attribute as $item)
                    <tr>
                        <th>{{ $item->key }}</th>
                        <th>
                            <descview :content="{{ json_encode($item->value) }}"></descview>
                        </th>
                    </tr>
                    @endforeach

                </tbody>
            </table>
        </section>
        @endif


        @if($customeralsobought->count()>0)
        <!-- releted product start -->
        <section class="section1-t-padding pro-releted">
            <div class="section-title3">
                <h2><span>Product Bought Togheter </span></h2>
            </div>
            <div class="releted-products owl-carousel owl-theme">
                @for($i=0;$i<$customeralsobought->count();$i++)
                    <owlcarouselprod :data="{{ json_encode($customeralsobought[$i]) }}" :newdata="{{ (date('Y-m-d',strtotime('-5days')) <= date('Y-m-d',strtotime($customeralsobought[$i]->created_at))?1:0)}}"></owlcarouselprod>
                    @endfor
            </div>
        </section>
        @endif
        <!-- releted product end -->
    </div>
    </div>
    </div>
</section>

@endsection
