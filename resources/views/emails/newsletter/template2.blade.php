@component('mail::message')
<table class="inner-body" align="center" style="width: 100% !important;" cellpadding="0" cellspacing="0" role="presentation">
    <tr style="width: 100%">
        <td class="content-cell" style="padding: 0 !important; width: 100% !important">
            <img loading="lazy" src="/storage/img/oilemail2.jpg" alt="" class="w-100" style="object-fit: cover">
        </td>
    </tr>
    <tr style="width: 100%">
        <td class="content-cell" style="padding: 20px 32px 10px 32px !important; width: 60%; border-top: 3px solid darkgreen">
            <span style="font-weight: bold; color: black;">
                Message Subject
            </span>
            <br><br>
            Lorem ipsum dolor sit amet consectetur adipisicing elit.
            <span style="color: green"> some important stuff </span>
            Distinctio voluptas maiores quia ad quae molestias natus debitis doloremque delectus
            <span style="font-weight: bold"> important stuff</span>
            cumque quam reiciendis enim necessitatibus fuga saepe cum alias dolore!
        </td>
    </tr>
</table>

<div style="font-size: 0.8em; padding: 0px 32px 32px 32px; margin-top: 2rem;">
    Click <a href="https://farm63.com/profile/orderss" style="margin: auto 0.35rem;color: green; font-weight: bold; font-size: 1.2em; text-decoration: underline rgba(0, 255, 0, 0.5)">HERE</a> to go somewhere there.
    <br><br>
    Disclaimer <br><span style="color: green; font-weight: bold">Don't</span> share your personal details with anyone.<br>
    Our customer service team will <span style="color: green; font-weight: bold">never</span> ask you for your password, OTP, credit card, or banking info.
</div>

<div style="font-size: 0.8em; padding: 0px 32px 32px 32px; margin-top: 2rem;">
    To unsubscribe this mail please click <a href="/unsubscribe/{{ $emailunsub }}"  style="margin: auto 0.35rem;color: green; font-weight: bold; font-size: 1.2em; text-decoration: underline rgba(0, 255, 0, 0.5)">here</a>
    <br>
</div>
@endcomponent
