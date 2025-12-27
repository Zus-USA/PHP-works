<?php

namespace App\Repository;

use Doctrine\DBAL\Connection;

class TaskRepositoryManager
{
    private const TYPE_FILE = 'file';
    private const TYPE_MYSQL = 'mysql';

    private ?TaskRepositoryInterface $repository = null;

    public function __construct(
        private readonly string $storagePath,
        private readonly ?Connection $connection = null
    ) {
    }

    /**
     * Получить репозиторий
     */
    public function getRepository(): TaskRepositoryInterface
    {
        if ($this->repository === null) {
            $this->repository = $this->createRepository();
        }

        return $this->repository;
    }

    /**
     * Создать репозиторий на основе конфигурации
     */
    private function createRepository(): TaskRepositoryInterface
    {
        $type = $this->getRepositoryType();

        return match ($type) {
            self::TYPE_FILE => new FileTaskRepository($this->storagePath),
            self::TYPE_MYSQL => $this->createMySqlRepository(),
            default => throw new \RuntimeException("Неизвестный тип репозитория: {$type}"),
        };
    }

    /**
     * Создать MySQL репозиторий
     */
    private function createMySqlRepository(): MySqlTaskRepository
    {
        if ($this->connection === null) {
            throw new \RuntimeException('Для MySQL репозитория требуется подключение к базе данных');
        }

        return new MySqlTaskRepository($this->connection);
    }

    /**
     * Определить тип репозитория из окружения
     */
    private function getRepositoryType(): string
    {
        return $_ENV['REPOSITORY_TYPE'] ?? $_SERVER['REPOSITORY_TYPE'] ?? self::TYPE_FILE;
    }
}

