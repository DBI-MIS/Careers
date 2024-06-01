<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PostResource\Pages;
use App\Filament\Resources\PostResource\RelationManagers;
use App\Models\Category;
use App\Models\Post;
use Filament\Forms;
use Filament\Forms\Components\Checkbox;
use Filament\Forms\Form;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Hidden;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Filament\Forms\Components\MarkdownEditor;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Section;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Toggle;
use Filament\Forms\Components\ToggleButtons;
use Filament\Forms\Set;
use Illuminate\Support\Str;
use Filament\Forms\Get;
use Filament\Panel;
use Filament\Tables\Columns\BadgeColumn;
use Filament\Tables\Columns\CheckboxColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Columns\ToggleColumn;

class PostResource extends Resource
{
    protected static ?string $model = Post::class;

    protected static ?string $navigationIcon = 'heroicon-s-pencil-square';

    protected static ?string $navigationGroup = 'Job Post';

    protected ?string $subheading = 'Job Post';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?int $navigationSort = 1;

    protected static bool $shouldSkipAuthorization = true;

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Section::make('Job Details')
                    ->description(' ')
                    ->schema([
                        TextInput::make('title')
                            ->required()
                            ->label(__('Job Title'))
                            ->live(onBlur: true)
                            ->columnSpan(2)
                            ->afterStateUpdated(
                                function (string $operation, string $state, Forms\Set $set) {
                                    if ($operation === 'edit') {
                                        return;
                                    }
                                    $set('slug', Str::slug($state));
                                }
                            ),



                        Select::make('categories')
                            ->multiple()
                            ->relationship('categories', 'title')
                            ->searchable()
                            ->preload()
                            ->label(__('Job Categories'))
                            ->createOptionForm([
                                TextInput::make('title')
                                    ->required()
                                    ->label(__('Category'))
                                    ->live()
                                    ->columnSpan(2)
                                    ->afterStateUpdated(
                                        function (string $operation, string $state, Forms\Set $set) {
                                            if ($operation === 'edit') {
                                                return;
                                            }
                                            $set('slug', Str::slug($state));
                                        }
                                    ),
                                    Hidden::make('slug')
                                    ->required()
                                    ->unique(ignoreRecord: true),

                                ToggleButtons::make('text_color')->default('white')
                                    ->required()
                                    ->options([
                                        'white' => 'white',
                                        'blue' => 'blue',
                                        'red' => 'red',
                                        'yellow' => 'yellow',
                                        'green' => 'green',
                                    ])
                                    ->grouped()
                                    ->label(__('Text Color')),

                                ToggleButtons::make('bg_color')->default('blue')
                                    ->required()
                                    ->options([
                                        'gray' => 'gray',
                                        'blue' => 'blue',
                                        'red' => 'red',
                                        'yellow' => 'yellow',
                                        'green' => 'green',
                                    ])
                                    ->grouped()
                                    ->label(__('Background Color')),
                            ])->createOptionModalHeading('Create New Category')

                            ->columnSpan(2),






                        ToggleButtons::make('job_level')
                            ->required()
                            ->options([
                                'Entry Level' => 'Entry Level ',
                                'Supervisory' => 'Supervisory',
                                'Managerial' => 'Managerial',
                                'Internship' => 'Internship'
                            ])
                            ->grouped()
                            ->label(__('Job Level')),



                        MarkdownEditor::make('post_description')
                            ->required()
                            ->label(__('Job Description'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'codeBlock',
                                'h2',
                                'h3',
                                'italic',
                                'link',
                                'orderedList',
                                'strike',
                                'underline',
                            ])
                            ->columnSpan(2),
                        RichEditor::make('post_responsibility')
                            ->required()
                            ->label(__('Job Responsibilities'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'codeBlock',
                                'h2',
                                'h3',
                                'link',
                                'orderedList',
                                'strike',
                                'underline',
                            ])
                            ->columnSpan(2),
                        RichEditor::make('post_qualification')
                            ->required()
                            ->label(__('Job Qualifications'))
                            ->disableToolbarButtons([
                                'attachFiles',
                                'blockquote',
                                'bold',
                                'codeBlock',
                                'h2',
                                'h3',
                                'link',
                                'orderedList',
                                'strike',
                                'underline',
                            ])
                            ->columnSpan(2),
                    ])->columnSpan(2),


                Section::make(' ')
                    ->description(' ')
                    ->schema([

                        DatePicker::make('date_posted')
                            ->required()
                            ->label(__('Date'))
                            ->readonly()
                            ->closeOnDateSelection()
                            ->default(now())
                            ->displayFormat('m/d/Y')
                            ->nullable(),

                        Toggle::make('featured')
                            ->label(__('Post to Frontpage'))
                            ->offColor('warning')
                            ->default(true)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->hintIcon('heroicon-o-information-circle', 'Set to "Enable" to show it on the Front Page'),

                        Toggle::make('status')
                            ->label(__('Active'))
                            ->offColor('warning')
                            ->default(true)
                            ->onIcon('heroicon-m-check')
                            ->offIcon('heroicon-m-x-mark')
                            ->hint(str('What is this?'))
                            ->hintIcon('heroicon-o-information-circle', 'Set to "Active" to show it on the Search Job Page'),

                        ToggleButtons::make('job_type')
                            ->required()
                            ->options([
                                'Full Time' => 'Full Time',
                                'Part Time' => 'Part Time',
                                'Internship' => 'Internship'
                            ])
                            ->grouped()
                            ->label(__('Job Type')),

                        ToggleButtons::make('job_location')
                            ->required()
                            ->options([
                                'Metro Manila' => 'Metro Manila',
                                'Cebu' => 'Cebu',
                                'Davao' => 'Davao'
                            ])
                            ->grouped()
                            ->label(__('Job Location')),

                        // Select::make('user_id')
                        //     ->relationship('author', 'name')
                        //     ->searchable()
                        //     ->required()
                        //     ->preload(),

                        Hidden::make('slug')
                            ->required()
                            ->label(__('URL'))
                            ->hint('This is auto-generated.'),


                    ])->columnSpan(1)



            ])->columns(3);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                // Tables\Columns\TextColumn::make('id'),
                TextColumn::make('title')
                    ->searchable()
                    ->label(__('Job Title')),
                // Tables\Columns\TextColumn::make('author.name')
                //     ->searchable()
                //     ->label(__('Posted By')),
                TextColumn::make('date_posted')
                    ->date('D - M d, Y')
                    ->sortable()
                    ->label(__('Date Posted')),
                // TextColumn::make('categories')
                // ->,
                ToggleColumn::make('featured')
                    ->label(__('On Frontpage'))
                    ->sortable()
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->offColor('warning')
                    ->alignCenter(),
                ToggleColumn::make('status')
                    ->label(__('Active'))
                    ->sortable()
                    ->onIcon('heroicon-m-check')
                    ->offIcon('heroicon-m-x-mark')
                    ->offColor('warning')
                    ->beforeStateUpdated(function ($record, $state) {
                        // Runs before the state is saved to the database.
                    })
                    ->afterStateUpdated(function ($record, $state) {
                        // Runs after the state is saved to the database.
                    }),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
                TextColumn::make('updated_at')
                    ->dateTime()
                    ->sortable()
                    ->toggleable(isToggledHiddenByDefault: true),
            ])
            ->defaultSort('created_at', 'desc')
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
            'index' => Pages\ListPosts::route('/'),
            'create' => Pages\CreatePost::route('/create'),
            'view' => Pages\ViewPost::route('/{record}'),
            'edit' => Pages\EditPost::route('/{record}/edit'),
        ];
    }
}
