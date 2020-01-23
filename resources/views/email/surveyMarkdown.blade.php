@component('mail::message')
 
<a href="http://localhost:8000/my-survey/{{$userId}}">
    Click here to review your best food vendors
</a> 



Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
