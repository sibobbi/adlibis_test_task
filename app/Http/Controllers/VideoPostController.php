<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreVideoPostRequest;
use App\Http\Resources\VideoPostResource;
use App\Models\Comment;
use App\Models\VideoPost;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\AnonymousResourceCollection;

class VideoPostController extends Controller
{
    public function index(): AnonymousResourceCollection
    {
        return VideoPostResource::collection(VideoPost::paginate(10));
    }

    public function store(StoreVideoPostRequest $request): VideoPostResource
    {
        $data = $request->validated();

        return VideoPostResource::make(VideoPost::create($data));
    }

    public function show(VideoPost $video): VideoPostResource
    {
        $comments = Comment::where('commentable_type', VideoPost::class)
            ->where('commentable_id', $video->id)
            ->with(['user', 'replies.user'])
            ->cursorPaginate(10);

        $video->setRelation('comments', $comments);

        return VideoPostResource::make($video);
    }
}
