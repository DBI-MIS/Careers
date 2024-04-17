<?php

namespace App\Models;

use App\Notifications\ResponseUpdate;
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

    public function routeNotificationForMail(ResponseUpdate $notification): array|string
    {   
        $email_address = "ggcmis@dbiphils.com";
        // Return email address only...
        return $email_address;
    }

    protected $fillable = [
        'post_id',
        'full_name',
        'date_response',
        'contact',
        'email_address',
        'current_address',
        'attachment',
        'status',
    ];
    
    protected $casts = [
        'date_response' => 'datetime',
        'status' => 'boolean',
        // 'attachment' => 'array',
    ];
    public function job_title()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }
    
    public function post()
    {
        return $this->belongsTo(Post::class, 'post_title');
    }

    public function posts()
    {
        return $this->belongsToMany(Post::class);
    }

}
