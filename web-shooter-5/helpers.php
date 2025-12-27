<?php

if (!function_exists('route')) {
    function route(string $name, array $params = []): string
    {
        global $app;
        if (isset($app)) {
            $url = $app->getRouter()->url($name, $params);
            if ($url !== null) {
                return $url;
            }
        }
        return '#';
    }
}

if (!function_exists('asset')) {
    function asset(string $path): string
    {
        return '/' . ltrim($path, '/');
    }
}

if (!function_exists('csrf_token')) {
    function csrf_token(): string
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        if (!isset($_SESSION['_csrf_token'])) {
            $_SESSION['_csrf_token'] = bin2hex(random_bytes(32));
        }
        return $_SESSION['_csrf_token'];
    }
}

