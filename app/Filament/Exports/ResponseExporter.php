<?php

namespace App\Filament\Exports;

use App\Models\Response;
use Filament\Actions\Exports\ExportColumn;
use Filament\Actions\Exports\Exporter;
use Filament\Actions\Exports\Models\Export;

class ResponseExporter extends Exporter
{
    protected static ?string $model = Response::class;

    public static function getColumns(): array
    {
        return [
            ExportColumn::make('id')
                ->label('ID')
                 ->enabledByDefault(false),
            ExportColumn::make('full_name'),
            ExportColumn::make('post_title'),
            ExportColumn::make('date_response'),
            ExportColumn::make('contact'),
            ExportColumn::make('email_address'),
            ExportColumn::make('current_address'),
            ExportColumn::make('attachment'),
            ExportColumn::make('review'),
            ExportColumn::make('status'),
            ExportColumn::make('deleted_at'),
            ExportColumn::make('created_at'),
            ExportColumn::make('updated_at'),
        ];
    }

    public static function getCompletedNotificationBody(Export $export): string
    {
        $body = 'Your response export has completed and ' . number_format($export->successful_rows) . ' ' . str('row')->plural($export->successful_rows) . ' exported.';

        if ($failedRowsCount = $export->getFailedRowsCount()) {
            $body .= ' ' . number_format($failedRowsCount) . ' ' . str('row')->plural($failedRowsCount) . ' failed to export.';
        }

        return $body;
    }
}
