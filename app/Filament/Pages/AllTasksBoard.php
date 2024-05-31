<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Filament\Resources\TaskResource;
use App\Models\Task;
use App\Models\User;
use Carbon\Carbon;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use SearchableTrait;

class AllTasksBoard extends KanbanBoard
{
    
    

protected static string $view = 'alltasks-kanban.kanban-board';
 
protected static string $headerView = 'alltasks-kanban.kanban-header';
 
protected static string $recordView = 'alltasks-kanban.kanban-record';
 
protected static string $statusView = 'alltasks-kanban.kanban-status';

public static function shouldRegisterNavigation(): bool
{
    $user = Auth::user(); 

    if ($user && $user->isAdmin()) {
        return true;
    }

    return false;
}


protected static ?string $navigationIcon = 'heroicon-s-squares-2x2';
protected ?string $subheading = 'All Tasks Resets Daily';

    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected static ?string $navigationGroup = 'Board';
    protected static ?string $title = 'All Tasks';


    protected function records(): Collection
    {
    
        return Task::ordered()->get();

    //     $oneWeekAgo = Carbon::now()->subWeek();

    // return Task::ordered()
    //            ->where('progress', '<', 100)
    //            ->where('due_date', '>', $oneWeekAgo)
    //            ->get();
        
        
    }
    
    public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
    {
        Task::find($recordId)->update(['status' => $status]);
        Task::setNewOrder($toOrderedIds);
        // Log::info($message);
    }
     
    public function onSortChanged(int $recordId, string $status, array $orderedIds): void
    {
        Task::setNewOrder($orderedIds);
    }
    
    
    protected function getEditModalFormSchema(null|int $recordId): array
    {
        return [
            TextInput::make('title')
                ->required(),
            Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            Toggle::make('urgent')
                ->required(),
            TextInput::make('project')
                ->required(),
            DatePicker::make('due_date')
                ->required(),
            TextInput::make('progress')
                ->required()
                ->numeric(),
                Select::make('user_id')
                ->default(auth()->id())
                ->relationship('user', 'name')
                ->required(),
                Select::make('team')
            ->label('Assigned User')
            ->relationship('team','name')
            ->multiple()
            ->nullable()
            ->searchable()
            ->preload(),
            
        ];
    }
    
    

    protected function getEditModalRecordData(int $recordId, array $data): array
    {
        return Task::find($recordId)->toArray();

    }
    
    
    protected function editRecord($recordId, array $data, array $state): void
    {
        Task::find($recordId)->update([
            'title' => $data['title'],
            'description' => $data['description'],
            'urgent' => $data['urgent'],
            'project' => $data['project'],
            'due_date' => $data['due_date'],
            'progress' => $data['progress'],
            'user_id' => $data['user_id'],
        ]);
    
    }
    
    protected function getHeaderActions(): array
    {
        return [

            
            CreateAction::make()
            ->model(Task::class)
            ->form([
            TextInput::make('title')
                ->required(),
            Textarea::make('description')
                ->required()
                ->columnSpanFull(),
            Toggle::make('urgent')
                ->required(),
            TextInput::make('project')
                ->nullable(),
            DatePicker::make('due_date')
                ->nullable(),
            Select::make('user_id')
            ->default(auth()->id())->disabled()
            ->relationship('user', 'name')
                ->required(),
    
            Select::make('team')
            ->label('Assign User')
            ->relationship('team','name')
            ->multiple()
            ->nullable()
            ->searchable()
            ->preload(),
    
    
            ]),
        ];
    }
    
    protected function additionalRecordData(Model $record): Collection
    {
        
        return collect([
            'urgent' => $record->urgent,
            'progress' => $record->progress,
            // 'owner' => $record->user->name,
            'description' => $record->description,
    
        ]);
    }

       
    
    }

   