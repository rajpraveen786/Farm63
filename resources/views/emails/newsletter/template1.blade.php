@component('mail::message')

<table class="inner-body" align="center" style="width: 100% !important" cellpadding="0" cellspacing="0" role="presentation">
    <tr style="width: 100%">
        <td class="content-cell" style="padding: 0 !important; width: 40%">
            <img loading="lazy" src="{{ env('APP_URL').$img }}" alt="" class="w-100">
        </td>
        <td class="content-cell" style="padding: 32px !important; width: 60%; border-left: 3px solid darkgreen">
            {!! $content !!}
        </td>
    </tr>
</table>
<div style="font-size: 0.8em; padding: 0px 32px 32px 32px; margin-top: 2rem;">
    To unsubscribe this mail please click <a href="/unsubscribe/{{ $emailunsub }}"  style="margin: auto 0.35rem;color: green; font-weight: bold; font-size: 1.2em; text-decoration: underline rgba(0, 255, 0, 0.5)">here</a>
    <br>
</div>
@endcomponent
