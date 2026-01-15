<?php

namespace App\Services;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;
use Illuminate\Support\Facades\Auth;

class StoreCommentService
{
    public function storeComment(array $data)
    {
        $commentable = match ($data['commentable_type']) {
            'news' => News::findOrFail($data['commentable_id']),
            'video' => VideoPost::findOrFail($data['commentable_id']),
            'comment' => Comment::findOrFail($data['commentable_id']),
        };

        return $commentable->comments()->create([
            'user_id' => Auth::id(),
            'content' => $data['content'],
        ]);
    }
}
