<?php

namespace App\Repository;

use App\Entity\Task;

class FileTaskRepository implements TaskRepositoryInterface
{
    private const JSON_FLAGS = JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES;

    public function __construct(
        private readonly string $storagePath
    ) {
        $this->ensureStorageDirectoryExists();
    }

    public function findAll(): array
    {
        if (!$this->fileExists() || $this->isFileEmpty()) {
            return [];
        }

        $content = $this->readFile();
        
        if ($content === null || trim($content) === '') {
            return [];
        }

        $data = json_decode($content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return [];
        }

        return $this->hydrateTasks($data);
    }

    public function add(Task $task): void
    {
        $tasks = $this->findAll();
        
        // Генерируем новый ID
        $maxId = $this->getMaxId($tasks);
        $task->setId($maxId + 1);
        
        // Устанавливаем дату создания, если не установлена
        if ($task->getCreatedAt() === null) {
            $task->setCreatedAt(new \DateTime());
        }
        
        $tasks[] = $task;
        $this->saveTasks($tasks);
    }

    /**
     * Проверяет существование директории для хранения
     */
    private function ensureStorageDirectoryExists(): void
    {
        $dir = dirname($this->storagePath);
        if (!is_dir($dir) && !mkdir($dir, 0755, true) && !is_dir($dir)) {
            throw new \RuntimeException("Не удалось создать директорию для хранения: {$dir}");
        }
    }

    /**
     * Проверяет существование файла
     */
    private function fileExists(): bool
    {
        return file_exists($this->storagePath);
    }

    /**
     * Проверяет, пуст ли файл
     */
    private function isFileEmpty(): bool
    {
        return filesize($this->storagePath) === 0;
    }

    /**
     * Читает содержимое файла с блокировкой
     */
    private function readFile(): ?string
    {
        $handle = fopen($this->storagePath, 'r');
        if ($handle === false) {
            return null;
        }

        try {
            if (!flock($handle, LOCK_SH)) {
                fclose($handle);
                return null;
            }

            $content = file_get_contents($this->storagePath);
            flock($handle, LOCK_UN);
            
            return $content !== false ? $content : null;
        } finally {
            fclose($handle);
        }
    }

    /**
     * Преобразует массив данных в массив объектов Task
     */
    private function hydrateTasks(array $data): array
    {
        $tasks = [];
        
        foreach ($data as $item) {
            if (!isset($item['title']) || !is_string($item['title'])) {
                continue;
            }
            
            $tasks[] = Task::fromArray($item);
        }

        return $tasks;
    }

    /**
     * Получает максимальный ID из списка задач
     */
    private function getMaxId(array $tasks): int
    {
        $maxId = 0;
        
        foreach ($tasks as $task) {
            $id = $task->getId();
            if ($id !== null && $id > $maxId) {
                $maxId = $id;
            }
        }
        
        return $maxId;
    }

    /**
     * Сохраняет список задач в файл
     */
    private function saveTasks(array $tasks): void
    {
        $data = array_map(fn(Task $task) => $task->toArray(), $tasks);

        $handle = fopen($this->storagePath, 'c+');
        if ($handle === false) {
            throw new \RuntimeException("Не удалось открыть файл для записи: {$this->storagePath}");
        }

        try {
            if (!flock($handle, LOCK_EX)) {
                throw new \RuntimeException("Не удалось заблокировать файл для записи: {$this->storagePath}");
            }

            ftruncate($handle, 0);
            rewind($handle);

            $json = json_encode($data, self::JSON_FLAGS);
            
            if ($json === false) {
                throw new \RuntimeException("Ошибка кодирования JSON: " . json_last_error_msg());
            }

            $written = fwrite($handle, $json);
            if ($written === false) {
                throw new \RuntimeException("Ошибка записи в файл: {$this->storagePath}");
            }

            fflush($handle);
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}

