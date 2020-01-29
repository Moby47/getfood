@component('mail::message')
 
<a href="https://getfoods.ng/{{$userId}}">
    Click here to review your best food vendors
</a> 



Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
