<?php

return [
    'type' => env('REPOSITORY_TYPE', 'mysql'),
    'storage' => [
        'file' => storage_path('app/tasks.json'),
    ],
];
