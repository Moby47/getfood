@component('mail::message')
 

<p>Hello,</p>

<p>You have a new order.</p>

<a href="http://localhost:8000/orders">
    View Now
</a> 




Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
