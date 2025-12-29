<?php

class MathUtils {
    // Статический метод для возведения числа в квадрат
    public static function square(float $x): float 
    {
        return $x * $x;
    }
}

$number = 5; // Исходное число

// Создаем объект MathUtils и вызываем метод square
$result = (new MathUtils())->square($number);

// Выводим результат
echo "Результат возведения числа {$number} в степень 2: {$result}";

?>