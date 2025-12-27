<?php

return [
    'name' => 'Task Manager',
    'env' => \Cymphone\Support\Env::get('APP_ENV', 'production'),
    'debug' => \Cymphone\Support\Env::get('APP_DEBUG', false) === 'true' || \Cymphone\Support\Env::get('APP_DEBUG', false) === true,
    'url' => \Cymphone\Support\Env::get('APP_URL', 'http://localhost'),
    'timezone' => 'Europe/Moscow',
];

