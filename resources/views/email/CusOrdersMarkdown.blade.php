@component('mail::message')
 

<p>Hello,</p>

<p>You made an order.</p>

<a href="https://getfoods.ng/userdashboard">
    View Now
</a> 




Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
