@component('mail::message')
#  Your {{ config('app.name') }} account password changed


The password for your {{ config('app.name') }} account changed recently.
<br>
<br>
If you did not initiate this action, please visit contact the support team.
<br>
<br>
Thanks,<br>
{{ config('app.name') }}
@endcomponent
