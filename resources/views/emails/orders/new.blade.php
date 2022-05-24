@component('mail::message')
<table class="inner-body" align="center" style="width: 100% !important;" cellpadding="0" cellspacing="0" role="presentation">
    <tr style="width: 100%">
        <td class="content-cell" style="padding: 0 !important; width: 100% !important">
            <img loading="lazy" src="{{ env('APP_URL') }}/storage/img/oilemail2.jpg" alt="" class="w-100" style="object-fit: cover">
        </td>
    </tr>
    <tr style="width: 100%">
        <td class="content-cell" style="padding: 20px 32px 10px 32px !important; width: 60%; border-top: 3px solid darkgreen">
            <span style="font-weight: bold; color: black;">
                New Order #{{ $data->invno }}
            </span>
            <br><br>
            The Mail is to inform you about your order (Date: {{ $data->created_at }} ).
        </td>
    </tr>
</table>

<div style="padding: 0 32px">
    @component('mail::table')
    | <span style="color: green"> Name</span> | <span style="color: green"> Qty</span> | <span style="color: green"> Cost</span> |
    | :------------- |-------------:| --------:|
    @for($i=0;$i<$data->ordersub->count();$i++)
        | {{ $data->ordersub[$i]->name }} | {{ $data->ordersub[$i]->qty }} | Rs. {{ $data->ordersub[$i]->subcost}} |
        @endfor
        | | Shipping | Rs. {{ $data->shipping}} |
        | | <span style="color: green; font-weight: bold"> Total</span> | <span style="font-weight: bold"> Rs. {{ $data->total}} </span> |
        @endcomponent
</div>

<div style="font-size: 0.8em; padding: 0px 32px 32px 32px">
    Click <a href="https://farm63.com/profile/orders" style="margin: auto 0.35rem;color: green; font-weight: bold; font-size: 1.2em; text-decoration: underline rgba(0, 255, 0, 0.5)">HERE</a> to view complete details. <br><br>
    <span style="color: green; font-weight: bold">Don't</span> share your personal details with anyone.<br>
    Our customer service team will <span style="color: green; font-weight: bold">never</span> ask you for your password, OTP, credit card, or banking info.
</div>
@endcomponent
