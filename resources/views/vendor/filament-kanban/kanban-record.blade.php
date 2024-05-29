<div id="{{ $record->getKey() }}" wire:click="recordClicked('{{ $record->getKey() }}', {{ @json_encode($record) }})" class="record bg-white dark:bg-gray-700 rounded-lg px-4 py-2 cursor-grab font-medium text-gray-600 dark:text-gray-200" @if($record->timestamps && now()->diffInSeconds($record->{$record::UPDATED_AT}) < 3) x-data x-init="
            $el.classList.add('animate-pulse-twice', 'bg-primary-100', 'dark:bg-primary-800')
            $el.classList.remove('bg-white', 'dark:bg-gray-700')
            setTimeout(() => {
                $el.classList.remove('bg-primary-100', 'dark:bg-primary-800')
                $el.classList.add('bg-white', 'dark:bg-gray-700')
            }, 3000)
        " @endif>

        <div class="flex justify-between">
            <div>
            {{ $record->{static::$recordTitleAttribute} }}

@if ($record['urgent'])

<x-heroicon-s-star class="text-primary-500 w-4 h-4 inline-block" />

@endif
            </div>
            
            <div class="font-bold text-gray-400">
            

            </div>

            {{ $record['owner'] }}

            <div>
                {{ $record['description']}}
            </div>



        </div>

        <div class="flex -space-x-2">
            @foreach($record['team'] as $member)
<div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white"></div>
            @endforeach
        </div>

        <div class="mt-2 relative">
            <div
            class="absolute h-1 bg-gray-800 rounded-full" 
            style="width: {{ $record['progress'] }}">
            </div>
            <div class="h-1 bg-gray-200 rounded-full"></div>
        </div>
</div>