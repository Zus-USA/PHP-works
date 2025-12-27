<?php

namespace App\Repository;

use App\Entity\Task;

interface TaskRepositoryInterface
{
    public function findAll(): array;

    public function add(Task $task): void;
}

