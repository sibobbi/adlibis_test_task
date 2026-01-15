<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class NewsCommentController extends Controller
{
    public function index(News $news)
    {
        return Comment::where('commentable_type', News::class)
            ->where('commentable_id', $news->id)
            ->with(['user', 'replies.user'])
            ->cursorPaginate(10);
    }
}
