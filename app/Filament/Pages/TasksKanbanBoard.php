<?php

namespace App\Filament\Pages;

use App\Enums\TaskStatus;
use App\Models\Task;
use App\Models\User;
use Filament\Actions\CreateAction;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ViewField;
use Filament\Http\Middleware\Authenticate;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;

class TasksKanbanBoard extends KanbanBoard
{
    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected static ?string $navigationGroup = 'Board';
    protected static ?string $title = 'Tasks';

    protected function records(): Collection
{

    return Task::ordered()
    ->whereHas('team', function($query) {
        return $query->where('user_id', auth()->id());
    }
    )
    ->orWhere('user_id', auth()->id())
    ->get();
    
}

public function onStatusChanged(int $recordId, string $status, array $fromOrderedIds, array $toOrderedIds): void
{
    Task::find($recordId)->update(['status' => $status]);
    Task::setNewOrder($toOrderedIds);
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