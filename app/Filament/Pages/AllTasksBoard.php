<?php

namespace App\Filament\Pages;

use App\Enums\CompletedStatus;
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
use Filament\Support\Enums\Alignment;
use Filament\Support\Enums\IconPosition;
use Filament\Support\Enums\IconSize;
use Guava\FilamentClusters\Forms\Cluster;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use JaOcero\RadioDeck\Forms\Components\RadioDeck;
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


    protected static ?string $navigationIcon = 'heroicon-s-clipboard-document-list';
    protected ?string $subheading = 'Mark as Done to remove from board.';

    protected static string $model = Task::class;

    protected static string $statusEnum = TaskStatus::class;

    protected static ?int $navigationSort = 1;

    protected static ?string $navigationGroup = 'Board';
    protected static ?string $title = 'All Tasks';


    // protected function records(): Collection
    // {

    //     return Task::ordered()->get();

    // }

    protected function records(): Collection
    {
        // Get current date and the weekday number (0 for Sunday, 1 for Monday, etc.)
        $currentDate = Carbon::now();
        $currentWeekday = $currentDate->dayOfWeek;

        // Determine the start and end of the current week (Monday to Friday)
        $startOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY);
        $endOfWeek = $currentDate->copy()->startOfWeek(Carbon::MONDAY)->addDays(7);

        // Retrieve tasks created from Monday to Friday and with status not equal to 'done'
        return Task::whereBetween('created_at', [$startOfWeek, $endOfWeek])
                    ->ordered()
                    ->get();
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
            RadioDeck::make('is_done')
            ->label('Status')
                        ->options(CompletedStatus::class)
                        ->descriptions(CompletedStatus::class)
                        ->icons(CompletedStatus::class)
                        ->required()
                        ->iconSize(IconSize::Small)
                        ->iconPosition(IconPosition::Before)
                        ->alignment(Alignment::Center)
                        ->extraCardsAttributes([
                            'class' => 'rounded-md'
                        ])
                        ->extraOptionsAttributes([
                            'class' => 'text-sm leading-none w-full flex flex-col items-center justify-center p-1'
                        ])
                        ->extraDescriptionsAttributes([ 
                            'class' => 'text-xs font-light text-center'
                        ])
                        ->color('primary')
                        ->padding('px-3 px-3') 
                        ->columns(3),

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
            'is_done' => $data['is_done'],
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
