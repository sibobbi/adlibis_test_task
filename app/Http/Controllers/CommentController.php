<?php

namespace App\Http\Controllers;

use App\DTO\CommentDTO;
use App\Http\Requests\StoreCommentRequest;
use App\Http\Resources\CommentResource;
use App\Models\Comment;
use App\Action\CommentService;
use Illuminate\Http\Request;

class CommentController extends Controller
{
    public function store(StoreCommentRequest $request, CommentService $commentService): CommentResource
    {
        $dto = CommentDTO::fromArray($request->validated(), $request->user()->id, $request->commentableTypeEnum());

        return CommentResource::make($commentService->store($dto));
    }

    public function update(Comment $comment, Request $request): CommentResource
    {

        $dto = CommentDTO::contentOnly($request->get('content'));

        $comment->update(['content' => $dto->content]);

        return CommentResource::make($comment);
    }

    public function destroy(Comment $comment): \Illuminate\Http\Response
    {
        $comment->delete();

        return response()->noContent();
    }
}
