<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Str;

class Post extends Model
{
    use HasFactory;
    use SoftDeletes;
    
    

    protected $fillable = [
        'user_id',
        'title',
        'date_posted',
        'job_category',
        'job_level',
        'job_location',
        'job_type',
        'post_description',
        'post_responsibility',
        'post_qualification',
        'slug',
        'status',
        'featured',
    ];

    protected $casts = [
        'date_posted' => 'datetime',
        'status' => 'boolean'
    ];

    public function author()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function response()
    {
        return $this->belongsTo(Post::class, 'post_id');
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class);
    }

    public function responses()
    {
        return $this->belongsToMany(Response::class);
    }

    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function scopePublished($query)
    {
        $query->where('date_posted', '<=', Carbon::now());
    }

    public function scopeWithCategory($query, string $category)
    {
        $query->whereHas('categories', function($query) use ($category)
        {
            $query->where('slug', $category);
        });
    }

    public function getExcerpt() 
    {
        return Str::limit(strip_tags($this->post_description), 200);
    }
}

