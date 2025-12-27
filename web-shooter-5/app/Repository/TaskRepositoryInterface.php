<?php

namespace App\Repository;

use App\Models\Task;

interface TaskRepositoryInterface
{
    public function findAll(): array;

    public function add(Task $task): void;
}

