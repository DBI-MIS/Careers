<?php

namespace App\Filament\Pages;

use App\Filament\Resources\PostResource\Widgets\PostOverview;
use App\Filament\Resources\ResponseResource\Widgets\ResponsesOverview;
use App\Filament\Widgets;
use App\Filament\Widgets\CalendarWidget;
use App\Filament\Widgets\DashboardOverview;
use App\Filament\Widgets\LatestResponseOverview;
use Filament\Facades\Filament;
use Filament\Pages\Page;
use Saade\FilamentFullCalendar\Widgets\FullCalendarWidget;

class Dashboard extends Page
{
    protected static ?string $navigationIcon = 'heroicon-o-computer-desktop';

    protected static string $view = 'filament.pages.dashboard';

    protected function getColumns(): int | array
{
    return 4;
}
protected function getHeaderWidgets(): array
{
    return [
        DashboardOverview::class,
        LatestResponseOverview::class,
        
    ];
}
    // protected function getWidgets(): array
    // {
    //     // return default widgets
    //     return Filament::getWidgets();
    // }
}
