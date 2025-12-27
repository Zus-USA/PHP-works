<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Task;
use PDO;

/**
 * Репозиторий для хранения задач в MySQL базе данных
 * Использует PDO с подготовленными выражениями
 */
class MySqlTaskRepository implements TaskRepositoryInterface
{
    private PDO $pdo;

    public function __construct(PDO $pdo)
    {
        $this->pdo = $pdo;
    }

    /**
     * Получить все задачи из БД
     * @return Task[]
     */
    public function findAll(): array
    {
        $sql = "SELECT title, completed FROM tasks ORDER BY id DESC";
        
        try {
            $stmt = $this->pdo->query($sql);
            $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            
            $tasks = [];
            foreach ($rows as $row) {
                $task = new Task($row['title']);
                if ((bool)$row['completed']) {
                    $task->complete();
                }
                $tasks[] = $task;
            }
            
            return $tasks;
        } catch (\PDOException $e) {
            throw new \RuntimeException("Ошибка при получении задач из БД: " . $e->getMessage(), 0, $e);
        }
    }

    /**
     * Добавить новую задачу в БД
     * @param Task $task
     * @return void
     */
    public function add(Task $task): void
    {
        $sql = "INSERT INTO tasks (title, completed) VALUES (:title, :completed)";
        
        try {
            $stmt = $this->pdo->prepare($sql);
            $stmt->execute([
                ':title' => $task->getTitle(),
                ':completed' => $task->isCompleted() ? 1 : 0,
            ]);
        } catch (\PDOException $e) {
            throw new \RuntimeException("Ошибка при добавлении задачи в БД: " . $e->getMessage(), 0, $e);
        }
    }
}

