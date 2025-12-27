<?php

declare(strict_types=1);

/**
 * Загружает переменные из .env файла
 */
function loadEnv(string $envPath): void
{
    if (!file_exists($envPath)) {
        return;
    }

    $lines = file($envPath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
    
    foreach ($lines as $line) {
        // Пропускаем комментарии
        if (strpos(trim($line), '#') === 0) {
            continue;
        }

        // Разбиваем строку на ключ и значение
        if (strpos($line, '=') === false) {
            continue;
        }

        list($key, $value) = explode('=', $line, 2);
        $key = trim($key);
        $value = trim($value);
        
        // Убираем кавычки, если есть
        $value = trim($value, '"\'');
        
        // Устанавливаем переменную окружения (всегда перезаписываем из .env)
        putenv("$key=$value");
        $_ENV[$key] = $value;
    }
}

// Загружаем переменные из .env файла
loadEnv(__DIR__ . '/.env');

return [
    'db' => [
        'user' => getenv('DB_USER') ?: 'root',             
        'dsn' => 'mysql:host=' . (getenv('DB_HOST') ?: 'localhost') . ';dbname=' . (getenv('DB_NAME') ?: 'taskapp') . ';charset=utf8mb4', 
        'pass' => getenv('DB_PASS') ?: '',                  
        'options' => [                 
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES => false,
        ]
    ],
    'storage' => __DIR__ . '/' . (getenv('STORAGE_PATH') ?: 'storage/tasks.json'),  
    'repository' => getenv('REPOSITORY_TYPE') ?: 'file',  // Тип репозитория: 'file' или 'mysql'
];

