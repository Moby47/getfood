@component('mail::message')
 
<a href="https://testing.henrymoby.tech/my-survey/{{$userId}}">
    Click here to review your best food vendors
</a> 



Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
