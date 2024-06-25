@component('mail::message')
# New Job Application for 
{{-- {{ $post }} --}}

Name: {{ $response['full_name'] }}<br>
Contact: {{ $response['contact'] }}<br>
Email: {{ $response['email_address'] }}<br>
@component('mail::subcopy')
    See attached file for the Resume/CV.
@endcomponent
{{ config('app.name') }}    
@component('mail::button', ['url' => 'https:/careers.dbiphils.com/admin/responses'])
    View Details
@endcomponent    

@endcomponent