<x-app-layout title="Home Page">
    @section('hero')
        <div class="w-full py-44 text-center relative">
            <div class="absolute top-0 left-0 mb-2 aspect-video w-full object-cover overflow-hidden -z-20">
                <video autoplay loop muted plays-inline class="pointer-events-none">
                    <source src="https://dbiphils.com/AvpShort.webm" type="video/webm">
                </video>
            </div>
            <h1 class="font-bold text-3xl sm:text-5xl lg:text-6xl xl:text-8xl text-balance text-white [text-shadow:_0_5px_0_rgb(0_0_0_/_40%)]">
                Direct your future:
                <br>Join us & 
                <span x-data="{ texts: ['thrive!', 'succeed!','flourish!','grow!','prosper!'] }" x-typewriter.3000ms="texts"></span></h1>
            
            
            {{-- <p class="mt-1 text-lg text-gray-500">{{ __('This is a Subtitle') }}</p> --}}
            <a class="inline-block px-10 py-4 mt-5 text-xl text-white bg-blue-600 rounded-lg" href="{{ route('posts.index') }}">
                {{ __('Join Now') }}</a>
                {{-- <div class="mb-2 col-span-10">
                    <h1 class="font-bold text-3xl sm:text-5xl lg:text-6xl xl:text-8xl text-balance text-left animated-text">Direct your future: <br>Join Us & <span></span></h1>
                </div> --}}
            
        </div>
        <div class="w-full py-5 mx-auto bg-blue-900 bg-opacity-60 mt-10">
            
            <div class="w-1/2 flex justify-center mx-auto text-white">
                
                
                <div class="w-full flex flex-row justify-between ">
                <div class="col-span-3 !leading-3 md:col-span-2">
                    <hr>
                    <span class="text-xs lg:text-sm xl:text-base">Serving</span><br>
                    <span class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold">420</span><br>
                    <span class="text-xs lg:text-sm xl:text-base">Clients/Projects</span>
                </div>
                <div class="col-span-3 !leading-3 md:col-span-2">
                    <hr>
                    <span class="text-xs lg:text-sm xl:text-base">Proudly</span><br>
                    <span class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold inline-block">35<span class="text-xl">Years</span></span><br>
                    <span class="text-xs lg:text-sm xl:text-base">in Service</span>
                </div>
                <div class="col-span-4 !leading-3 md:col-span-2">
                    <hr>
                    <span class="text-xs lg:text-sm xl:text-base">Among the</span><br>
                    <span class="text-2xl sm:text-3xl lg:text-4xl xl:text-5xl font-semibold inline-block"><span class="text-2xl align-top">Top</span>100</span><br>
                    <span class="text-xs lg:text-sm xl:text-base italic text-pretty">*Employer for Fresh Graduates</span>
                </div>  
            </div>                       
                    
            </div>
        </div>
        
    @endsection
    
    

        <div class="mb-10 w-full">
            <div class="mb-16">
                <h2 class="mt-16 mb-5 text-2xl text-white font-bold">Featured Job Posts</h2>
                <div class="w-full">
                    <div class="grid grid-cols-2 gap-10">

                        @foreach($featuredPosts as $post)
                        <div class="md:col-span-1 col-span-3">
                            <x-posts.post-card :post="$post" />
                        </div>

                        @endforeach
                        
                    </div>
                </div>
                <a class="mt-10 block text-center text-lg text-blue-500 font-semibold"
                    href="http://192.168.0.9:5174/job">More
                    Posts</a>
            </div>
            <hr>

            
        </div>
    

</x-app-layout>