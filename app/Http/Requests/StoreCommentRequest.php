<?php

namespace App\Http\Requests;

use App\Enums\CommentableType;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreCommentRequest extends FormRequest
{

    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'content' => ['required', 'string'],
            'commentable_id' => ['required', 'integer'],

            'commentable_type' => [
                'required',
                'string',
                Rule::in(CommentableType::forRequest()),
            ],
        ];
    }

    public function commentableTypeEnum(): CommentableType
    {
        return CommentableType::from($this->input('commentable_type'));
    }
}
