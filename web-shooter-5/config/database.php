<?php

use Cymphone\Support\Env;

return [
    'default' => Env::get('DB_CONNECTION', 'mysql'),
    'connections' => [
        'mysql' => [
            'host' => Env::get('DB_HOST', '127.0.0.1'),
            'port' => Env::get('DB_PORT', '3306'),
            'database' => Env::get('DB_DATABASE', 'task_manager'),
            'username' => Env::get('DB_USERNAME', 'root'),
            'password' => Env::get('DB_PASSWORD', ''),
            'charset' => Env::get('DB_CHARSET', 'utf8mb4'),
        ],
    ],
];

