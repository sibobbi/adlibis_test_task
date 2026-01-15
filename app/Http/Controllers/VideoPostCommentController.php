<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;
use Illuminate\Http\Request;

class VideoPostCommentController extends Controller
{
    public function index(VideoPost $videoPost)
    {
        return Comment::where('commentable_type', VideoPost::class)
            ->where('commentable_id', $videoPost->id)
            ->with(['user', 'replies.user'])
            ->cursorPaginate(10);
    }
}
