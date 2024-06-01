<?php

namespace App\Enums;

use Mokhosh\FilamentKanban\Concerns\IsKanbanStatus;

enum TaskStatus: string
{
    use IsKanbanStatus;

    case Todo = 'todo';
    case OnGoing = 'ongoing';
    case ForReview = 'review';

    public function getTitle(): string
    {
        return $this->name;
    }
}