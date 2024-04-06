<nav class="flex items-center justify-between  w-5/6 mx-auto">
    <div id="nav-left" class="flex items-center">
        <div class="text-gray-800 font-semibold">
            <a href="{{ route("home") }}">
            <x-application-mark />
            </a>
        </div>
        
    </div>
    
    <div class="top-menu ml-10">
        
        <div class="flex space-x-5">
        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            {{ __('Home') }}
        </x-nav-link>
        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            {{ __('Projects') }}
        </x-nav-link>
        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            {{ __('Products') }}
        </x-nav-link>
        <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
            {{ __('Careers') }}
        </x-nav-link>
        <x-nav-link href="{{ route('home') }}" :active="request()->routeIs('home')">
            {{ __('About') }}
        </x-nav-link>
    </div>
    </div>
    <div id="nav-right" class="flex items-center md:space-x-6">
        @auth
        @include('layouts.partials.header-right-auth')
        @else        
        @include('layouts.partials.header-right-guest')
        @endauth
    </div>
    
</nav>