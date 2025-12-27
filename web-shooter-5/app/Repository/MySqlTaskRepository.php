<?php

namespace App\Repository;

use App\Models\Task;
use Cymphone\Database\Database;

class MySqlTaskRepository implements TaskRepositoryInterface
{
    public function findAll(): array
    {
        $rows = Database::select('SELECT id, title, completed, created_at FROM tasks ORDER BY id DESC');
        
        $tasks = [];
        foreach ($rows as $row) {
            $task = new Task();
            $task->setAttribute('id', $row->id);
            $task->setAttribute('title', $row->title);
            $task->setAttribute('completed', (bool)$row->completed);
            $task->setAttribute('created_at', $row->created_at ?? null);
            $task->exists = true;
            $tasks[] = $task;
        }
        
        return $tasks;
    }

    public function add(Task $task): void
    {
        Database::insert(
            'INSERT INTO tasks (title, completed, created_at, updated_at) VALUES (?, ?, NOW(), NOW())',
            [
                $task->title,
                $task->completed ? 1 : 0,
            ]
        );
    }
}

