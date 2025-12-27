<?php

namespace App\Repository;

use App\Models\Task;

class FileTaskRepository implements TaskRepositoryInterface
{
    private string $storagePath;

    public function __construct(string $storagePath)
    {
        $this->storagePath = $storagePath;
        
        $dir = dirname($storagePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    public function findAll(): array
    {
        if (!file_exists($this->storagePath) || filesize($this->storagePath) === 0) {
            return [];
        }

        $handle = fopen($this->storagePath, 'r');
        if ($handle === false) {
            return [];
        }

        flock($handle, LOCK_SH);
        $content = file_get_contents($this->storagePath);
        flock($handle, LOCK_UN);
        fclose($handle);

        if ($content === false || trim($content) === '') {
            return [];
        }

        $data = json_decode($content, true);
        
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return [];
        }

        $tasks = [];
        foreach ($data as $item) {
            if (isset($item['title'])) {
                $task = new Task();
                $task->setAttribute('title', $item['title']);
                $task->setAttribute('completed', isset($item['completed']) ? (bool)$item['completed'] : false);
                if (isset($item['id'])) {
                    $task->setAttribute('id', $item['id']);
                }
                if (isset($item['created_at'])) {
                    $task->setAttribute('created_at', $item['created_at']);
                }
                $task->exists = true;
                $tasks[] = $task;
            }
        }

        return $tasks;
    }

    public function add(Task $task): void
    {
        $tasks = $this->findAll();
        
        $maxId = 0;
        foreach ($tasks as $t) {
            $id = $t->getAttribute('id');
            if ($id && $id > $maxId) {
                $maxId = $id;
            }
        }
        
        $task->setAttribute('id', $maxId + 1);
        $task->setAttribute('created_at', date('Y-m-d H:i:s'));
        $tasks[] = $task;

        $data = [];
        foreach ($tasks as $taskItem) {
            $data[] = [
                'id' => $taskItem->getAttribute('id') ?? null,
                'title' => $taskItem->getAttribute('title'),
                'completed' => $taskItem->getAttribute('completed') ?? false,
                'created_at' => $taskItem->getAttribute('created_at') ?? date('Y-m-d H:i:s'),
            ];
        }

        $handle = fopen($this->storagePath, 'c+');
        if ($handle === false) {
            throw new \RuntimeException("Не удалось открыть файл для записи: {$this->storagePath}");
        }

        if (!flock($handle, LOCK_EX)) {
            fclose($handle);
            throw new \RuntimeException("Не удалось заблокировать файл для записи: {$this->storagePath}");
        }

        try {
            ftruncate($handle, 0);
            rewind($handle);

            $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            
            if ($json === false) {
                throw new \RuntimeException("Ошибка кодирования JSON: " . json_last_error_msg());
            }

            fwrite($handle, $json);
            fflush($handle);
        } finally {
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}

