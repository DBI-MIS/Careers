<?php

namespace App\Filament\Resources\PostResource\Widgets;

use App\Models\Post;
use Filament\Support\Enums\IconPosition;
use Filament\Widgets\StatsOverviewWidget as BaseWidget;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class PostOverview extends BaseWidget
{
    protected static ?int $sort = 2;
    protected int | string | array $columnSpan = 2;
    protected function getStats(): array
    {
        return [
            Stat::make('Total Post', Post::count())
            ->description('Number of Posts on the Page')
            ->descriptionIcon('heroicon-o-pencil-square', IconPosition::Before)
            ->chart([40,20,10,4,4,3,4,1])
            ->color('success')
        ];
    }
}
