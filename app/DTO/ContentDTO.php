<?php

namespace App\DTO;

class ContentDTO
{
    public function __construct(
        public string $title,
        public string $description,
    ) {}

    public static function fromArray(array $array): self
    {
        return new self(
            title: (string) $array['title'],
            description: (string)  $array['description'],
        );
    }
    public function toArray(): array
    {
        return [
            'title' => $this->title,
            'description' => $this->description,
        ];
    }
}
