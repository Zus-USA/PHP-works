<?php

declare(strict_types=1);
require_once __DIR__ . "/../vendor/autoload.php";

use App\Repository\InMemoryTaskRepository;
use App\Repository\FileTaskRepository;
use App\Repository\MySqlTaskRepository;
use App\Repository\TaskRepositoryInterface;
use App\Controller\TaskController;
use App\Container\Container;

// Загружаем конфигурацию
$config = require __DIR__ . '/../config.php';

$route = $_GET['route'] ?? 'task/list';

// Создаем контейнер зависимостей
$container = new Container();

// Регистрируем PDO подключение к БД
$container->set(PDO::class, function () use ($config) {
    $dbConfig = $config['db'];
    return new PDO(
        $dbConfig['dsn'],
        $dbConfig['user'],
        $dbConfig['pass'],
        $dbConfig['options']
    );
});

// Регистрируем FileTaskRepository
$container->set(FileTaskRepository::class, function () use ($config) {
    return new FileTaskRepository($config['storage']);
});

// Регистрируем MySqlTaskRepository
$container->set(MySqlTaskRepository::class, function (Container $c) {
    $pdo = $c->get(PDO::class);
    return new MySqlTaskRepository($pdo);
});

// Регистрируем InMemoryTaskRepository (для тестирования)
$container->set(InMemoryTaskRepository::class, function () {
    return new InMemoryTaskRepository();
});

// Привязываем интерфейс к конкретной реализации на основе конфига
$repositoryType = $config['repository'];
switch ($repositoryType) {
    case 'mysql':
        $container->set(TaskRepositoryInterface::class, function (Container $c) {
            return $c->get(MySqlTaskRepository::class);
        });
        break;
    case 'file':
        $container->set(TaskRepositoryInterface::class, function (Container $c) {
            return $c->get(FileTaskRepository::class);
        });
        break;
    case 'memory':
    default:
        $container->set(TaskRepositoryInterface::class, function (Container $c) {
            return $c->get(InMemoryTaskRepository::class);
        });
        break;
}

// Регистрируем контроллер
$container->set(TaskController::class, function (Container $c) {
    $repo = $c->get(TaskRepositoryInterface::class);
    return new TaskController($repo);
});

// Получаем контроллер и обрабатываем роут
try {
    $controller = $container->get(TaskController::class);

    switch ($route) {
        case 'task/list':
            $controller->list();
            break;
        case 'task/add':
            $controller->add();
            break;
        default:
            http_response_code(404);
            echo '404 not found';
    }
} catch (Exception $e) {
    http_response_code(500);
    echo 'Ошибка: ' . htmlspecialchars($e->getMessage());
    if (ini_get('display_errors')) {
        echo '<pre>' . htmlspecialchars($e->getTraceAsString()) . '</pre>';
    }
}