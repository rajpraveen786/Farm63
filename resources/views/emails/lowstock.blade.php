@component('mail::message')
# Low Stock Report

Please, see the attached report for low stock report for the day : {{date('d M,Y')}}.

Thanks,<br>
{{ config('app.name') }}
@endcomponent
