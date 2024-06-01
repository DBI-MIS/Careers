<?php

namespace App\Filament\Resources\TaskResource\Pages;

use App\Filament\Resources\TaskResource;
use Filament\Resources\Pages\Page;
use pxlrbt\FilamentActivityLog\Pages\ListActivities;

class ActivityLogPage extends ListActivities
{
    protected static string $resource = TaskResource::class;

    protected static ?string $navigationGroup = 'Board';
    
    protected static ?string $title = 'Tasks';

    protected ?string $subheading = 'Task History';



    // protected static string $view = 'filament.resources.task-resource.pages.activity-log-page';
}
