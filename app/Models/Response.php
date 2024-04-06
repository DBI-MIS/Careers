<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Response extends Model
{
    use HasFactory;
    use SoftDeletes;
    protected $fillable = [
        'full_name',
        'date_response',
        'contact',
        'email_address',
        'current_address',
        'attachment',
        'slug',
        'status',
    ];
    
    protected $casts = [
        'date_response' => 'datetime',
        'status' => 'boolean'
    ];
    
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
