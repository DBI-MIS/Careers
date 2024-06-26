<div id="{{ $record->getKey() }}" wire:click="recordClicked('{{ $record->getKey() }}', {{ @json_encode($record) }})"
    class="record bg-white dark:bg-gray-700 rounded-lg px-4 py-2 cursor-grab font-medium text-gray-600 dark:text-gray-200 border-l-4 shadow-md border-blue-600"
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
            <x-heroicon-s-star class="top-0 text-red-600 w-4 h-4 inline-block" />
        @endif
            {{ $record->{static::$recordTitleAttribute} }}

          
        </div>
<div class="flex flex-row gap-x-2">
        <div class="w-8 h-8 rounded-full shadow shadow-gray-400 bg-gray-200 border-2 border-white pt-[2px] text-center items-center">
            <span class="text-sm">{{ strtoupper($record->user->name[0]) }}</span>
        </div>
        <div>
            <div class="font-light text-sm text-gray-400">
                {{ $record->user->name ?? 'No Owner' }}
            </div>
            <div class="font-light text-xs text-gray-400">
            Created {{ $record->created_at->diffForHumans() }}
            </div>
        </div>
    </div>
        

      



    </div>
    <div class=" text-xs font-light border-l-2 border-gray-200 pl-2 mb-2">
        {{-- {{ $record['description'] }} --}}
        {{ $record->getTrim() ?? 'No Description'}}
    </div>

    <div class="flex flex-row hover:space-x-1 -space-x-2 mb-2 ">
        @foreach ($record['team'] as $member)
            <div class="w-8 h-8 rounded-full shadow shadow-gray-400 bg-gray-200 border-2 border-white pt-[2px] text-center items-center transition-all ease-in-out group relative">
                <span class="text-sm ">{{ strtoupper($member->name[0]) }}</span>
                <span class="group-hover:opacity-100 transition-opacity bg-gray-400 p-2 text-sm text-gray-100 rounded-md absolute left-1/2 
            -translate-x-1/2 translate-y-1/3 opacity-0 m-4 mx-auto z-10 block w-[100px]">{{ $member->name }}</span>
            </div>
        @endforeach


    </div>
    <span class="text-xs font-light"> {{ $record->progress }}% Progress</span>
    <div class="h-3 w-full relative mb-2">
        <div class="h-1 bg-gray-200 rounded-full absolute w-full" ></div>
        <div class="h-1 absolute rounded-full bg-blue-600 " style="width: {{ $record->progress }}%"></div>
    </div>

    <div class="font-light text-xs text-gray-400">
        Updated {{ $record->updated_at->diffForHumans() }}

        </div>
</div>
