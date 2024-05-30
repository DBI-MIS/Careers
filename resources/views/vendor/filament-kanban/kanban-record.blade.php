<div id="{{ $record->getKey() }}" wire:click="recordClicked('{{ $record->getKey() }}', {{ @json_encode($record) }})"
    class="record bg-white dark:bg-gray-700 rounded-lg px-4 py-2 cursor-grab font-medium text-gray-600 dark:text-gray-200"
    @if ($record->timestamps && now()->diffInSeconds($record->{$record::UPDATED_AT}) < 3) x-data x-init="
            $el.classList.add('animate-pulse-twice', 'bg-primary-100', 'dark:bg-primary-800')
            $el.classList.remove('bg-white', 'dark:bg-gray-700')
            setTimeout(() => {
                $el.classList.remove('bg-primary-100', 'dark:bg-primary-800')
                $el.classList.add('bg-white', 'dark:bg-gray-700')
            }, 3000)
        " @endif>

    <div class="flex flex-col justify-between mb-2">
        <div>
            @if ($record['urgent'])
            <x-heroicon-s-star class="top-0 text-primary-500 w-4 h-4 inline-block" />
        @endif
            {{ $record->{static::$recordTitleAttribute} }}

          
        </div>

        <div class="font-light text-sm text-gray-400">

            {{ $record->user->name ?? 'No Owner' }}


        </div>
        <div class="font-light text-xs text-gray-400">
        Created {{ $record->created_at->diffForHumans() }}

        </div>

      



    </div>
    <div class=" text-xs font-light mb-2">
        {{-- {{ $record['description'] }} --}}
        {{ $record->getTrim() ?? 'No Description'}}
    </div>

    <div class="flex -space-x-2 mb-2">
        @foreach ($record['team'] as $member)
            <div class="w-8 h-8 rounded-full bg-gray-200 border-2 border-white"></div>
        @endforeach
    </div>

    <div class="h-3 w-full relative mb-2">
        <div class="h-1 bg-gray-200 rounded-full absolute w-full" ></div>
        <div class="h-1 absolute rounded-full fi-color-primary !bg-blue-600" style="width: {{ $record->progress }}%"></div>
    </div>

    <div class="font-light text-xs text-gray-400">
        Updated {{ $record->updated_at->diffForHumans() }}

        </div>
</div>
