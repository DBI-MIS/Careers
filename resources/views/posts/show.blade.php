
<x-app-layout :title="$post->title">


        <article class="col-span-8 md:col-span-3 mt-10 mx-auto py-5 w-full" style="max-width:900px">
            <div class="flex flex-row justify-between">
            {{-- <img class="w-full my-2 rounded-lg" src="" alt=""> --}}
            <h1 class="text-4xl font-bold text-left text-gray-800">
                {{ $post->title }}
            </h1>
                <div class="flex items-center gap-2">
                    <livewire:like-button :key="$post->id" :$post />
                    <button>
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                            stroke-width="1.5" stroke="currentColor"
                            class="w-5 h-5 text-gray-500 hover:text-gray-800">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M6.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM12.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0zM18.75 12a.75.75 0 11-1.5 0 .75.75 0 011.5 0z" />
                        </svg>
                    </button>
                </div>
            </div>
            <div class="mt-2 flex justify-between items-center">
                <div class="flex py-5 text-base items-center">
                    {{-- <img class="w-10 h-10 rounded-full mr-3" src=""
                        alt="avatar"> --}}
                    <span class="mr-1">Posted By: {{ $post->author->name }}</span>
                </div>
                
                <div class="flex items-center">
                    <span class="text-gray-500 mr-2">{{ $post->date_posted->diffForHumans()}}</span>
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.3"
                        stroke="currentColor" class="w-5 h-5 text-gray-500">
                        <path stroke-linecap="round" stroke-linejoin="round"
                            d="M12 6v6h4.5m4.5 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                    </svg>
                </div>
            </div>
            <div class="gap-x-2">
                    <span class="mr-1 rounded-xl px-3 py-1 text-base bg-gray-200">{{ $post->job_level }}</span>
                    <span class="mr-1 rounded-xl px-3 py-1 text-base bg-gray-200">{{ $post->job_type }}</span>
                    <span class="mr-1 rounded-xl px-3 py-1 text-base bg-gray-200">{{ $post->job_location }}</span>
                </div>

            <div class="my-6 flex text-base items-center justify-between border-t border-b border-gray-100 py-4 px-2 text-balance">
                
                    {!! $post->post_description !!}

            </div>

            <div class="py-3 text-gray-800 text-lg">
                Responsibilities
                <div class="text-base items-center justify-between border-b border-gray-100 py-4 px-2">
                    
                    {!! $post->post_responsibility !!}
                    
                </div>
            </div>

            <div class="py-3 text-gray-800 text-lg">
                Qualifications
                <div class="text-base items-center justify-between border-b border-gray-100 py-4 px-2">
                    
                    {!! $post->post_qualification !!}
                    
                </div>
            </div>
    

            
            {{-- <button x-data x-on:click="$dispatch('open-modal')"
                    class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                    Apply Now!
                </button>
                <div 
                x-data = "{ show : false }"
                x-show = " show "
                x-on:open-modal.window = "show = true"
                x-on:close-modal.window = "show = false"
                x-on:keydown.escape.window = "show = false"

                class="fixed z-50">
                <div x-on:click="show = false" class="fixed inset-0 bg-gray-300 opacity-40"></div>
                    <div class="bg-gray-400 rounded m-auto fixed inset-0 max-w-2xl max-h-xl">
                        <livewire:create-response :post_id="$post->title" />
                    </div>
                </div> --}}

            
                {{-- <x-nav-link href="{{ route('application') }}">
                    {{ __('Apply Here') }}
                </x-nav-link> --}}
                
                <x-filament::modal width="2xl">
                    <x-slot name="trigger">
                        <x-filament::button class="mt-3 inline-flex items-center justify-center h-10 px-4 font-medium tracking-wide text-white transition duration-200 bg-blue-900 rounded-lg hover:bg-gray-800 focus:shadow-outline focus:outline-none">
                            Apply Now!
                        </x-filament::button>
                    </x-slot>
                    <livewire:create-response :post_title="$post->id" :date_response="Carbon\Carbon::now()->format('M-d-Y')"/>
                </x-filament::modal>

        </article>

    </x-app-layout>