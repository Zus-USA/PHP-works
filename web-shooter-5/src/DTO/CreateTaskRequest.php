<?php

namespace App\DTO;

class CreateTaskRequest
{
    public function __construct(
        private readonly string $title
    ) {
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public static function fromArray(array $data): self
    {
        return new self($data['title'] ?? '');
    }
}

