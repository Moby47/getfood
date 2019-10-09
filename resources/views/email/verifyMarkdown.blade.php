@component('mail::message')
 
<a href="http://test.henrymoby.tech/verify/{{$verifytoken}}">
    Click Here To Verify Your GetFoods Account
</a> 



Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
