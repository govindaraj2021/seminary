@component('mail::message') 
Name : {{ ucfirst($data['name']) }} <br>
{{ 'Testimonial' }} :<br> {{ $data['testimonial'] }}
@if(isset($data['photo'])) Photo : <a class="btn btn-sm btn-success" href="{{ asset('storage/app/public/testimonial/' .  $data['photo'] ) }}">Download<a><br>@endif

<br><br>Thanks,<br> 
{{ 'Hotel Crystal Suites' }} 
@endcomponent