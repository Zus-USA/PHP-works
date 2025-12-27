<?php

namespace App\Controller;

use App\Model\Task;
use App\Repository\TaskRepositoryInterface;

class TaskController {

    private TaskRepositoryInterface $repository;
    private array $tasks;

    public function __construct(TaskRepositoryInterface $repository){
        $this->repository = $repository;
    }

    public function list() {
        require __DIR__ . '/../View/task_list.php';
    }

    /**
     * Обработка добавления задачи
     * GET - показывает форму, POST - обрабатывает отправку формы
     */
    public function add(): void
    {
        // Если это POST запрос, обрабатываем отправку формы
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $title = trim($_POST['title'] ?? '');
            
            // Валидация
            if (empty($title)) {
                $error = 'Название задачи не может быть пустым';
                require __DIR__ . '/../View/task_add.php';
                return;
            }
            
            // Создаем и добавляем задачу
            $task = new Task($title);
            $this->repository->add($task);
            
            // Редирект на список задач
            header('Location: ?route=task/list');
            exit;
        }
        
        // GET запрос - показываем форму
        require __DIR__ . '/../View/task_add.php';
    }

    public function getTasks()  {
        return $this->repository->findAll();
    }
}