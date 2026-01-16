<?php

namespace App\Http\Controllers;

use App\DTO\ContentDTO;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;

class NewsController extends Controller
{
    public function index()
    {
        return NewsResource::collection(News::paginate(10));
    }

    public function store(StoreNewsRequest $request)
    {
        $data = ContentDTO::fromArray($request->validated());

        return News::create($data->toArray());
    }

    public function show(News $news)
    {
        $comments = Comment::where('commentable_type', News::class)
            ->where('commentable_id', $news->id)
            ->with(['user', 'replies.user'])
            ->cursorPaginate(10);

        $news->setRelation('comments', $comments);

        return NewsResource::make($news);
    }
}
