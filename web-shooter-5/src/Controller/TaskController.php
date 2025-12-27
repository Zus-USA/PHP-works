<?php

namespace App\Controller;

use App\DTO\CreateTaskRequest;
use App\Service\TaskService;
use App\Validator\TaskValidator;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TaskController extends AbstractController
{
    public function __construct(
        private readonly TaskService $taskService,
        private readonly TaskValidator $validator
    ) {
    }

    #[Route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->redirectToRoute('task_list');
    }

    #[Route('/task/list', name: 'task_list')]
    public function list(Request $request): Response
    {
        try {
            $tasks = $this->taskService->getAllTasks();
            
            $flashBag = $request->getSession()->getFlashBag();
            $success = $flashBag->get('success', []);
            $error = $flashBag->get('error', []);

            return $this->render('task/list.html.twig', [
                'tasks' => $tasks,
                'success' => !empty($success) ? $success[0] : null,
                'error' => !empty($error) ? $error[0] : null,
            ]);
        } catch (\Throwable $e) {
            $request->getSession()->getFlashBag()->add('error', 'Ошибка при загрузке задач: ' . $e->getMessage());
            
            return $this->render('task/list.html.twig', [
                'tasks' => [],
                'success' => null,
                'error' => 'Ошибка при загрузке задач: ' . $e->getMessage(),
            ]);
        }
    }

    #[Route('/task/add', name: 'task_add', methods: ['GET', 'POST'])]
    public function add(Request $request): Response
    {
        if (!$request->isMethod('POST')) {
            return $this->render('task/add.html.twig', [
                'errors' => [],
                'old' => [],
            ]);
        }

        $title = $request->request->get('title', '');
        $validationResult = $this->validator->validateTitle($title);

        if ($validationResult->hasErrors()) {
            return $this->render('task/add.html.twig', [
                'errors' => $validationResult->getErrorsByField(),
                'old' => ['title' => $title],
            ]);
        }

        try {
            $this->taskService->createTask($title);
            $request->getSession()->getFlashBag()->add('success', 'Задача успешно добавлена!');
            
            return $this->redirectToRoute('task_list');
        } catch (\Throwable $e) {
            $request->getSession()->getFlashBag()->add('error', 'Ошибка при добавлении задачи: ' . $e->getMessage());
            
            return $this->render('task/add.html.twig', [
                'errors' => ['title' => ['Произошла ошибка при сохранении задачи']],
                'old' => ['title' => $title],
            ]);
        }
    }
}

