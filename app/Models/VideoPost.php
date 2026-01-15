<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class VideoPost extends Model
{
    protected $fillable = ['title', 'description'];

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(Comment::class, 'commentable');
    }
}
