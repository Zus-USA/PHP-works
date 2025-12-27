<?php

use App\Http\Controllers\TaskController;
use App\Repository\FileTaskRepository;
use App\Repository\MySqlTaskRepository;
use App\Repository\TaskRepositoryInterface;
use Cymphone\Application;

$app = new Application();
$container = $app->getContainer();

// Загрузка конфигурации
$repositoryConfig = require __DIR__ . '/../config/repository.php';
$repositoryType = $repositoryConfig['type'] ?? 'file';

// Регистрация репозитория
if ($repositoryType === 'file') {
    $storagePath = $repositoryConfig['storage']['file'] ?? __DIR__ . '/../storage/app/tasks.json';
    $container->singleton(TaskRepositoryInterface::class, function () use ($storagePath) {
        return new FileTaskRepository($storagePath);
    });
} else {
    $container->singleton(TaskRepositoryInterface::class, function () {
        return new MySqlTaskRepository();
    });
}

// Регистрация контроллеров с зависимостями
$container->bind(TaskController::class, function ($container) {
    $repository = $container->make(TaskRepositoryInterface::class);
    return new TaskController($repository);
});

return $app;

