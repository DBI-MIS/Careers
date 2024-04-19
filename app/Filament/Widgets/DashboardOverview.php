<?php

namespace App\Filament\Widgets;

use App\Models\Category;
use App\Models\Post;
use App\Models\Response;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardOverview extends BaseWidget
{
    protected static ?int $sort = 1;
    protected int | string | array $columnSpan = 'full';
    protected function getStats(): array
    {
        return [
            Stat::make('Total Posts', Post::count())
            ->description('No. of Posts on the Page')
            ->descriptionIcon('heroicon-o-pencil-square', IconPosition::Before)
            ->chart([40,20,10,4,4,3,4,1])
            ->color('success'),
            Stat::make('Total Job Applications', Response::count())
            ->description('No. of Job Applications')
            ->descriptionIcon('heroicon-o-pencil-square', IconPosition::Before)
            ->chart([1,4,3,4,4,10,20,40])
            ->color('success'),
            Stat::make('Total Categories', Category::count())
            ->description('No. of Categories')
            
        ];
    }
}
