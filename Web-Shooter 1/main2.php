<?php

// Строгий режим типизации (неявные преобразования запрещены)
declare(strict_types=1);

function sum(int $a, int $b): int 
{
    return $a + $b;
}

// передаем целые числа
echo sum(2, 3), "\n";

// передача строки вместо целого числа вызовет TypeError
//echo sum("2", 3);

?>
