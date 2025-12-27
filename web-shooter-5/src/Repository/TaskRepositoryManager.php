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
            try {
                $this->repository = $this->createRepository();
            } catch (\Throwable $e) {
                // Если произошла ошибка при создании репозитория (например, проблема с подключением к БД),
                // автоматически переключаемся на файловый репозиторий
                error_log('Ошибка при создании репозитория, используется файловый репозиторий: ' . $e->getMessage());
                $this->repository = new FileTaskRepository($this->storagePath);
            }
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
     * Если подключение недоступно, автоматически переключается на файловый репозиторий
     */
    private function createMySqlRepository(): TaskRepositoryInterface
    {
        if ($this->connection === null) {
            // Если подключение не предоставлено, используем файловый репозиторий
            return new FileTaskRepository($this->storagePath);
        }

        try {
            // Пытаемся проверить подключение, не вызывая connect() явно
            // Если подключение не установлено, Doctrine попытается подключиться автоматически
            // при первом запросе, но мы можем проверить это здесь
            if (!$this->connection->isConnected()) {
                // Пытаемся подключиться
                $this->connection->connect();
            }
            return new MySqlTaskRepository($this->connection);
        } catch (\Throwable $e) {
            // Если подключение недоступно, используем файловый репозиторий как fallback
            // Логируем ошибку для отладки, но не прерываем выполнение
            error_log('Не удалось подключиться к базе данных, используется файловый репозиторий: ' . $e->getMessage());
            return new FileTaskRepository($this->storagePath);
        }
    }

    /**
     * Определить тип репозитория из окружения
     */
    private function getRepositoryType(): string
    {
        return $_ENV['REPOSITORY_TYPE'] ?? $_SERVER['REPOSITORY_TYPE'] ?? self::TYPE_FILE;
    }
}

