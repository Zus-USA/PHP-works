<?php

namespace Cymphone\Routing;

use Cymphone\Http\Request;
use Cymphone\Http\Response;

class Router
{
    private array $routes = [];

    public function get(string $uri, $action, ?string $name = null): void
    {
        $this->addRoute(['GET'], $uri, $action, $name);
    }

    public function post(string $uri, $action, ?string $name = null): void
    {
        $this->addRoute(['POST'], $uri, $action, $name);
    }

    public function match(array $methods, string $uri, $action, ?string $name = null): void
    {
        $this->addRoute($methods, $uri, $action, $name);
    }

    private function addRoute(array $methods, string $uri, $action, ?string $name = null): void
    {
        $this->routes[] = [
            'methods' => array_map('strtoupper', $methods),
            'uri' => $uri,
            'action' => $action,
            'name' => $name,
        ];
    }

    public function dispatch(Request $request): Response
    {
        $path = $request->path();
        $method = $request->method();
        
        // Нормализация пути (убираем начальный и конечный слэш, кроме корня)
        $path = rtrim($path, '/');
        if ($path === '') {
            $path = '/';
        }

        foreach ($this->routes as $route) {
            $routeUri = rtrim($route['uri'], '/');
            if ($routeUri === '') {
                $routeUri = '/';
            }
            
            if (in_array($method, $route['methods']) && $this->matchUri($routeUri, $path)) {
                return $this->runAction($route['action'], $request);
            }
        }

        return Response::make('404 Not Found', 404);
    }

    private function matchUri(string $pattern, string $path): bool
    {
        // Точное совпадение
        if ($pattern === $path) {
            return true;
        }
        
        // Для паттернов с параметрами
        $pattern = '#^' . preg_quote($pattern, '#') . '$#';
        $pattern = preg_replace('#\\\{[^}]+\\\}#', '([^/]+)', $pattern);
        return (bool) preg_match($pattern, $path);
    }

    private function runAction($action, Request $request): Response
    {
        global $app;
        
        if (is_callable($action)) {
            return $action($request);
        }

        if (is_string($action) && strpos($action, '@') !== false) {
            [$controller, $method] = explode('@', $action);
            $controller = "App\\Http\\Controllers\\{$controller}";
            
            if (isset($app)) {
                $controllerInstance = $app->getContainer()->make($controller);
            } else {
                $controllerInstance = new $controller();
            }
            
            return $controllerInstance->$method($request);
        }

        if (is_array($action) && count($action) === 2) {
            [$controller, $method] = $action;
            
            if (is_string($controller)) {
                if (isset($app)) {
                    $controllerInstance = $app->getContainer()->make($controller);
                } else {
                    $controllerInstance = new $controller();
                }
            } else {
                $controllerInstance = $controller;
            }
            
            return $controllerInstance->$method($request);
        }

        return Response::make('Invalid route action', 500);
    }

    public function url(string $name, array $params = []): ?string
    {
        foreach ($this->routes as $route) {
            if ($route['name'] === $name) {
                $uri = $route['uri'];
                foreach ($params as $key => $value) {
                    $uri = str_replace('{' . $key . '}', $value, $uri);
                }
                return $uri;
            }
        }
        return null;
    }
}

