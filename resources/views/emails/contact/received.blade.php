@component('mail::message') 
Name : {{ ucfirst($data['name']) }} <br>
@if(isset($data['email']) && !empty($data['email'])) 
Email Id : {{ $data['email'] }} <br>@else  Email :  Not Provided <br> @endif
Phone : {{ $data['phone'] }}<br>
{{ 'Message' }} :<br> {{ $data['message'] }}
<br><br>Thanks,<br> 
{{ 'Hotel Crystal Suites' }} 
@endcomponent