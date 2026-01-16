<?php

namespace App\DTO;

use App\Enums\CommentableType;

readonly class CommentDTO
{
    public function __construct(
        public ?CommentableType $commentableType,
        public ?int    $commentableId,
        public string $content,
        public ?int    $userId,
    ) {}

    public static function fromArray(array $data,int $userId, CommentableType $type): self
    {
        return new self(
            commentableType: $type,
            commentableId: (int) $data['commentable_id'],
            content: (string) $data['content'],
            userId: (int) $userId,
        );
    }
    public static function contentOnly(string $content): self
    {
        return new self(
            commentableType: null,
            commentableId: null,
            content: $content,
            userId: null,
        );
    }
}
