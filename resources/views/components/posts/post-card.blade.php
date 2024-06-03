@props(['post'])
<div class="w-full rounded-md shadow-lg py-5 px-5 mb-5 bg-white hover:bg-gray-100 border-t-2 border-blue-800">
    <div class="grid grid-cols-4 gap-1 text-balance">
        <div class="col-span-4 w-full flex flex-row justify-between">
		<h1 class="font-bold text-2xl">
            <a wire:navigate href="{{ route('posts.show', $post->slug) }}">{{ $post->title}}</a>
        </h1><span class="text-gray-500 text-sm text-nowrap">{{ $post->date_posted->diffForHumans()}}</span>
        </div>
        <div class="text-sm  line-clamp-2 col-span-4">{{ $post->post_description }}</div>
        
        <div class="mt-3">
        <div class="flex items-center mb-2">
            <div class="topics flex flex-wrap justify-start gap-2">
                @if ($category = $post->categories()->first())
                <x-badge wire:navigate href="{{ route('posts.index', ['category' => $category->slug])}}"
                :textColor="$category->text_color" :bgColor="$category->bg_color">
                
                {{ $category->title }}
                
                </x-badge>
                @endif
            
            </div>
            
        </div>
        </div>
    </div>

</div>