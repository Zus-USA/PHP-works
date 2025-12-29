<?php

function divide(float $a, float $b): ?float 
{
    // Если делитель равен нулю, возвращаем null
    // Используем строгое сравнение с плавающей точкой
    return $b === 0.0 ? null : $a / $b;
}

// Обычное деление
echo divide(10,4),"\n";

// Деление на ноль
$result = divide(10,-0); // -0 трактуется как 0.0
if ($result === null)
{
    echo "Ошибка деления на ноль","\n";
}

?>
