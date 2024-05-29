<?php

namespace App\Filament\Resources\ResponseResource\Pages;

use App\Filament\Resources\ResponseResource;
use App\Mail\EmailResponse;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Mail;

class CreateResponse extends CreateRecord
{
    protected static string $resource = ResponseResource::class;

    protected function getCreatedNotificationTitle(): ?string
    {
        return 'New Job Application Created';
    }

    protected function getRedirectUrl(): string
    {
        return $this->getResource()::getUrl('index');
    }
    
}
