<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = [
        'user_id',
        'content',
    ];
    protected $hidden = [
        'commentable_type',
        'commentable_id',
        'user_id'
    ];

    public function commentable(): \Illuminate\Database\Eloquent\Relations\MorphTo
    {
        return $this->morphTo();
    }

    public function user(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function comments(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(__CLASS__, 'commentable');
    }

    public function replies(): \Illuminate\Database\Eloquent\Relations\MorphMany
    {
        return $this->morphMany(__CLASS__, 'commentable')
            ->with(['replies','user'])
            ->orderBy('id');
    }
}
