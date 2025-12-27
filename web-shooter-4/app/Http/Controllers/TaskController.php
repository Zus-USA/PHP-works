<?php

namespace App\Http\Controllers;

use App\Models\Task;
use App\Repository\TaskRepositoryInterface;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class TaskController 
{
    public function __construct(
        private readonly TaskRepositoryInterface $repository
    ) {}

    public function list(): View
    {
        $tasks = $this->repository->findAll();
        
        return view('task.list', compact('tasks'));
    }

    public function add(Request $request): View|RedirectResponse
    {
        if ($request->isMethod('post')) {
            $validated = $request->validate([
                'title' => ['required', 'string', 'max:255'],
            ]);

            $task = new Task();
            $task->title = $validated['title'];
            $task->completed = false;
            
            $this->repository->add($task);

            return redirect()
                ->route('task.list')
                ->with('success', 'Задача успешно добавлена!');
        }

        return view('task.add');
    }
}
