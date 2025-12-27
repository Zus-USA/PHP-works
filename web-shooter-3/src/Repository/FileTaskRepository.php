<?php

declare(strict_types=1);

namespace App\Repository;

use App\Model\Task;

/**
 * Репозиторий для хранения задач в JSON файле
 * Использует flock() для блокировки файла при записи
 */
class FileTaskRepository implements TaskRepositoryInterface
{
    private string $storagePath;

    public function __construct(string $storagePath)
    {
        $this->storagePath = $storagePath;
        
        // Создаем директорию, если её нет
        $dir = dirname($storagePath);
        if (!is_dir($dir)) {
            mkdir($dir, 0777, true);
        }
    }

    /**
     * Получить все задачи из JSON файла
     * @return Task[]
     */
    public function findAll(): array
    {
        // Если файл не существует или пустой, возвращаем пустой массив
        if (!file_exists($this->storagePath) || filesize($this->storagePath) === 0) {
            return [];
        }

        // Читаем файл с блокировкой на чтение
        $handle = fopen($this->storagePath, 'r');
        if ($handle === false) {
            return [];
        }

        // Блокируем файл для чтения (LOCK_SH - shared lock)
        flock($handle, LOCK_SH);
        $content = file_get_contents($this->storagePath);
        flock($handle, LOCK_UN);
        fclose($handle);

        if ($content === false || trim($content) === '') {
            return [];
        }

        // Декодируем JSON
        $data = json_decode($content, true);
        
        // Если JSON поврежден или невалиден, возвращаем пустой массив
        if (json_last_error() !== JSON_ERROR_NONE || !is_array($data)) {
            return [];
        }

        // Преобразуем данные в массив Task объектов
        $tasks = [];
        foreach ($data as $item) {
            if (isset($item['title'])) {
                $task = new Task($item['title']);
                if (isset($item['completed']) && $item['completed']) {
                    $task->complete();
                }
                $tasks[] = $task;
            }
        }

        return $tasks;
    }

    /**
     * Добавить новую задачу и сохранить в JSON файл
     * @param Task $task
     * @return void
     */
    public function add(Task $task): void
    {
        // Получаем существующие задачи
        $tasks = $this->findAll();
        
        // Добавляем новую задачу
        $tasks[] = $task;

        // Подготавливаем данные для сохранения
        $data = [];
        foreach ($tasks as $taskItem) {
            $data[] = [
                'title' => $taskItem->getTitle(),
                'completed' => $taskItem->isCompleted(),
            ];
        }

        // Открываем файл для записи с блокировкой
        $handle = fopen($this->storagePath, 'c+');
        if ($handle === false) {
            throw new \RuntimeException("Не удалось открыть файл для записи: {$this->storagePath}");
        }

        // Блокируем файл для записи (LOCK_EX - exclusive lock)
        if (!flock($handle, LOCK_EX)) {
            fclose($handle);
            throw new \RuntimeException("Не удалось заблокировать файл для записи: {$this->storagePath}");
        }

        try {
            // Обрезаем файл до нуля (очищаем)
            ftruncate($handle, 0);
            rewind($handle);

            // Записываем JSON с форматированием и UTF-8 кодировкой
            $json = json_encode($data, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES);
            
            if ($json === false) {
                throw new \RuntimeException("Ошибка кодирования JSON: " . json_last_error_msg());
            }

            fwrite($handle, $json);
            fflush($handle); // Принудительно записываем на диск
        } finally {
            // Снимаем блокировку
            flock($handle, LOCK_UN);
            fclose($handle);
        }
    }
}

