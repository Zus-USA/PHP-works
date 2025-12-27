<?php

namespace App\Repository;

use App\Models\Task;
use Carbon\Carbon;

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

        $content = file_get_contents($this->storagePath);
        
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
                $task->title = $item['title'];
                $task->completed = isset($item['completed']) ? (bool)$item['completed'] : false;
                
                if (isset($item['id'])) {
                    $task->id = $item['id'];
                }
                
                if (isset($item['created_at'])) {
                    $task->created_at = is_string($item['created_at']) 
                        ? Carbon::parse($item['created_at']) 
                        : $item['created_at'];
                }
                
                if (isset($item['updated_at'])) {
                    $task->updated_at = is_string($item['updated_at']) 
                        ? Carbon::parse($item['updated_at']) 
                        : $item['updated_at'];
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
        
        $task->id = $maxId + 1;
        $task->created_at = now();
        $task->updated_at = now();
        $tasks[] = $task;

        $data = [];
        foreach ($tasks as $taskItem) {
            $createdAt = $taskItem->getAttribute('created_at');
            $updatedAt = $taskItem->getAttribute('updated_at');
            
            $data[] = [
                'id' => $taskItem->getAttribute('id'),
                'title' => $taskItem->getAttribute('title'),
                'completed' => $taskItem->getAttribute('completed') ?? false,
                'created_at' => $createdAt instanceof Carbon 
                    ? $createdAt->toDateTimeString() 
                    : ($createdAt ?? now()->toDateTimeString()),
                'updated_at' => $updatedAt instanceof Carbon 
                    ? $updatedAt->toDateTimeString() 
                    : ($updatedAt ?? now()->toDateTimeString()),
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
