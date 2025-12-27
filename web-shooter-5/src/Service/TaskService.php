<?php

namespace App\Service;

use App\Entity\Task;
use App\Repository\TaskRepositoryInterface;

class TaskService
{
    public function __construct(
        private readonly TaskRepositoryInterface $repository
    ) {
    }

    /**
     * Получить все задачи
     */
    public function getAllTasks(): array
    {
        return $this->repository->findAll();
    }

    /**
     * Создать новую задачу
     */
    public function createTask(string $title): Task
    {
        $task = new Task();
        $task->setTitle(trim($title));
        $task->setCompleted(false);
        $task->setCreatedAt(new \DateTime());
        
        $this->repository->add($task);
        
        return $task;
    }
}

