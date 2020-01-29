@component('mail::message')
 
<a href="https://getfoods.ng/verify/{{$verifytoken}}">
    Click Here To Verify Your GetFoods Account
</a> 



Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
