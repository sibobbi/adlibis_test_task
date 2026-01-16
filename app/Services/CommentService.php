<?php

namespace App\Services;

use App\DTO\CommentDTO;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CommentService
{
    public function store(CommentDTO $data)
    {
        $model = match ($data->commentableType) {
            'news' => new News(),
            'video' => new VideoPost(),
            'comment' => new Comment(),
            default => throw new UnprocessableEntityHttpException('Invalid commentable_type')
        };

        $model = $model->findOrFail($data->commentableId);

        return $model->comments()->create([
            'user_id' => $data->userId,
            'content' => $data->content,
        ]);
    }
}
