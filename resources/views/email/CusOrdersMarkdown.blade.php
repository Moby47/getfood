@component('mail::message')
 

<p>Hello,</p>

<p>You made an order.</p>

<a href="http://localhost:8000/userdashboard">
    View Now
</a> 




Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
