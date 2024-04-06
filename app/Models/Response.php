<?php

namespace App\Models;

use Filament\Notifications\Notification;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;



class Response extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;

    public function routeNotificationForMail(Notification $notification): array|string
    {
        // Return email address only...
        return $this->email_address;
    }

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
        return $this->belongsTo(Post::class, 'post_title');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
