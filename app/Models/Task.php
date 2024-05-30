<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\EloquentSortable\Sortable;
use Spatie\EloquentSortable\SortableTrait;
use Illuminate\Support\Str;

class Task extends Model implements Sortable
{
    use HasFactory, SortableTrait;

    protected $fillable = [
            'user',
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

    public function getTrim() 
    {
        return Str::limit(strip_tags($this->description), 100);
    }

    public function scopeOrdered($query)
    {
        return $query->orderBy('due_date', 'desc');
    }
}
