@props(['post', 'response'])
<x-app-layout :title="$post->title">

<livewire:create-response  :post_title="$post->title" :date_response="Carbon\Carbon::now()->format('M-d-Y')" />

</x-app-layout>