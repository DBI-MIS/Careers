<?php

namespace App\Filament\Resources\ResponseResource\Widgets;

use App\Models\Response;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class ResponsesOverview extends BaseWidget
{
    protected static ?int $sort = 3;
    protected int | string | array $columnSpan = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Responses', Response::count())
            ->description('Number of Job Application Responses')
            ->descriptionIcon('heroicon-o-pencil-square', IconPosition::Before)
            ->chart([1,4,3,4,4,10,20,40])
            ->color('success'),
        ];
    }
}
