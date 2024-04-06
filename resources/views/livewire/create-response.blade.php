
    <div class="px-5 py-5">
        {{-- <button x-data x-on:click="$dispatch('close-modal')">
            X
        </button> --}}

        <x-filament-actions::modals />
    <form wire:submit="create">
        
        <span>Job Application</span>
        @csrf
        
        {{ $this->form }}

        {{-- <form method="POST" action="{{ route('register') }}">
            @csrf

            <div>
                <x-label for="name" value="{{ __('Name') }}" />
                <x-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            </div>

            <div class="mt-4">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
            </div> --}}
        
        
        
        <x-button wire:click=""
        wire:confirm="Are you sure you want to submit this application?"
        type="submit" class="my-8 px-24">
            Submit
        </x-button>
        
    </form>

    
    
    </div>

