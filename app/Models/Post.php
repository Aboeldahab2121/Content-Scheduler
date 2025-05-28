<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    protected $fillable = ['title', 'content', 'image_url', 'scheduled_time', 'status'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function platforms()
    {
        return $this->belongsToMany(Platform::class, 'post_platform')
            ->withPivot('platform_status')
            ->withTimestamps();
    }

    public function scopeScheduled($query)
    {
        return $query->where('status', 'scheduled');
    }

    public static function scopeDueForPublishing($query)
    {
        return $query->scheduled()->where('scheduled_time', '<=', now());
    }

    protected $casts = [
        'scheduled_time' => 'datetime',
    ];
}
