<?php

use App\Http\Controllers\TaskController;
use Cymphone\Application;

/** @var Application $app */
$app = $GLOBALS['app'];
$router = $app->getRouter();

$router->get('/', function () use ($router) {
    return \Cymphone\Http\Response::make('')->redirect($router->url('task.list') ?: '/task/list');
});

$router->get('/task/list', [TaskController::class, 'list'], 'task.list');
$router->match(['get', 'post'], '/task/add', [TaskController::class, 'add'], 'task.add');

