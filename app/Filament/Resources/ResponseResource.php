<?php

namespace App\Filament\Resources;

use App\Filament\Exports\ResponseExporter;
use App\Filament\Resources\ResponseResource\Pages;
use App\Filament\Resources\ResponseResource\RelationManagers;
use App\Models\Post;
use App\Models\Response;
use App\ResponseStatus;
use Carbon\Carbon;
use Filament\Actions\ExportAction;
use Filament\Actions\Exports\Enums\ExportFormat;
use Filament\Forms;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Hidden;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\SelectColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Str;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use pxlrbt\FilamentExcel\Actions\Tables\ExportBulkAction;
use pxlrbt\FilamentExcel\Columns\Column;
use pxlrbt\FilamentExcel\Exports\ExcelExport;

class ResponseResource extends Resource
{
    protected static ?string $model = Response::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-arrow-down';

    protected static ?string $navigationGroup = 'Job Applications';
    
    
    

    public static function getNavigationBadge(): ?string
{
    return static::getModel()::count();
}

    protected static ?int $navigationSort = 4;

    // protected static array $statuses = [
    //     'is pending' => 'pending',
    //     'is cancelled' => 'cancelled',
    //     'is hired' => 'hired',
    //     'is unqualified' => 'unqualified',
    // ];

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                TextInput::make('full_name')
                ->required()
                ->label(__('Full Name'))
                ->live(onBlur:true)
                ->columnSpan(2)
                ->hint('  '),
                // Radio::make('status')->options(ResponseStatus::class),
                Select::make('post_title')
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
                ->uploadingMessage('Uploading attachment...')
                ->directory('form-attachments')
                ->visibility('public')
                ->acceptedFileTypes(['application/pdf', 'application/msword', 'application/vnd.openxmlformats-officedocument.wordprocessingml.document'])
                ->maxSize(5120)
                ->getUploadedFileNameForStorageUsing(
                    fn (TemporaryUploadedFile $file): string => (string) str($file->getClientOriginalName())
                        ->prepend('job_response'),)
                ->openable()
                ->downloadable()
                ->fetchFileInformation(true)
                ->moveFiles()
                ->storeFiles(true)
                ->removeUploadedFileButtonPosition('right')
                ->uploadButtonPosition('left')
                ->uploadProgressIndicatorPosition('left')
                // ->required()
                ->columnSpan(3)
                ->id('attachment')

            ,
            ]) ->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
        
            ->columns([
                
                Tables\Columns\TextColumn::make('date_response')
                    ->date()
                    ->sortable()
                    ->label(__('Date'))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('full_name')
                    ->searchable()
                    ->label(__('Name'))
                    ->alignCenter(),
                Tables\Columns\TextColumn::make('post.title')
                 ->label(__('Position'))
                    ->sortable()
                    ->alignCenter(),
                Tables\Columns\IconColumn::make('attachment')
                    ->grow(false)
                    ->label(' ')
                    ->icon('heroicon-o-link')
                    ->wrap()
                    ->alignCenter(),
                Tables\Columns\ToggleColumn::make('review')
                    ->label(__('Reviewed'))
                    ->sortable()
                    ->alignCenter(),
                    SelectColumn::make('status')
                    ->options(ResponseStatus::class)
                    ->selectablePlaceholder(false)
                    ->sortable()
                    ->searchable()
                    ->grow(false)
                    ->alignCenter()
                    
            ])->defaultSort('date_response', 'desc')
            ->heading('Job Form Responses')
            ->filters([
                
                Tables\Filters\TrashedFilter::make(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
                Tables\Actions\DeleteAction::make(), 
                Tables\Actions\RestoreAction::make(),
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    ExportBulkAction::make()->exports([
                        ExcelExport::make()
                        ->withFilename(date(Carbon::now()) . ' - Job Application Responses')
                        ->withColumns([
                            Column::make('date_response')
                            ->heading('Date of Application'),
                            Column::make('full_name')
                            ->heading('Name of Applicant'),
                            Column::make('post.title')
                            ->heading('Position Applied'),
                            Column::make('contact')
                            ->heading('Contact No.'),
                            Column::make('email_address')
                            ->heading('Email Address'),
                            Column::make('status')
                            ->heading('Status'),
                        ]),
                    ]),
                    Tables\Actions\DeleteBulkAction::make(),
                    Tables\Actions\ForceDeleteBulkAction::make(), 
                    Tables\Actions\RestoreBulkAction::make(), 
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
