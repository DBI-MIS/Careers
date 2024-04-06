<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ResponseResource\Pages;
use App\Filament\Resources\ResponseResource\RelationManagers;
use App\Models\Response;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;

class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;

    protected static ?string $navigationIcon = 'heroicon-o-rectangle-stack';

    protected static ?string $navigationGroup = 'Job Applications';

    protected static ?int $navigationSort = 4;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                ->required()
                ->label(__('Full Name'))
                ->live(onBlur:true)
                ->columnSpan(2)
                ->hint('  ')
                ->afterStateUpdated(
                    function(string $operation, string $state, Forms\Set $set) {
                    if ($operation === 'edit'){
                        return;}
                $set('slug', Str::slug($state));
                }),
                Select::make('post_id')
                    ->relationship('post', 'title')
                    ->searchable()
                    ->required()
                    ->preload()
                    ->label(__('Position')),
                DatePicker::make('date_response')
                    ->required()
                    ->readonly()
                    ->closeOnDateSelection()
                    ->default(now())
                    ->label(__('Date')),
                TextInput::make('contact')
                    ->tel()
                    ->maxLength(11)
                    ->label(__('Contact Number')),
                TextInput::make('email_address')
                    ->email()
                    ->unique()
                    ->label(__('Email Address')),
                TextInput::make('current_address')
                ->columnSpan(3)
                    ->required()
                    ->label(__('Current Address'))
                    ->hint('#/Street'),
                    
                FileUpload::make('attachment')
                    ->disk('s3')
                    ->directory('form-attachments')
                    ->visibility('private')
                    ->getUploadedFileNameForStorageUsing(
                        fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                            ->prepend('job-application-response-'),
                    )
                    ->columnSpan(3),
                Hidden::make('slug')
                    ->label(__('URL'))
                    ->hint('This is auto-generated.'),
            ]) ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable(),
                Tables\Columns\TextColumn::make('post.title')
                    ->sortable(),
                Tables\Columns\TextColumn::make('date_response')
                    ->date()
                    ->sortable(),
                Tables\Columns\TextColumn::make('contact')
                    ->searchable(),
                Tables\Columns\TextColumn::make('email_address')
                    ->searchable(),
                Tables\Columns\TextColumn::make('current_address'),
                Tables\Columns\TextColumn::make('attachment')
                    ->searchable(),
                Tables\Columns\TextColumn::make('slug')
                    ->searchable(),
                Tables\Columns\IconColumn::make('status')
                    ->boolean(),
                Tables\Columns\TextColumn::make('deleted_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                Tables\Columns\TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
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
            'index' => Pages\ListResponses::route('/'),
            'create' => Pages\CreateResponse::route('/create'),
            'view' => Pages\ViewResponse::route('/{record}'),
            'edit' => Pages\EditResponse::route('/{record}/edit'),
        ];
    }
}
