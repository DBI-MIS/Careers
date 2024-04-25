<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use App\Imports\PostImport;
use EightyNine\ExcelImport\ExcelImportAction;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListPosts extends ListRecords
{
    protected static string $resource = PostResource::class;

    protected function getHeaderActions(): array
    {
        return [
            // ExcelImportAction::make()
            //     ->color("primary")
            //     ->use(PostImport::class),
            Actions\CreateAction::make(),
        ];
    }
}
