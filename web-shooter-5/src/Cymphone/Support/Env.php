<?php

namespace Cymphone\Support;

class Env
{
    private static array $loaded = [];

    /**
     * Загружает переменные окружения из .env файла
     */
    public static function load(string $filePath): void
    {
        if (!file_exists($filePath)) {
            return;
        }

        $lines = file($filePath, FILE_IGNORE_NEW_LINES | FILE_SKIP_EMPTY_LINES);
        
        foreach ($lines as $line) {
            // Пропускаем комментарии
            if (strpos(trim($line), '#') === 0) {
                continue;
            }

            // Пропускаем строки без знака =
            if (strpos($line, '=') === false) {
                continue;
            }

            [$key, $value] = explode('=', $line, 2);
            $key = trim($key);
            $value = trim($value);

            // Удаляем кавычки если есть
            if (preg_match('/^"(.*)"$/', $value, $matches)) {
                $value = $matches[1];
            } elseif (preg_match("/^'(.*)'$/", $value, $matches)) {
                $value = $matches[1];
            }

            // Устанавливаем переменную окружения только если она еще не установлена
            if (!array_key_exists($key, $_ENV) && !array_key_exists($key, $_SERVER)) {
                $_ENV[$key] = $value;
                $_SERVER[$key] = $value;
                putenv("{$key}={$value}");
            }
        }
    }

    /**
     * Получает значение переменной окружения
     */
    public static function get(string $key, $default = null)
    {
        // Сначала проверяем $_ENV
        if (isset($_ENV[$key])) {
            return $_ENV[$key];
        }

        // Затем $_SERVER
        if (isset($_SERVER[$key])) {
            return $_SERVER[$key];
        }

        // Затем getenv
        $value = getenv($key);
        if ($value !== false) {
            return $value;
        }

        return $default;
    }
}

