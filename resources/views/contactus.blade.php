@extends('layouts.app')



@section('content')
<div class="container-fluid">
    <div class="row justify-content-center">
        <div class="col-12 p-0">
            <div class="mapouter"><div class="gmap_canvas"><iframe class="gmap_iframe" width="100%" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d15546.778982815355!2d80.246311!3d13.055092!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x2df099025eb7dfd9!2sTrinity%20House!5e0!3m2!1sen!2sin!4v1653363329792!5m2!1sen!2sin"></iframe></div><style>.mapouter{position:relative;text-align:right;width:100%;height:2048px;}.gmap_canvas {overflow:hidden;background:none!important;width:100%;height:2048px;}.gmap_iframe {height:2048px!important;}</style></div>
        </div>
        <div class="col-12 p-0">
            <hr>
            <h4 class="font-prim font-weight-bold text-center">Contact Us</h4>
            <hr>
            <div class="row m-lg-5">
                <div class="col-md-6">
                    <div class="card p-lg-5 p-3">
                        <h5 class="font-weight-bold font-prim"> Drop Us A Message </h5>
                        <contactus></contactus>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="card p-lg-5 p-3">
                        <h5 class="font-weight-bold font-prim"> Get In Touch </h5>
                        <ul class="navbar-nav">
                            <li class="nav-item row">
                                <div class="col-1">
                                    <i style="font-size: 1.2em; color: var(--prim)" class="fas fa-street-view mr-3 mt-3"></i>
                                </div>
                                <div class="col-10">
                                    Farm63</br>
                                    Trinity House, 2nd Floor, No 18,<br>
                                    4th Street Tirumurthi Nagar,<br>
                                    Nungambakam <br>
                                    Chennai - 600 0034.</br>
                                    Tamil Nadu <br>

                                </div>
                            </li>
                            <li class="nav-item">
                                <i style="font-size: 1.2em; color: var(--prim)" class="fas fa-phone mr-3 mt-3"></i>
                                <a class="text-dark" href="tel:+91 98821 98821"></i>+91 98821 98821</a>
                            </li>

                            <li class="nav-item">
                                <i style="font-size: 1.2em; color: var(--prim)" class="fas fa-at mr-3 mt-3"></i>
                                <a class="text-dark" href="mailto:cc@farm63.com"></i>cc@farm63.com</a>

                            </li>


                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
