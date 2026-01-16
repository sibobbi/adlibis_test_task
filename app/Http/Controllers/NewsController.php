<?php

namespace App\Http\Controllers;

use App\DTO\ContentDTO;
use App\Http\Requests\StoreNewsRequest;
use App\Http\Resources\NewsResource;
use App\Models\Comment;
use App\Models\News;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class NewsController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        $collection = NewsResource::collection(News::paginate(10));

        return NewsResource::collection($collection);
    }

    public function store(StoreNewsRequest $request): NewsResource
    {
        $data = ContentDTO::fromArray($request->validated());

        return NewsResource::make(News::create($data->toArray()));
    }

    public function show(News $news): NewsResource
    {
        $comments = Comment::where('commentable_type', News::class)
            ->where('commentable_id', $news->id)
            ->with(['user', 'replies.user'])
            ->cursorPaginate(10);

        $news->setRelation('comments', $comments);

        return NewsResource::make($news);
    }
}
