<?php
echo "PHP работает!<br>";
echo "Текущая директория: " . __DIR__ . "<br>";
echo "Корневая директория проекта: " . dirname(__DIR__) . "<br>";
echo "Путь к vendor: " . (file_exists(__DIR__ . '/../vendor/autoload.php') ? 'Существует' : 'НЕ существует') . "<br>";
phpinfo();

