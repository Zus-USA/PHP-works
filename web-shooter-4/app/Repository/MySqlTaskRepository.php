<?php

namespace App\Repository;

use App\Models\Task;

class MySqlTaskRepository implements TaskRepositoryInterface
{
    public function findAll(): array
    {
        return Task::query()
            ->orderBy('id', 'desc')
            ->get()
            ->all();
    }

    public function add(Task $task): void
    {
        $task->save();
    }
}
