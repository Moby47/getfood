@component('mail::message')
 




<ul class="">
                <li>Provide a reservation/ordering system for customers</li>
                <li>Provide cost analysis / history on food expenditures for customers</li>
                <li>Ease service process for both customers and food vendors</li>
                <li>Provide an accurate record keeping for insights on best dishes, quantity and total income for food vendors</li>
                <li>And more...</li>
     </ul>





     

     <a href="https://getfoods.ng/verify/{{$verifytoken}}">
    Account Noy Verified? Click Here
</a> 


<a href="https://getfoods.ng/user-signin">
   Vendor? Click Here
</a> 

<a href="https://getfoods.ng/">
    Customer? Click Here
</a> 






Thanks,<br>
{{ config('app.name') }} Team.
@endcomponent
