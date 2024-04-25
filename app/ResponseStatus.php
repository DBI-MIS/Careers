<?php

namespace App;

use Filament\Support\Contracts\HasColor;
use Filament\Support\Contracts\HasIcon;
use Filament\Support\Contracts\HasLabel;

enum ResponseStatus: string implements HasLabel, HasColor, HasIcon
{
    case IS_PENDING = 'pending';
    case IS_CANCELLED = 'cancelled';
    case IS_HIRED = 'hired';
    case IS_UNQUALIFIED = 'unqualified';

    public function getLabel(): ?string
    {
        return match ($this) {
            self::IS_PENDING => 'pending',
            self::IS_CANCELLED => 'cancelled',
            self::IS_HIRED => 'hired',
            self::IS_UNQUALIFIED => 'unqualified',

        };   
    }

    public function getColor(): string|array|null
    {
        return match ($this) {
            self::IS_PENDING => 'gray',
            self::IS_CANCELLED => 'warning',
            self::IS_HIRED => 'success',
            self::IS_UNQUALIFIED => 'gray',

        };   
    }

    public function getIcon(): ?string
    {
        return match ($this) {
            self::IS_PENDING => 'heroicon-m-eye',
            self::IS_CANCELLED => 'heroicon-m-eye',
            self::IS_HIRED => 'heroicon-m-check',
            self::IS_UNQUALIFIED => 'heroicon-m-eye',
        };   
    }
    
}
