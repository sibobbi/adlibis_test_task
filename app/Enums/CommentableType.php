<?php

declare(strict_types=1);

namespace App\Enums;

enum CommentableType: string
{
    case NEWS = 'news';
    case VIDEO = 'video';
    case COMMENT = 'comment';

    public static function forRequest(): array
    {
        return array_map(static fn(CommentableType $case) => $case->value, self::cases());
    }
}
