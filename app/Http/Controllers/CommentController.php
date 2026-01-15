<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;
use App\Services\StoreCommentService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(
        StoreCommentRequest $request,
        StoreCommentService $storeCommentService
    )
    {
        $data = $request->validated();

        return $storeCommentService->storeComment($data);
    }

    public function update(Comment $comment, Request $request)
    {
        $comment->update($request->validate([
            'content' => 'required|string',
        ]));

        return $comment;
    }

    public function destroy(Comment $comment)
    {
        $comment->delete();

        return response()->noContent();
    }
}
