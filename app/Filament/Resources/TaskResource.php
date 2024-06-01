<?php

namespace App\Filament\Resources;

use App\Filament\Resources\TaskResource\Pages;
use App\Filament\Resources\TaskResource\RelationManagers;
use App\Models\Task;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Actions\Action;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;

class TaskResource extends Resource
{
    protected static ?string $model = Task::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Board';    

    protected static ?string $title = 'History';

    protected static bool $shouldRegisterNavigation = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                // TextInput::make('user')
                //     ->required(),
                // TextInput::make('title')
                //     ->required(),
                // Textarea::make('description')
                //     ->required()
                //     ->columnSpanFull(),
                // Toggle::make('urgent')
                //     ->required(),
                // TextInput::make('project')
                //     ->required()
                //     ->maxLength(255),
                // DatePicker::make('due_date')
                //     ->required(),
                // TextInput::make('progress')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
                // TextInput::make('status')
                //     ->required()
                //     ->maxLength(255)
                //     ->default('todo'),
                // TextInput::make('order_column')
                //     ->required()
                //     ->numeric()
                //     ->default(0),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('user.name')
                    ->sortable()
                    ->searchable(),
                TextColumn::make('status')
                    ->sortable()
                    ->searchable()
                    ->badge(),
                    TextColumn::make('progress')
                    ->suffix('%')
                    ->numeric()
                    ->sortable(),
                TextColumn::make('title')
                     ->label('Task Name')
                     ->wrap()
                    ->searchable(),            
                TextColumn::make('created_at')
                    ->dateTime('m-d-Y')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime('m-d-Y h:i A')
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])->defaultSort('updated_at','desc')
            ->filters([
                //
            ])
            ->actions([
                // Tables\Actions\EditAction::make(),
                Action::make('history')->url(fn ($record) => TaskResource::getUrl('history', ['record' => $record]))
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ]);
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListTasks::route('/'),
            // 'create' => Pages\CreateTask::route('/create'),
            'history' => Pages\ActivityLogPage::route('/{record}/history'),
            // 'edit' => Pages\EditTask::route('/{record}/edit'),
        ];
    }
}
