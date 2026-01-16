<?php

namespace App\Http\Controllers;

use App\DTO\CommentDTO;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;
use App\Services\CommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, CommentService $storeCommentService)
    {
        $dto = CommentDTO::fromArray($request->validated(), $request->user()->id);

        return $storeCommentService->store($dto);
    }

    public function update(Comment $comment, Request $request)
    {

        $dto = CommentDTO::contentOnly($request->get('content'));

        $comment->update(['content' => $dto->content]);

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}
