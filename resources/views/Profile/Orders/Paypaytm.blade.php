@extends('layouts.app')

@section('scripts')
@if(request()->get('payment')!='false')
<script type="application/javascript" src="https://securegw-stage.paytm.in/merchantpgpui/checkoutjs/merchants/{{ env('PAYTM_MERCHANT_ID') }}.js" crossorigin="anonymous"></script>

<script type="text/javascript">
function onScriptLoads(){
      var config = {
        "root": "",
        "flow": "DEFAULT",
        "data": {
        "orderId": "{{  }}", /* update order id */
        "token": "", /* update token value */
        "tokenType": "TXN_TOKEN",
        "amount": "" /* update amount */
        },
        "handler": {
          "notifyMerchant": function(eventName,data){
            console.log("notifyMerchant handler function called");
            console.log("eventName => ",eventName);
            console.log("data => ",data);
          }
        }
      };

      if(window.Paytm && window.Paytm.CheckoutJS){
          window.Paytm.CheckoutJS.onLoad(function excecuteAfterCompleteLoad() {
              window.Paytm.CheckoutJS.init(config).then(function onSuccess() {
                  window.Paytm.CheckoutJS.invoke();
              }).catch(function onError(error){
                  console.log("error => ",error);
              });
          });
      }
  }
  this.onScriptLoads()

</script>
@endif
@endsection

@section('content')

<div class="container-fluid">
    <ol class="breadcrumb" style="background-color: transparent">
        <li class="breadcrumb-item"><a class='text-dark' href="/profile">Profile </a></li>
        <li class="breadcrumb-item"><a class='text-dark' href="/profile/orders">Orders </a></li>
        <li class="breadcrumb-item active" aria-current="page" style="color: #2e5090; font-weight: bold; text-transform: uppercase; font-family:Arial, Helvetica, sans-serif">
            Order Summary</li>
    </ol>
    <div class="container text-left">
        <h3 class="py-2">Order Details</h3>
        @if(request()->get('payment')=='false')

        <div class="alert alert-danger texr-center">
            You have canceled the Payment order <br>
            <a href="/profile/orders/pay/{{ encrypt($data->id) }}" class="" style="text-decoration:underline">Click here to try again</a>

        </div>
        @endif
        @if($data->paystatus==1)

        <a class="h5 float-right text-danger" href="/profile/orders/invoice/{{ encrypt($data->id) }}">Invoice</a>
        @endif
        <ul class="nav">
            <li class="nav-item">
                <span class="nav-link border-right">Ordered on {{ date('d-m-Y',strtotime($data->created_at)) }}</span>
            </li>
            <li class="nav-item">
                <span class="nav-link">Order# {{ $data->invno }}</span>
            </li>
        </ul>
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-sm-12 mt-2 col-md-4">
                        <h5 style="font-weight:900">Shipping Address</h5> <br>
                        @php
                        $address=json_decode($data->address);
                        @endphp
                        {{ $address->name }} <br>
                        {{ $address->phno }} <br>
                        {{ $address->houseno }} <br>
                        {{ $address->area }}, {{ $address->landmark }} <br>
                        {{ $address->city }}, {{ $address->state }} <br>
                        {{ $address->country }}, {{ $address->pincode }} <br>
                    </div>
                    <div class="col-sm-12 mt-2 col-md-3">
                        <h5 style="font-weight:900">Status</h5> <br>
                        <span class="mt-2" style="font-weight:900"> Payment Method : </span>
                        @if($data->paytype==0)
                        Online Payment
                        @elseif($data->paytype==1)
                        Cash On Delivery
                        @endif <br><br>
                        <span class="mt-2" style="font-weight:900"> Payment Status : </span>
                        @if($data->paystatus==0)
                        Pending
                        @elseif($data->paystatus==1)
                        Paid
                        @elseif($data->paystatus==2)
                        Error
                        @elseif($data->paystatus==3)
                        Returned
                        @endif <br><br>
                        <span class="mt-2" style="font-weight:900"> Order Status : </span>
                        @if($data->status==0)
                        Pending
                        @elseif($data->status==1)
                        Approved
                        @elseif($data->status==2)
                        Out for Delivery
                        @elseif($data->status==3)
                        Delivered
                        @elseif($data->status==4)
                        Returned
                        @elseif($data->status==5)
                        Not Attended
                        @elseif($data->status==6)
                        Canceled
                        @endif

                    </div>
                    <div class="col-sm-12 mt-2 col-md-4">
                        <h5 style="font-weight:900">Order Summary</h5> <br>
                        <table class="table">
                            <tbody>
                                <tr>
                                    <td>Items(s) Subtotal</td>
                                    <td><i class="fas fa-rupee-sign"></i> {{$data->subtotal}}</td>
                                </tr>
                                <tr>
                                    <td>Shipping: </td>
                                    <td><i class="fas fa-rupee-sign"></i> {{$data->shipping}}</td>
                                </tr>
                                @if($data->promocodeval)
                                <tr>
                                    <td>Promo Code Applied</td>
                                    <td>- <i class="fas fa-rupee-sign"></i> {{$data->promocodeval}}</td>
                                </tr>
                                @endif
                                <tr>
                                    <td>Total</td>
                                    <td><i class="fas fa-rupee-sign"></i> {{$data->total}}</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="row mt-2">
                    @for($i=0;$i<$data->ordersub->count();$i++)
                        <div class="col-sm-12 col-md-3 text-center p-2">
                            <div class='border p-1'>
                                <img loading="lazy" src="/{{ $data->ordersub[$i]->image->loc ??'' }}" class="w-100" alt="">
                                <h5 class='mt-2' style="font-weight:900">{{ $data->ordersub[$i]->name }}</h5>
                                <h6><i class="fas fa-rupee-sign    "></i> {{ $data->ordersub[$i]->subcost }}</h6>
                                <h6 class="mt-2" style="font-weight:900">QTY : {{ $data->ordersub[$i]->qty }}</h6>
                            </div>
                        </div>
                        @endfor
                </div>
            </div>
        </div>
    </div>
</div>
@if(request()->get('payment')!='false')

<form name='razorpayform' action="/pay/{{ encrypt($data->id) }}/verify" method="POST">
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <input type="hidden" name="razorpay_payment_id" id="razorpay_payment_id">
    <input type="hidden" name="razorpay_signature" id="razorpay_signature">
    <input type="hidden" name="razorpay_order_id" id="razorpay_order_id" value="">
</form>
@endif
@endsection
