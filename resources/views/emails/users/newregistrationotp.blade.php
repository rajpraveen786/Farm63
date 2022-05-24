@component('mail::message')
<table class="inner-body" align="center" style="width: 100% !important" cellpadding="0" cellspacing="0" role="presentation">
    <tr style="width: 100%">
        <td class="content-cell" style="padding: 0 !important; width: 40%">
            <img loading="lazy" src="{{ env('APP_URL') }}/storage/img/oilemail2.jpg" alt="" class="w-100">
        </td>
        <td class="content-cell" style="padding: 32px !important; width: 60%; border-left: 3px solid darkgreen">
            <span style="font-weight: bold; color: black;">
                OTP verification
            </span>
            <br><br>
            Excited to have you join us at {{ config('app.name') }}!
            <br>
            Your One Time Password (OTP) : <br> <br>
            <span style="font-weight: bold; user-select: all; color: darkgreen; font-size: 1.3em; letter-spacing: 1.75rem; font-family: serif"> {{ $otp }} </span>
            <br><br>
            OTP will be available only for <span style="font-weight: bold">15</span> minutes.
            <br><br>
            <div style="font-size: 0.8em">
                <span style="color: green; font-weight: bold">Don't</span> share this OTP with anyone.<br>
                Our customer service team will <span style="color: green; font-weight: bold">never</span> ask you for your password, OTP, greenit card, or banking info.
            </div>
        </td>
    </tr>
</table>
@endcomponent
