<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreNewsRequest;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return News::paginate(10);
    }

    public function store(StoreNewsRequest $request)
    {
        $data = $request->validated();

        return News::create($data);
    }

    public function show(News $news)
    {
        $comments = Comment::where('commentable_type', News::class)
            ->where('commentable_id', $news->id)
            ->with(['user', 'replies.user'])
            ->cursorPaginate(10);

        return response()->json([
            'news' => $news,
            'comments' => $comments,
        ]);
    }
}
