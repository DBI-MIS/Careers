<footer class=" px-4 py-4 text-sm border-t border-gray-100">
    <div class="mx-auto w-5/6 flex flex-wrap items-center justify-between ">
    {{-- <div class="flex space-x-4">
        @foreach (config('app.supported_locales') as $locale => $data)
            <a href="{{ route('locale', $locale) }}">
                <x-dynamic-component :component="'flag-country-' . $data['icon']" class="w-6 h-6" />
            </a>
        @endforeach
    </div> --}}
    <div class="flex space-x-4">
        <span class="text-sm">&copy;2024, D.B. International Sales & Services, Inc. All Rights Reserved. 
            <br>Built by <a href="https://instragram.com/_exeill" rel="external">_exeill</a></span>
    </div>
    <div class="flex space-x-4">
        <a class="text-gray-500 hover:text-blue-500" href="{{ route('home') }}" :active="request()->routeIs('home')">{{ __('Careers') }} </a>
        <a class="text-gray-500 hover:text-blue-500" href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">{{ __('Find Job') }} </a>
        <a class="text-gray-500 hover:text-blue-500" href="">{{ __('Login') }} </a>
    </div>
    </div>
</footer>