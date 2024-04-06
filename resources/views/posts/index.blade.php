<x-app-layout title="Jobs">
    <div class="grid grid-cols-5 gap-10">
        <div class="md:col-span-4 col-span-5">
            <livewire:post-list />
        </div>
        <div id="side-bar"
            class="border-t border-t-gray-100 md:border-t-none col-span-4 md:col-span-1 px-3 md:px-6  space-y-10 py-6 pt-10 md:border-l border-gray-100 h-screen sticky top-0">

                 <livewire:search-box />
                {{--<livewire:categories-box />             --}}
                {{-- @include('posts.partials.search-box') --}}
                @include('posts.partials.categories-box')
        </div>
    </div>

</x-app-layout>