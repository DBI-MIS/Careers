<?php

namespace App\Filament\Widgets;

use App\Models\Response;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget as BaseWidget;

class LatestResponseOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 'full';
    protected static ?string $heading = 'Latest Job Applications';
    public function table(Table $table): Table
    {
        return $table
            ->query(Response::query()
                // ...
            )->defaultSort('date_response', 'desc')
            ->columns([
                TextColumn::make('date_response')->since()->label('Date'),
                TextColumn::make('full_name')->label('Name'),
                TextColumn::make('post.title')->label('Postition Applied'),
                TextColumn::make('contact')->label('Contact No.'),
                TextColumn::make('email_address')->label('Email'),
                

                
            ]);
    }
}
