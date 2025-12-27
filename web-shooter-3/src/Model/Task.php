<?php

namespace App\Model;

class Task
{
    private string $title;
    private bool $completed = false;

    public function __construct(string $title)
    {
        $this->title = $title;
    }

    public function getTitle(): string
    {
        return $this->title;
    }
    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function isCompleted(): bool
    {
        return $this->completed;
    }

    public function complete(): void {
        $this->completed = true;
    }
}