<?php

session_start();

define('CYMPHONE_START', microtime(true));

require __DIR__ . '/../vendor/autoload.php';

// Загрузка переменных окружения из .env файла
$envFile = __DIR__ . '/../.env';
if (file_exists($envFile)) {
    \Cymphone\Support\Env::load($envFile);
}

require __DIR__ . '/../helpers.php';

try {
    $app = require __DIR__ . '/../bootstrap/app.php';
    $GLOBALS['app'] = $app;

    require __DIR__ . '/../routes/web.php';

    $request = new \Cymphone\Http\Request();
    $response = $app->handleRequest($request);
    $response->send();
} catch (\Throwable $e) {
    // Обработка ошибок
    http_response_code(500);
    
    $appDebug = \Cymphone\Support\Env::get('APP_DEBUG', false);
    
    if ($appDebug === 'true' || $appDebug === true) {
        echo "<!DOCTYPE html>";
        echo "<html lang='ru'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Ошибка приложения</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; max-width: 800px; margin: 50px auto; padding: 20px; background: #0f172a; color: #f1f5f9; }";
        echo "h1 { color: #ef4444; }";
        echo "pre { background: #1e293b; padding: 15px; border-radius: 8px; overflow-x: auto; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Ошибка приложения</h1>";
        echo "<p><strong>Сообщение:</strong> " . htmlspecialchars($e->getMessage()) . "</p>";
        echo "<p><strong>Файл:</strong> " . htmlspecialchars($e->getFile()) . "</p>";
        echo "<p><strong>Строка:</strong> " . $e->getLine() . "</p>";
        echo "<pre>" . htmlspecialchars($e->getTraceAsString()) . "</pre>";
        echo "</body>";
        echo "</html>";
    } else {
        echo "<!DOCTYPE html>";
        echo "<html lang='ru'>";
        echo "<head>";
        echo "<meta charset='UTF-8'>";
        echo "<meta name='viewport' content='width=device-width, initial-scale=1.0'>";
        echo "<title>Ошибка</title>";
        echo "<style>";
        echo "body { font-family: Arial, sans-serif; max-width: 600px; margin: 100px auto; padding: 20px; text-align: center; background: #0f172a; color: #f1f5f9; }";
        echo "h1 { color: #ef4444; }";
        echo "</style>";
        echo "</head>";
        echo "<body>";
        echo "<h1>Произошла ошибка</h1>";
        echo "<p>Обратитесь к администратору.</p>";
        echo "</body>";
        echo "</html>";
    }
    
    error_log("Cymphone Error: " . $e->getMessage() . " in " . $e->getFile() . ":" . $e->getLine());
}

