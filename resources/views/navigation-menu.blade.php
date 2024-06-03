<nav 
x-data="{ mobileMenuIsOpen: false }" @click.away="mobileMenuIsOpen = false" 
class="flex items-center mx-auto border-gray-200"
aria-label="DB Careers Nav">
    
<div class="w-full flex flex-wrap items-center justify-between mx-auto">
    <div id="nav-left" class="flex items-center space-x-3 rtl:space-x-reverse">
        <div class="text-slate-700 font-semibold">
            <a href="{{ route("home") }}">
            <x-application-mark />
            </a>
        </div>
        
    </div>
    <!-- Desktop Menu -->
        <div class="hidden gap-4 md:flex">
        <x-nav-link href="https://dbiphils.com">
            {{ __('Home') }}
        </x-nav-link>
        <x-nav-link href="https://projects.dbiphils.com">
            {{ __('Projects') }}
        </x-nav-link>
        <x-nav-link href="https://products.dbiphils.com">
            {{ __('Products') }}
        </x-nav-link>
        <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
            {{ __('Careers') }}
        </x-nav-link>
        <x-nav-link href="https://about.dbiphils.com">
            {{ __('About') }}
        </x-nav-link>
        </div>
    
        <!-- Mobile Menu Button -->

        <button 
        @click="mobileMenuIsOpen = !mobileMenuIsOpen" 
        :aria-expanded="mobileMenuIsOpen" 
        :class="mobileMenuIsOpen ? 'fixed top-6 right-6 z-20' : null" 
        type="button" 
        class="flex text-slate-700 md:hidden" 
        aria-label="mobile menu" 
        aria-controls="mobileMenu">
            <svg x-cloak 
            x-show="!mobileMenuIsOpen" 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            aria-hidden="true" 
            viewBox="0 0 24 24" 
            stroke-width="2" 
            stroke="currentColor" 
            class="size-6">
                <path 
                stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M3.75 6.75h16.5M3.75 12h16.5m-16.5 5.25h16.5" />
            </svg>
            <svg x-cloak 
            x-show="mobileMenuIsOpen" 
            xmlns="http://www.w3.org/2000/svg" 
            fill="none" 
            aria-hidden="true" 
            viewBox="0 0 24 24" 
            stroke-width="2" 
            stroke="currentColor" 
            class="size-6">
                <path stroke-linecap="round" 
                stroke-linejoin="round" 
                d="M6 18 18 6M6 6l12 12" />
            </svg>
        </button>
    
    <!-- Mobile Menu -->
    <div 
    {{-- class="top-menu hidden w-full md:block md:w-auto" --}}
    x-cloak x-show="mobileMenuIsOpen" 
    x-transition:enter="transition motion-reduce:transition-none ease-out duration-300"
    x-transition:enter-start="-translate-y-full"
    x-transition:enter-end="translate-y-0"
    x-transition:leave="transition motion-reduce:transition-none ease-out duration-300"
    x-transition:leave-start="translate-y-0"
    x-transition:leave-end="-translate-y-full"
    id="mobileMenu" 
    class="fixed max-h-svh overflow-y-auto inset-x-0 top-0 z-10 flex flex-col divide-y divide-slate-300 gap-y-3 border-b border-slate-300 bg-slate-100 px-6 pb-6 pt-10 md:hidden">
        <x-nav-link href="https://dbiphils.com">
            {{ __('Home') }}
        </x-nav-link>
        <x-nav-link href="https://projects.dbiphils.com">
            {{ __('Projects') }}
        </x-nav-link>
        <x-nav-link href="https://products.dbiphils.com">
            {{ __('Products') }}
        </x-nav-link>
        <x-nav-link href="{{ route('posts.index') }}" :active="request()->routeIs('posts.index')">
            {{ __('Careers') }}
        </x-nav-link>
        <x-nav-link href="https://about.dbiphils.com">
            {{ __('About') }}
        </x-nav-link>
        
    </div>

    {{-- <div id="nav-right" class="flex items-center md:space-x-6">
        @auth
        @include('layouts.partials.header-right-auth')
        @else        
        @include('layouts.partials.header-right-guest')
        @endauth
    </div>
     --}}
     
        
        
    
      </div>
</nav>




    

  