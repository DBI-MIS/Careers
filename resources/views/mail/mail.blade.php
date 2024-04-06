@component('mail::message')
# New Job Application

Some details here...
    @component('mail::button', ['url' => 'link'])
    More details
    @endcomponent

    {{ $response->full_name }}
    {{ $name }}
    Thanks <br>
    Yeah
@endcomponent