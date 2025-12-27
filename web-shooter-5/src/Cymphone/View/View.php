<?php

namespace Cymphone\View;

class View
{
    private string $viewPath;

    public function __construct(string $viewPath)
    {
        $this->viewPath = $viewPath;
    }

    public static function make(string $view, array $data = []): string
    {
        $basePath = dirname(__DIR__, 3);
        $viewPath = $basePath . '/resources/views/' . str_replace('.', '/', $view) . '.php';
        
        if (!file_exists($viewPath)) {
            throw new \Exception("View not found: {$view} at {$viewPath}");
        }

        extract($data);
        ob_start();
        include $viewPath;
        return ob_get_clean();
    }

    public static function render(string $view, array $data = []): string
    {
        return self::make($view, $data);
    }
}

