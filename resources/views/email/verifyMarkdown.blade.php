@component('mail::message')
 
<a href="http://localhost:8000/verify/{{$verifytoken}}">
    Click Here To Verify Your GetFoods Account
</a> 



Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
