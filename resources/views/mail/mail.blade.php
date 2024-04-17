
@component('mail::message')
# New Job Application

{{-- <p>Job Application for { $post_title }</p>
<p>Date: { $date_response }</p>
<p>Name: { $full_name }</p>
<p>Contact: { $contact }</p>
<p>Email: { $email_address }</p>

    @component('mail::button', ['url' => $attachment])
    More details
    @endcomponent --}}

<p>Job Application for  {{ $response['post_title'] }}</p>
<p>Date: {{ $response['date_response'] }}</p>
<p>Name: {{ $response['full_name'] }}</p>
<p>Contact: {{ $response['contact'] }}</p>
<p>Email: {{ $response['email_address'] }}</p>
<p>Email: {{ $response['attachment'] }}</p>

    @component('mail::button', ['url' => {{ $response['attachment'] }}])
    More Details
    @endcomponent
    
@endcomponent