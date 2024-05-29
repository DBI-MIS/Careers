<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;

class Task extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
        'user_id',
        'title',
            'description',
            'urgent',
            'project',
            'due_date',
            'progress',
            'status',
            'order_column',
    ];

    // public function user_tasks()
    // {
    //     return $this->belongsToMany(User::class, 'task_user')->withTimestamps();
    // }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function team()
    {
        return $this->belongsToMany(User::class, 'task_user');
    }
}
