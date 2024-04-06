@props(['post'])
<article class="[&:not(:last-child)]:border-b border-gray-100 pb-10">
    <div class="article-body grid grid-cols-8 gap-3 mt-5 items-start">
        <div class="col-span-8">
            <div class="article-meta flex py-1 text-sm items-center justify-end">
                <span class="mr-1 text-xs">Posted By: {{ $post->author->name }}</span>
                <span class="text-gray-500 text-xs">{{ $post->date_posted->diffForHumans()}}</span>
            </div>
            <h2 class="text-xl font-bold text-gray-900">
                <a wire:navigate href="{{ route('posts.show', $post->slug) }}" >
                    {{ $post->title }}
                </a>
            </h2>

            <p class="mt-2 text-base text-gray-700 font-light">
                {{ $post->getExcerpt()}}
            </p>
            <div class=" flex flex-row justify-between items-center mt-6">
            <div class="article-actions-bar  flex items-center justify-start gap-2">
                @foreach ($post->categories as $category)
                    <x-badge wire:navigate href="{{ route('posts.index', ['category' => $category->title]) }}" 
                    :textColor="$category->text_color" bgColor="$category->bg_color"> 
                    {{ $category->title }}
                    </x-badge>
                @endforeach
                
            </div>
            <div>
                <livewire:like-button :key="$post->id" :$post />
            </div>
        </div>
        </div>
    </div>
</article>