<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum NotesPin: string
{
    use IsKanbanStatus;

    case Pinned = 'pinned';
    case Note = 'note';

    public function getTitle(): string
    {
        return $this->name;
    }
}