<x-app-layout title="Home Page">
    @section('hero')
    <!-- Hero -->
            
        <div class="w-full relative">
            <!-- Hero Video -->
            
            <div class="absolute left-0 top-0 overflow-hidden -z-20 bg-gradient-to-r from-gray-900 via-gray-900 brightness-50">
                <video autoplay loop muted class="pointer-events-none object-cover">
                    <source src="https://dbiphils.com/AvpShort.webm" type="video/webm">
                </video>
            </div>
            <div class="mx-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] xl:flex xl:justify-between xl:items-center">
                <div class="py-[clamp(52px,_-0.6195px_+_16.4436vi,_224px)]">
                <!-- Hero Title -->
                <h1 class="font-bold text-[clamp(26px,_4.5851px_+_6.6922vi,_96px)] leading-[clamp(12px,_-8.8031px_+_6.501vi,_80px)] text-balance text-white">
                Join Our Team
                <br>& 
                <span x-data="{ texts: ['Thrive!', 'Succeed!','Flourish!','Grow!','Prosper!'] }" 
                x-typewriter.3000ms="texts">
                </span>
                <p class="my-[clamp(8px,_-0.566px_+_2.6769vi,_36px)] text-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] leading-[clamp(12px,_4.0459px_+_2.4857vi,_38px)] font-thin text-white mb-2">{{ __('Drive your future forward') }}</p>
                </h1>
                <!-- Call to Action Button -->
                <a class="my-[clamp(2px,_-1.0593px_+_0.956vi,_12px)] inline-block px-[clamp(12px,_5.8815px_+_1.912vi,_32px)] py-[clamp(2px,_-1.0593px_+_0.956vi,_12px)] text-[clamp(14px,_10.9407px_+_0.956vi,_24px)] text-white bg-blue-600 rounded-lg animate-pulse animate-infinite animate-duration-[3000ms] animate-delay-[2000ms] animate-ease-in shadow-sm shadow-gray-950" 
                href="{{ route('posts.index') }}">
                {{ __('Join Now') }}</a>
                </div>
            
                
                <!-- Banner Container -->
                <div class="w-full xl:w-1/6 xl:py-[clamp(52px,_-0.6195px_+_16.4436vi,_224px)]">

                <!-- Banner Details -->
                    <div class="flex flex-row justify-between text-gray-800 xl:text-white xl:flex-col xl:items-end">
                        
                        <div class="leading-3 w-full xl:mb-5">
                            <hr class="hidden xl:block">
                            <span class="text-xs lg:text-sm xl:text-base">Serving</span><br>
                            <span class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold">140+</span><br>
                            <span class="text-xs lg:text-sm xl:text-base">Clients/Projects</span>
                        </div>
                        <div class="leading-3 w-full xl:mb-5">
                            <hr class="hidden xl:block">
                            <span class="text-xs lg:text-sm xl:text-base">Proudly</span><br>
                            <span class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold inline-block">35<span class="text-xl">Years</span></span><br>
                            <span class="text-xs lg:text-sm xl:text-base">in Service</span>
                        </div>
                        <div class="leading-3 w-full xl:mb-5">
                            <hr class="hidden xl:block">
                            <span class="text-xs lg:text-sm xl:text-base">Among the</span><br>
                            <span class="text-xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold inline-block"><span class="text-xl align-top">Top</span>100</span><br>
                            <span class="text-xs lg:text-sm xl:text-base italic text-pretty">*Employer for Fresh Graduates</span>
                        </div>  
                    </div>                       
                    
            
                </div>
            </div>

        </div>
    
        
    @endsection
    
    

        <div class="mb-10 mt-2 sm:mt-4 md:mt-8 xl:mt-0 w-full">
            <div class="mb-16">
                <hr>
                <h2 class="my-2 sm:my-4 md:my-6 text-base md:text-lg xl:text-2xl text-gray-800 font-bold 2xl:text-white" animate-shake animate-infinite animate-ease-in>
                    Featured Job Posts</h2>
                <div class="w-full">
                    <div class="grid grid-cols-2 gap-2">

                        @foreach($featuredPosts as $post)
                        <div class="md:col-span-1 col-span-3">
                            <x-posts.post-card :post="$post" />
                        </div>

                        @endforeach
                        
                    </div>
                </div>
                <a class="mt-10 block text-center text-sm text-blue-500 font-semibold"
                    href="{{ route('posts.index') }}">More
                    Posts</a>
            </div>
            <hr>

            
        </div>
    

</x-app-layout>