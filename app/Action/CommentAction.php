<?php

namespace App\Action;

use App\DTO\CommentDTO;
use App\Enums\CommentableType;
use App\Http\Requests\StoreCommentRequest;
use App\Models\Comment;
use App\Models\News;
use App\Models\VideoPost;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\HttpKernel\Exception\UnprocessableEntityHttpException;

class CommentAction
{
    public function store(CommentDTO $data)
    {
        $model = match ($data->commentableType) {
            CommentableType::NEWS => new News(),
            CommentableType::VIDEO => new VideoPost(),
            CommentableType::COMMENT => new Comment(),
            default => throw new UnprocessableEntityHttpException('Invalid commentable_type')
        };

        $model = $model->findOrFail($data->commentableId);

        return $model->comments()->create([
            'user_id' => $data->userId,
            'content' => $data->content,
        ]);
    }
}
