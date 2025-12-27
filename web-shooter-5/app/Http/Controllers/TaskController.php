<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repository\TaskRepositoryInterface;
use Cymphone\Http\Request;
use Cymphone\Http\Response;
use Cymphone\Validation\Validator;
use Cymphone\View\View;

class TaskController extends Controller
{
    private TaskRepositoryInterface $repository;

    public function __construct(TaskRepositoryInterface $repository)
    {
        $this->repository = $repository;
    }

    public function list(Request $request): Response
    {
        try {
            $tasks = $this->repository->findAll();
            $success = $request->getFlash('success');
            $error = $request->getFlash('error');
            
            $content = View::make('task.list', [
                'tasks' => $tasks,
                'success' => $success,
                'error' => $error,
            ]);
            
            return Response::make($content);
        } catch (\Throwable $e) {
            return Response::make('Ошибка при загрузке задач: ' . $e->getMessage(), 500);
        }
    }

    public function add(Request $request): Response
    {
        if ($request->isMethod('post')) {
            // Проверка CSRF токена
            $token = $request->input('_token');
            if (!$this->validateCsrfToken($token)) {
                $content = View::make('task.add', [
                    'errors' => ['_token' => ['Неверный токен безопасности. Пожалуйста, обновите страницу.']],
                    'old' => $request->all(),
                ]);
                
                return Response::make($content);
            }

            $validator = new Validator($request, [
                'title' => 'required|string|min:3|max:255',
            ]);

            if (!$validator->validate()) {
                $content = View::make('task.add', [
                    'errors' => $validator->errors(),
                    'old' => $request->all(),
                ]);
                
                return Response::make($content);
            }

            try {
                $task = new Task();
                $task->setAttribute('title', trim($request->input('title')));
                $task->setAttribute('completed', false);
                
                $this->repository->add($task);

                $request->flash('success', 'Задача успешно добавлена!');
                
                return Response::make('')->redirect('/task/list');
            } catch (\Throwable $e) {
                $request->flash('error', 'Ошибка при добавлении задачи: ' . $e->getMessage());
                return Response::make('')->redirect('/task/list');
            }
        }

        $content = View::make('task.add', [
            'errors' => [],
            'old' => [],
        ]);
        
        return Response::make($content);
    }

    private function validateCsrfToken(?string $token): bool
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        
        $sessionToken = $_SESSION['_csrf_token'] ?? null;
        return $token !== null && $sessionToken !== null && hash_equals($sessionToken, $token);
    }
}

