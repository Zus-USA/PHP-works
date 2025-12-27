<?php

namespace App\Repository;

use App\Entity\Task;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception;

class MySqlTaskRepository implements TaskRepositoryInterface
{
    private const TABLE_NAME = 'tasks';

    public function __construct(
        private readonly Connection $connection
    ) {
    }

    public function findAll(): array
    {
        try {
            $sql = 'SELECT id, title, completed, created_at FROM ' . self::TABLE_NAME . ' ORDER BY id DESC';
            $rows = $this->connection->fetchAllAssociative($sql);
            
            return $this->hydrateTasks($rows);
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка при получении задач из базы данных: ' . $e->getMessage(), 0, $e);
        }
    }

    public function add(Task $task): void
    {
        try {
            $now = new \DateTime();
            $createdAt = $task->getCreatedAt() ?? $now;
            
            $this->connection->insert(self::TABLE_NAME, [
                'title' => $task->getTitle(),
                'completed' => $task->isCompleted() ? 1 : 0,
                'created_at' => $createdAt->format('Y-m-d H:i:s'),
                'updated_at' => $now->format('Y-m-d H:i:s'),
            ]);

            // Получаем ID вставленной записи
            $id = (int)$this->connection->lastInsertId();
            $task->setId($id);
        } catch (Exception $e) {
            throw new \RuntimeException('Ошибка при добавлении задачи в базу данных: ' . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Преобразует строки из БД в объекты Task
     */
    private function hydrateTasks(array $rows): array
    {
        $tasks = [];
        
        foreach ($rows as $row) {
            $task = new Task();
            $task->setId((int)$row['id']);
            $task->setTitle($row['title']);
            $task->setCompleted((bool)$row['completed']);
            
            if (!empty($row['created_at'])) {
                $task->setCreatedAt(new \DateTime($row['created_at']));
            }
            
            $tasks[] = $task;
        }
        
        return $tasks;
    }
}

