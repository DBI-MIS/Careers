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
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Guava\FilamentClusters\Forms\Cluster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Mokhosh\FilamentKanban\Pages\KanbanBoard;
use Parallax\FilamentComments\Actions\CommentsAction;
use Parallax\FilamentComments\Models\Traits\HasFilamentComments;
use SearchableTrait;

class AllTasksBoard extends KanbanBoard
{

    use HasFilamentComments;

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
    // protected ?string $subheading = 'List of All Tasks accross all board';

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

            Section::make('Task Details')
                ->description(' ')
                ->schema([

                    Toggle::make('urgent')
                        ->required()
                        ->columnSpan(1),
                    TextInput::make('progress')
                        ->label('')
                        ->prefix('Progress')
                        ->numeric()
                        ->step(25)
                        ->maxValue(100)
                        ->minValue(0)
                        ->suffix('%')
                        ->columnSpan(2),

                    Cluster::make([
                        TextInput::make('title')
                            ->label('Task Name')
                            ->autocapitalize('words')
                            ->required()
                            ->columnSpan(2),
                        Textarea::make('description')
                            ->required()
                            ->rows('3')
                            ->columnSpan(2),
                    ])
                        ->label('Task Name')
                        ->hint('')
                        ->helperText('*Description can be Blank')->columnSpanFull(),

                    Cluster::make([


                        TextInput::make('project')
                            ->label('Project')
                            ->nullable()
                            ->columnSpan(1),
                        DatePicker::make('due_date')
                            ->label('Due Date')
                            ->date('D - M d, Y')
                            ->nullable()->columnSpan(1),
                    ])
                        ->label('Project')
                        ->hint('Due Date')
                        ->columnSpan(3),

                    Cluster::make([
                        Select::make('user_id')
                            ->default(auth()->id())
                            ->relationship('user', 'name')
                            ->required()
                            ->columnSpan(2),
                        Select::make('team')
                            ->label('Assigned User')
                            ->relationship('team', 'name')
                            ->multiple()
                            ->nullable()
                            ->searchable()
                            ->preload()
                            ->columnSpan(2),
                    ])
                        ->label('User')
                        ->hint('Assigned User/s')
                        ->helperText(' ')->columnSpan(3),

                ])->columns(3),

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
                    Toggle::make('urgent')
                        ->required(),
                    Cluster::make([
                        TextInput::make('title')
                            ->label('Task Name')
                            ->required()
                            ->columnSpan(1),
                        Textarea::make('description')
                            ->required()
                            ->rows('3')
                            ->columnSpan(2),
                    ])
                        ->label('Task Name')
                        ->hint('')
                        ->helperText('*Description can be Blank')->columns(1),

                    Cluster::make([


                        TextInput::make('project')
                            ->label('Project')
                            ->nullable(),
                        DatePicker::make('due_date')
                            ->label('Due Date')
                            ->date('D - M d, Y')
                            ->nullable(),

                    ])
                        ->label('Project')
                        ->hint('Due Date')
                        ->columns(2),

                    Cluster::make([
                        Select::make('user_id')
                            ->default(auth()->id())
                            ->relationship('user', 'name')
                            ->required()
                            ->columnSpan(1),
                        Select::make('team')
                            ->label('Assigned User')
                            ->relationship('team', 'name')
                            ->multiple()
                            ->nullable()
                            ->searchable()
                            ->preload()
                            ->columnSpan(2),
                    ])
                        ->label('User')
                        ->hint('Assigned User/s')
                        ->helperText(' ')->columns(3),

                ]),
            // Parallax\FilamentComments\Actions\CommentsAction::make(),
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
