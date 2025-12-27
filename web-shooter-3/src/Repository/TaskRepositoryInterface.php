<?php

namespace App\Repository;

use App\Model\Task;

interface TaskRepositoryInterface
{
    /**
     * Получить все задачи
     * @return Task[]
     */
    public function findAll(): array;

    /**
     * Добавить новую задачу
     * @param Task $task
     * @return void
     */
    public function add(Task $task): void;
}