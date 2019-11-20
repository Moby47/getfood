@component('mail::message')
 


Write a welcome note here!

@component('mail::button', ['url' => "localhost:8000/verify/{{$verifytoken}}"])
Verify Account
@endcomponent

@component('mail::button', ['url' => "localhost:8000"])
Get Food
@endcomponent


Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
