<?php

use Cymphone\Support\Env;

// Получаем абсолютный путь к корню проекта
$basePath = realpath(dirname(__DIR__)) ?: dirname(__DIR__);

return [
    'type' => Env::get('REPOSITORY_TYPE', 'file'),
    'storage' => [
        'file' => Env::get('STORAGE_FILE_PATH', $basePath . DIRECTORY_SEPARATOR . 'storage' . DIRECTORY_SEPARATOR . 'app' . DIRECTORY_SEPARATOR . 'tasks.json'),
    ],
];
